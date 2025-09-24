<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RoleLoginController extends Controller
{
    // Show login page for SG / Client
    public function showSGLogin()
    {
        return view('auth.login-sg');
    }

    // Show login page for Admin / HR
    public function showAdminLogin()
    {
        return view('auth.login-admin');
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
            ToastMagic::error('Invalid Role ID format. Please use the correct format.', 'Login Failed');
            return back()->withErrors(['role_id' => 'Invalid Role ID format.']);
        }

        [$prefix, $id] = $parts;

        // Check prefix and assign role
        $role = match ($prefix) {
            'sg'   => 'security_guard',
            'hsg'  => 'head_security_guard',
            'c'    => 'client',
            'adm'  => 'admin',
            'sa'   => 'super_admin',
            'hr'   => 'hr',
            default => null,
        };

        if (!$role) {
            ToastMagic::error('Invalid role prefix. Please check your Role ID.', 'Login Failed');
            return back()->withErrors(['role_id' => 'Invalid role prefix.']);
        }

        // Check if user exists
        $user = \App\Models\User::where('role_id', $request->role_id)->first();

        if (!$user) {
            ToastMagic::error('No account found with this User ID.', 'Login Failed');
            return back()->withErrors(['role_id' => 'No account found with this Role ID.']);
        }

        // Check password manually
        if (!Hash::check($request->password, $user->password)) {
            ToastMagic::error('Incorrect password. Please try again.', 'Login Failed');
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        Auth::login($user);

        // Redirect by role
        return match ($user->role) {
            'security_guard'       => redirect()->route('dashboard.security-guard'),
            'head_security_guard'  => redirect()->route('dashboard.head-sg'),
            'client'               => redirect()->route('dashboard.client'),
            'admin'                => redirect()->route('dashboard.admin'),
            'super_admin'          => redirect()->route('dashboard.super-admin'),
            'hr'                   => redirect()->route('dashboard.hr'),
            default                => redirect('/'),
        };
    }
}
