<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingCOntroller;
use Illuminate\Support\Facades\Auth;

// Route utama hanya untuk guest
Route::get('/', function () {
    return view('layouts.welcome');
})->middleware('guest');

// Login & Register hanya untuk guest
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    });
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/register', function () {
        return view('auth.register');
    });
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

//tambahan profile page
Route::get('/sertifikat', function () {
    return view('pages.sertifikat', [
        'user' => Auth::user()
    ]);
})->middleware('auth');

// Semua route berikut hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/help', function () {
        return view('pages.help');
    });

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    Route::post('/setting/avatar', [ProfileController::class, 'updateAvatar'])->name('setting.avatar');
    Route::delete('/user/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('user.deleteAvatar');


    Route::group(['middleware' => ['check_role:admin']], function () {
        Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
        Route::post('/admin/user/add', [DashboardController::class, 'addUser'])->name('admin.user.add');
        Route::delete('/admin/user/{id}', [DashboardController::class, 'deleteUser'])->name('admin.user.delete');
        Route::get('/admin/example-modal', [DashboardController::class, 'exampleModal'])->name('admin.example.modal');
    });

    // training
    Route::get('/Training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('/General Knowledge', function () {
        return view('pages.Training.training1');
    })->name('general.knowledge');
    Route::get('/Customer Requested', function () {
        return view('pages.Training.training3');
    })->name('customer.requested');
    Route::get('/License', function () {
        return view('pages.Training.training4');
    })->name('license.training');
    Route::get('/Mandatory', function (){
        return view('pages.Training.training2');
    })->name('mandatory.training');

    Route::put('/useredit/{id}', [DashboardController::class, 'userUpdate'])->name('user.update');
    Route::get('/General-Knowledge', function () {
        return view('pages.Training.training1');
    })->name('general.knowledge');
});

