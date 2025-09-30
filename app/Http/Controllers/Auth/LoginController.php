<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of Logins.
     */
    public function showSGLogin()
    {
        return view('auth.guards.login');
    }
    public function showAdminLogin()
    {
        return view('auth.admins.login');
    }

    // Process login for all roles
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'role_id' => ['required', 'regex:/^(sg|hsg|c|adm|sa|hr)\.\d+$/'],
            'password' => ['required', 'string'],
        ]);

        // Extract prefix and ID
        $parts = explode('.', $request->role_id);

        if (count($parts) < 2) {
            return back()->withErrors(['role_id' => 'Invalid Role ID format.']);
        }

        [$prefix, $id] = $parts;

        // Check prefix and assign role
        $role = match ($prefix) {
            'sg'   => 'Security Guard',
            'hsg'  => 'Head Security Guard',
            'c'    => 'Client',
            'adm'  => 'Admin',
            'sa'   => 'Super Admin',
            'hr'   => 'Human Resource',
            default => null,
        };

        if (!$role) {
            return back()->withErrors(['role_id' => 'Invalid role prefix.']);
        }

        // Check if user exists
        $user = \App\Models\User::where('role_id', $request->role_id)->first();

        if (!$user) {
            return back()->withErrors(['role_id' => 'No account found with this Role ID.']);
        }

        // Check password manually
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        Auth::login($user);

        // Redirect by role
        return match ($user->role) {
            'Security Guard'       => redirect()->route('dashboard.security-guard'),
            'Head Security Guard'  => redirect()->route('dashboard.head-sg'),
            'client'               => redirect()->route('dashboard.client'),
            'Admin'                => redirect()->route('dashboard.admin'),
            'Super Admin'          => redirect()->route('dashboard.super-admin'),
            'Human Resource'       => redirect()->route('dashboard.hr'),
            default                => redirect('/'),
        };
    }
}
