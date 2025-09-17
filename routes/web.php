<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RoleLoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
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

// Super Admin dashboard
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/dashboard/super-admin', [DashboardController::class, 'index'])
        ->name('dashboard.super-admin');

    // Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    // Route::delete('/accounts/{user}', [AccountController::class, 'destroy'])->name('accounts.destroy');
    // Route::put('/accounts/{user}', [AccountController::class, 'update']);
    // Route::put('/accounts/{user}/password', [AccountController::class, 'changePassword']);
});

// Admin dashboards
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', fn() => view('dashboard.admin.index'))->name('dashboard.admin');;

    // Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    // Route::delete('/accounts/{user}', [AccountController::class, 'destroy'])->name('accounts.destroy');
    // Route::put('/accounts/{user}', [AccountController::class, 'update']);
    // Route::put('/accounts/{user}/password', [AccountController::class, 'changePassword']);
});

// HR dashboard
Route::middleware(['auth', 'role:hr'])->group(function () {
    Route::get('/dashboard/human-resources', fn() => view('dashboard.human_resources.index'))->name('dashboard.hr');;

    // Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    // Route::delete('/accounts/{user}', [AccountController::class, 'destroy'])->name('accounts.destroy');
    // Route::put('/accounts/{user}', [AccountController::class, 'update']);
    // Route::put('/accounts/{user}/password', [AccountController::class, 'changePassword']);
});

// Head Security Guard dashboard
Route::middleware(['auth', 'role:head_security_guard'])->group(function () {
    Route::get('/dashboard/head-sg', fn() => view('dashboard.head_security_guard.index'))->name('dashboard.head-sg');;

    // Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    // Route::delete('/accounts/{user}', [AccountController::class, 'destroy'])->name('accounts.destroy');
    // Route::put('/accounts/{user}', [AccountController::class, 'update']);
    // Route::put('/accounts/{user}/password', [AccountController::class, 'changePassword']);
});

// Security Guard dashboards
Route::middleware(['auth', 'role:security_guard'])->group(function () {
    Route::get('/dashboard/security-guard', fn() => view('dashboard.security_guard.index'))->name('dashboard.security-guard');;

    // Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    // Route::delete('/accounts/{user}', [AccountController::class, 'destroy'])->name('accounts.destroy');
    // Route::put('/accounts/{user}', [AccountController::class, 'update']);
    // Route::put('/accounts/{user}/password', [AccountController::class, 'changePassword']);
});

// Client dashboard
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard/client', fn() => view('dashboard.client.index'))->name('dashboard.client');;

    // Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    // Route::delete('/accounts/{user}', [AccountController::class, 'destroy'])->name('accounts.destroy');
    // Route::put('/accounts/{user}', [AccountController::class, 'update']);
    // Route::put('/accounts/{user}/password', [AccountController::class, 'changePassword']);
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
