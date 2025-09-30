<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\AdminController;
use App\Http\Controllers\Users\SuperAdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', fn() => view('welcome'));

// Show login pages
Route::get('/login/guards', [LoginController::class, 'showSGLogin'])->name('login.sg');
Route::get('/login/admins', [LoginController::class, 'showAdminLogin'])->name('login.admin');

// Process login
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/application', function () {
    return view('application');
})->name('application');

// Super Admin dashboard
Route::middleware(['auth', RoleMiddleware::class . ':Super Admin'])->group(function () {
    Route::resource('/dashboard/super-admin', SuperAdminController::class)
        ->names('superadmin.accounts');

    Route::get('/dashboard/super-admin', [SuperAdminController::class, 'index'])
        ->name('dashboard.super-admin');
    Route::put('/superadmin/accounts/{id}', [SuperAdminController::class, 'update'])->name('superadmin.accounts.update');
});

// Admin dashboard
Route::middleware(['auth', RoleMiddleware::class . ':Admin'])->group(function () {
    Route::resource('/dashboard/admin', AdminController::class)
        ->names('admin.accounts');

    Route::get('/dashboard/admin', [AdminController::class, 'index'])
        ->name('dashboard.admin');
});


// TODO: Add routes for Security Guards and other roles as needed
// TODO: Fix the dashboards for admin and super admin