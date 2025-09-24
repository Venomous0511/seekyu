<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    /**
     * Show all accounts (including soft-deleted if needed).
     */
    public function index()
    {
        $users = User::withTrashed()->paginate(10); // rename to $users
        return view('dashboards.super_admin.index', compact('users'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('dashboards.super_admin.index');
    }

    /**
     * Store a new account.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => ['required', Rule::in(['super_admin', 'admin', 'hr', 'head_security_guard', 'security_guard', 'client'])],
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Account created successfully!');
    }

    /**
     * Show edit form.
     */
    public function edit(User $account)
    {
        return view('dashboards.super_admin.index', compact('account'));
    }

    /**
     * Update an account.
     */
    public function update(Request $request, User $account)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($account->id)],
            'role'  => ['required', Rule::in(['super_admin', 'admin', 'hr', 'head_security_guard', 'security_guard', 'client'])],
        ]);

        $account->update($validated);

        return redirect()->route('admin.accounts.index')->with('success', 'Account updated successfully!');
    }

    /**
     * Show change password form.
     */
    public function editPassword(User $account)
    {
        return view('dashboards.super_admin.index', compact('account'));
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request, User $account)
    {
        $validated = $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $account->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Password updated successfully!');
    }

    /**
     * Soft delete account.
     */
    public function destroy(User $account)
    {
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Account deleted (soft) successfully!');
    }

    /**
     * Restore soft-deleted account.
     */
    public function restore($id)
    {
        $account = User::withTrashed()->findOrFail($id);
        $account->restore();

        return redirect()->route('admin.accounts.index')->with('success', 'Account restored successfully!');
    }

    /**
     * Permanently delete account.
     */
    public function forceDelete($id)
    {
        $account = User::withTrashed()->findOrFail($id);
        $account->forceDelete();

        return redirect()->route('admin.accounts.index')->with('success', 'Account permanently deleted!');
    }
}
