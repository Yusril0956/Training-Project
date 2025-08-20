<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/training', [DashboardController::class, 'training']);

Route::get('/music', [DashboardController::class, 'music']);

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class,'logout']);

Route::get('/admin', [DashboardController::class, 'admin']);

Route::get('/setting', function () {
    return view('pages.setting');
});

Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/admin', [DashboardController::class, 'admin']);
});
