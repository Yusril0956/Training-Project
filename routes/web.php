<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingCOntroller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\CertificateController;

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

Route::get('/inbox', [DashboardController::class, 'inbox'])->name('inbox');


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

    Route::post('/feedback', [DashboardController::class, 'feedback'])->name('feedback');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/terms', [DashboardController::class, 'terms'])->name('terms');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [DashboardController::class, 'index'])->name('index');
    Route::post('/setting/avatar', [ProfileController::class, 'updateAvatar'])->name('setting.avatar');
    Route::post('/setting/password', [ProfileController::class, 'updatePassword'])->name('setting.password');
    Route::post('/setting/profile', [ProfileController::class, 'updateProfile'])->name('setting.profile');
    Route::delete('/user/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('user.deleteAvatar');


    Route::group(['middleware' => ['check_role:admin,super_admin']], function () {
        Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
        Route::post('/admin/user/add', [DashboardController::class, 'addUser'])->name('users.create');
        Route::delete('/admin/user/{id}', [DashboardController::class, 'deleteUser'])->name('admin.user.delete');
        Route::get('/admin/example-modal', [DashboardController::class, 'exampleModal'])->name('admin.example.modal');
    });

    // training
    Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('/General Knowledge', function () {
        return view('pages.Training.training1');
    })->name('general.knowledge');
    Route::get('/customer-requested', [TrainingController::class, 'customerRequested'])->name('customer.requested');
    Route::get('/License', function () {
        return view('pages.Training.training4');
    })->name('license.training');
    Route::get('/Mandatory', function () {
        return view('pages.Training.training2');
    })->name('mandatory.training');

    Route::get('/training/detail-training', function () {
        return view('pages.Training.detail_training');
    })->name('detail.training');

    Route::put('/useredit/{id}', [DashboardController::class, 'userUpdate'])->name('user.update');
    Route::get('/General-Knowledge', function () {
        return view('pages.Training.training1');
    })->name('general.knowledge');
});

Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    // Cari user berdasarkan email
    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        // Kalau user belum ada → buat baru
        $user = User::create([
            'name'  => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(str()->random(16)), // password random
            'google_id' => $googleUser->getId(), // bisa tambahin kolom ini di users table
        ]);
    }

    Auth::login($user);

    return redirect('/home');
});
Route::middleware('auth')->group(function () {
    Route::get('/certificates', [CertificateController::class, 'index']);
    Route::post('/certificates', [CertificateController::class, 'store']);
});
