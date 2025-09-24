<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $query = Account::whereNull('removed_at');
        if ($q) {
            $query->where(function($s) use ($q) {
                $s->where('full_name','like',"%{$q}%")
                  ->orWhere('username','like',"%{$q}%")
                  ->orWhere('account_id','like',"%{$q}%");
            });
        }
        return response()->json($query->orderBy('id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'full_name' => 'required|string',
            'username' => 'required|string|unique:accounts,username',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // generate account id prefix logic
        $prefixes = [
            'Admin'=>'ADM','HR'=>'HR','Security Guard'=>'SG','Head Guard'=>'HG','Client'=>'CL'
        ];
        $pref = $prefixes[$data['role']] ?? 'USR';
        $seq = Account::max('id') + 1;
        $accountId = sprintf('%s-%04d', $pref, $seq);

        $acc = Account::create([
            'account_id'=>$accountId,
            'full_name'=>$data['full_name'],
            'username'=>$data['username'],
            'role'=>$data['role'],
            'password'=>Hash::make($data['password']),
        ]);

        return response()->json($acc, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $acc = Account::findOrFail($id);
        $data = $request->validate([
            'full_name' => 'required|string',
            'username' => ['required','string', Rule::unique('accounts','username')->ignore($acc->id)],
            'role' => 'required|string'
        ]);
        $acc->update($data);
        return response()->json($acc);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove($id)
    {
        $acc = Account::findOrFail($id);
        $acc->removed_at = now();
        $acc->save();
        return response()->json(['removed' => true]);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $acc = Account::findOrFail($id);
        $acc->removed_at = null;
        $acc->save();
        return response()->json(['restored' => true]);
    }

    /**
     * Change password of the specified resource in storage.
     */
    public function changePassword(Request $request)
    {
        $id = $request->input('id');
        $data = $request->validate([
            'id' => 'required|integer|exists:accounts,id',
            'password' => 'required|string|min:6|confirmed'
        ]);
        $acc = Account::findOrFail($id);
        $acc->password = Hash::make($data['password']);
        $acc->save();
        return response()->json(['changed' => true]);
    }
}
