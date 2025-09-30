<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.super-admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $prefix = match ($validated['role']) {
            'Super Admin' => 'sa',
            'Admin' => 'adm',
            'Human Resource' => 'hr',
            'Head Security Guard' => 'hsg',
            'Security Guard' => 'sg',
            'Client' => 'c',
            default => null,
        };

        if (!$prefix) {
            return redirect()->back()->withErrors(['role' => 'Invalid role selected.']);
        }

        $lastRole = User::where('role_id', 'like', $prefix . '.%')
            ->orderBy('role_id', 'desc')
            ->first();

        if ($lastRole) {
            $lastNumber = (int) explode('.', $lastRole->role_id)[1];
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $roleId = $prefix . '.' . $nextNumber;

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'role_id' => $roleId,
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Account for ' . $validated['name'] . ' created successfully with Role ID: ' . $roleId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('users.super-admin.edit', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('dashboard.super-admin')->with('success', 'Account for ' . $validated['name'] . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
