<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'role_id' => 'required|string',
            'password' => 'required|string',
        ]);

        // Example: sg.123 → split into [sg, 123]
        [$prefix, $id] = explode('.', $request->role_id);

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
            return back()->withErrors(['role_id' => 'Invalid role prefix.']);
        }

        // Attempt authentication
        if (Auth::attempt([
            'role_id' => $request->role_id,
            'password' => $request->password,
        ])) {
            $user = Auth::user();

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

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }
}
