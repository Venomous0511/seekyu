<?php

use App\Http\Controllers\Auth\RoleLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Middleware\RoleMiddleware;

// For testing: List all users
Route::get('/test-users', function () {
    $users = User::all()->groupBy('role');
    return view('test-users', compact('users'));
});

// Home route
Route::get('/', fn() => view('welcome'));

// Show login pages
Route::get('/login/sg', [RoleLoginController::class, 'showSGLogin'])->name('login.sg');
Route::get('/login/admin', [RoleLoginController::class, 'showAdminLogin'])->name('login.admin');

// Process login
Route::post('/login', [RoleLoginController::class, 'login'])->name('login.process');

// Super Admin dashboard + account management
Route::middleware(['auth', RoleMiddleware::class . ':super_admin'])->group(function () {
    Route::get('/dashboard/super-admin', [DashboardController::class, 'index'])
        ->name('dashboard.super-admin');

    // Account Management
    Route::resource('admin/accounts', AccountController::class)->names('admin.accounts');


    // Extra routes for restore + force delete
    Route::get('admin/accounts/{account}/password', [AccountController::class, 'editPassword'])
        ->name('admin.accounts.password');

    Route::put('admin/accounts/{account}/password', [AccountController::class, 'updatePassword'])
        ->name('admin.accounts.password.update');
    Route::post('admin/accounts/{id}/restore', [AccountController::class, 'restore'])->name('admin.accounts.restore');
    Route::delete('admin/accounts/{id}/force-delete', [AccountController::class, 'forceDelete'])->name('admin.accounts.force-delete');
});

// Admin dashboard
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboard/admin', fn() => view('dashboards.admin.index'))->name('dashboard.admin');
});

// HR dashboard
Route::middleware(['auth', RoleMiddleware::class . ':hr'])->group(function () {
    Route::get('/dashboard/human-resources', fn() => view('dashboards.human_resources.index'))->name('dashboard.hr');
});

// Head Security Guard dashboard
Route::middleware(['auth', RoleMiddleware::class . ':head_security_guard'])->group(function () {
    Route::get('/dashboard/head-sg', fn() => view('dashboards.head_security_guard.index'))->name('dashboard.head-sg');
});

// Security Guard dashboard
Route::middleware(['auth', RoleMiddleware::class . ':security_guard'])->group(function () {
    Route::get('/dashboard/security-guard', fn() => view('dashboards.security_guard.index'))->name('dashboard.security-guard');
});

// Client dashboard
Route::middleware(['auth', RoleMiddleware::class . ':client'])->group(function () {
    Route::get('/dashboard/client', fn() => view('dashboards.client.index'))->name('dashboard.client');
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
