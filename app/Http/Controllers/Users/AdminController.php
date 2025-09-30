<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // You can use pagination here for large data sets
        $users = User::orderBy('id', 'asc')->get();

        return view('users.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('users.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'role'     => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate role_id prefix based on role
        $prefix = match ($validated['role']) {
            'Super Admin'      => 'sa',
            'Admin'           => 'adm',
            'Human Resource'  => 'hr',
            'Head Security Guard' => 'hsg',
            'Security Guard'  => 'sg',
            'Client'         => 'c',
            default          => null,
        };

        if (!$prefix) {
            return redirect()->back()->withErrors(['role' => 'Invalid role selected.']);
        }

        // Generate unique incremental role_id
        $lastRole = User::where('role_id', 'like', $prefix . '.%')
            ->orderBy('role_id', 'desc')
            ->first();

        $nextNumber = $lastRole
            ? ((int) explode('.', $lastRole->role_id)[1]) + 1
            : 1;

        $roleId = $prefix . '.' . $nextNumber;

        // Create the new user
        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'role'     => $validated['role'],
            'role_id'  => $roleId,
            'password' => Hash::make($validated['password']),
        ]);

        ToastMagic::success("Account for {$validated['name']} created successfully with Role ID: {$roleId}");
        return redirect()->route('admin.accounts.index')
            ->with('success', "Account for {$validated['name']} created successfully with Role ID: {$roleId}");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $user = User::findOrFail($id);
        // return view('users.admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email,' . $user->id,
            'role'     => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        ToastMagic::success("Account for {$validated['name']} updated successfully.");
        return redirect()->route('admin.accounts.index')
            ->with('success', "Account for {$validated['name']} updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself
        if (Auth::id() === $user->id) {
            ToastMagic::error('You cannot delete your own account.');
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        ToastMagic::success('Account deleted successfully.');
        return redirect()->back()->with('success', 'Account deleted successfully.');
    }
}
