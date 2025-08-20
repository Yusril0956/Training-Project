<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Dashboard utama
Route::get('/', [DashboardController::class, 'index']);

// Training page
Route::get('/training', [DashboardController::class, 'training']);

// Music page
Route::get('/music', [DashboardController::class, 'music']);

// Login & Register
Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class,'logout']);

// Admin page
Route::get('/admin', [DashboardController::class, 'admin']);

// Test page
Route::get('/test', [DashboardController::class, 'test']);

// Setting page
Route::get('/setting', function () {
    return view('pages.setting');
});

// Route khusus admin
Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/admin', [DashboardController::class, 'admin']);
});
