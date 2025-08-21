<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;

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
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboard user
Route::get('/dashboard', [DashboardController::class, 'index']);

// Setting page (gunakan controller, jangan pakai closure lagi!)
Route::get('/setting', [SettingController::class, 'index'])->middleware('auth');

// Route khusus admin
Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/admin', [DashboardController::class, 'admin']);
});

// Edit user (update)
Route::put('/useredit/{id}', [DashboardController::class, 'userUpdate'])->name('user.update');
