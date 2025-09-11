<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // Show all users
    public function index(Request $request)
    {
        $role = $request->query('role');

        $users = $role
            ? User::where('role', $role)->get()
            : User::all();
        return view('dashboard.super_admin.dashboard', compact('users', 'role'));
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|unique:users',
            'role' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'role_id' => $request->role_id,
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard.super-admin')->with('success', 'Account created successfully!');
    }

    // Update user details
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
        ]);

        $user->update($request->only('name', 'email', 'role'));
        return response()->json(['success' => true]);
    }

    // Change user password
    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $user->update(['password' => Hash::make($request->password)]);
        return response()->json(['success' => true]);
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.super-admin')->with('success', 'Account deleted successfully!');
    }
}
