<?php

namespace App\Http\Controllers;

use App\Models\User;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class DashboardController extends Controller
{
    public function index()
    {
        $activeGuards = User::where('role', 'security_guard')
            ->where('status', 'active')
            ->count();

        $activeClients = User::where('role', 'client')
            ->where('status', 'active')
            ->count();

        $pendingRequests = User::where('status', 'pending')->count();

        // Example: recent activities (replace with your actual activity tracking logic)
        $recentActivities = [
            [
                'name' => 'John Doe',
                'assigned_by' => 'HR',
                'date' => now()->subDay()->format('Y-m-d'),
                'action' => 'New Registered',
            ],
            [
                'name' => 'Client XYZ',
                'assigned_by' => 'Admin',
                'date' => now()->format('Y-m-d'),
                'action' => 'New Account',
            ],
        ];

        // Toast notification
        ToastMagic::success('Welcome to the Super Admin Dashboard!', 'Login Successful');

        // Pass data to the view
        return view('dashboards.super_admin.index', compact(
            'activeGuards',
            'activeClients',
            'pendingRequests',
            'recentActivities'
        ));
    }
}
