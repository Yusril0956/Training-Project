<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;

// Route utama hanya untuk guest
Route::get('/', [DashboardController::class, 'test'])->middleware('guest');

// Login & Register hanya untuk guest
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    });
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    });
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Semua route berikut hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/help', function () {
        return view('help');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/training', [DashboardController::class, 'training']);
    Route::get('/music', [DashboardController::class, 'music']);
    Route::get('/setting', [SettingController::class, 'index']);

    // Route khusus admin
    Route::group(['middleware' => ['check_role:admin']], function () {
        Route::get('/admin', [DashboardController::class, 'admin']);
        Route::post('/admin/user/add', [DashboardController::class, 'addUser'])->name('admin.user.add');
    });

    // Edit user (update)
    Route::put('/useredit/{id}', [DashboardController::class, 'userUpdate'])->name('user.update');
});
