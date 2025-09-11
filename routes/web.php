<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RoleLoginController;
use App\Http\Controllers\AccountController;
use App\Models\User;

// For testing: List all users
Route::get('/test-users', function () {
    $users = User::all()->groupBy('role'); // group by role
    return view('test-users', compact('users'));
});

// Home route
Route::get('/', function () {
    return view('home');
});

// Show login page for SG / Client
Route::get('/login/sg', [RoleLoginController::class, 'showSGLogin'])->name('login.sg');

// Show login page for Admin / HR
Route::get('/login/admin', [RoleLoginController::class, 'showAdminLogin'])->name('login.admin');

// Process login (shared)
Route::post('/login', [RoleLoginController::class, 'login'])->name('login.process');

// Security Guard dashboards
Route::get('/dashboard/security-guard', fn() => view('dashboard.security-guard'))
    ->middleware('role:security_guard')
    ->name('dashboard.security-guard');

Route::get('/dashboard/head-sg', fn() => view('dashboard.head-sg'))
    ->middleware('role:head_security_guard')
    ->name('dashboard.head-sg');

// Client dashboard
Route::get('/dashboard/client', fn() => view('dashboard.client'))
    ->middleware('role:client')
    ->name('dashboard.client');

// Admin dashboards
Route::get('/dashboard/admin', fn() => view('dashboard.admin'))
    ->middleware('role:admin')
    ->name('dashboard.admin');

// Route::get('/dashboard/super-admin', fn() => view('dashboard.super_admin.dashboard'))
//     ->middleware('role:super_admin')
//     ->name('dashboard.super-admin');

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/dashboard/super-admin', [AccountController::class, 'index'])->name('dashboard.super-admin');
    Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    Route::delete('/accounts/{user}', [AccountController::class, 'destroy'])->name('accounts.destroy');

    Route::put('/accounts/{user}', [AccountController::class, 'update']);
    Route::put('/accounts/{user}/password', [AccountController::class, 'changePassword']);
});

// HR dashboard
Route::get('/dashboard/hr', fn() => view('dashboard.hr'))
    ->middleware('role:hr')
    ->name('dashboard.hr');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
