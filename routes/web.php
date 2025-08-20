<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Dashboard utama
Route::get('/', [DashboardController::class, 'test']);

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

Route::get('/setting', function () {
    return view('pages.setting');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

// Route khusus admin
Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/admin', [DashboardController::class, 'admin']);
});
