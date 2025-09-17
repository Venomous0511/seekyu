<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $activeGuards = User::activeGuards()->count();
        $activeClients = User::activeClients()->count();
        $pendingRequests = User::pendingRequests()->count();

        return view('dashboard.super_admin.index', compact('activeGuards', 'activeClients', 'pendingRequests'));
    }
}
