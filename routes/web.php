<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================
// Guest Routes (Belum Login)
// ============================
Route::middleware('guest')->group(function () {
    // Halaman Welcome
    Route::get('/', fn() => view('layouts.welcome'))->name('welcome');

    // Login
    Route::get('/login', fn() => view('auth.login'))->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Register
    Route::get('/register', fn() => view('auth.register'))->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    // Lengkapi Profil setelah login dengan Google
    Route::get('/complete-profile', [AuthController::class, 'completeForm'])->name('profile.complete');
    Route::post('/complete-profile', [AuthController::class, 'saveCompleteForm'])->name('profile.complete.save');
});

// ============================
// Semua route berikut hanya untuk user yang sudah login
// ============================
Route::middleware('auth')->group(function () {
    // Dashboard & umum
    Route::get('/home', [DashboardController::class, 'index'])->name('index');
    Route::get('/inbox', [DashboardController::class, 'inbox'])->name('inbox');
    Route::get('/help', fn() => view('pages.help'))->name('help');
    Route::get('/terms', [DashboardController::class, 'terms'])->name('terms');

    // Feedback
    Route::post('/feedback', [DashboardController::class, 'feedback'])->name('feedback');

    // Profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/setting/avatar', [ProfileController::class, 'updateAvatar'])->name('setting.avatar');
    Route::post('/setting/password', [ProfileController::class, 'updatePassword'])->name('setting.password');
    Route::post('/setting/profile', [ProfileController::class, 'updateProfile'])->name('setting.profile');
    Route::delete('/user/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('user.deleteAvatar');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Sertifikat (halaman statis dengan user login)
    Route::get('/sertifikat', fn() => view('pages.sertifikat', [
        'user' => Auth::user(),
    ]))->name('sertifikat');

    // Training
    Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('/general-knowledge', fn() => view('pages.Training.training1'))->name('general.knowledge');
    Route::get('/mandatory', fn() => view('pages.Training.training2'))->name('mandatory.training');
    Route::get('/license', fn() => view('pages.Training.training4'))->name('license.training');
    Route::get('/customer-requested', [TrainingController::class, 'customerRequested'])->name('customer.requested');
    Route::get('/training/{id}/detail', [TrainingController::class, 'detail'])->name('training.detail');
    Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::post('/training/store', [TrainingController::class, 'store'])->name('training.store');

    // Update user
    Route::put('/useredit/{id}', [DashboardController::class, 'userUpdate'])->name('user.update');

    // ============================
    // Admin & Super Admin
    // ============================
    Route::middleware(['check_role:admin,super_admin'])->group(function () {
        // Admin dashboard
        Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
        Route::post('/admin/user/add', [DashboardController::class, 'addUser'])->name('users.create');
        Route::delete('/admin/user/{id}', [DashboardController::class, 'deleteUser'])->name('admin.user.delete');
        Route::get('/admin/example-modal', [DashboardController::class, 'exampleModal'])->name('admin.example.modal');

        // Certificates
        Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
        Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');

        // Training tambahan (khusus admin jika perlu)
        Route::get('/training/detail-training', fn() => view('pages.Training.detail_training'))->name('detail.training');
    });
});

// ============================
// Google OAuth
// ============================
Route::get('/auth/google', fn() => Socialite::driver('google')->redirect())->name('google.login');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    // Cari user berdasarkan email
    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        // Buat akun baru dengan data minimum
        $user = User::create([
            'name'      => $googleUser->getName(),
            'email'     => $googleUser->getEmail(),
            'password'  => bcrypt(str()->random(16)), // password random
            'google_id' => $googleUser->getId(),
        ]);
    }

    Auth::login($user);

    // Jika profil belum lengkap, arahkan ke form
    if (!$user->phone || !$user->nik || !$user->address || !$user->city) {
        return redirect()->route('profile.complete');
    }

    return redirect()->route('index');
});
