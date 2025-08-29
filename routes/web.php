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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ============================
// Guest Routes (User Belum Login)
// ============================
Route::middleware('guest')->group(function () {
    // Welcome Page
    Route::get('/', fn() => view('layouts.welcome'))->name('welcome');

    // Login
    Route::get('/login', fn() => view('auth.login'))->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Register
    Route::get('/register', fn() => view('auth.register'))->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    // Complete Profile after Google login
    Route::get('/complete-profile', [AuthController::class, 'completeForm'])->name('profile.complete');
    Route::post('/complete-profile', [AuthController::class, 'saveCompleteForm'])->name('profile.complete.save');
});

// ============================
// Socialite (Google Login)
// ============================
Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    // Find or create user
    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name'      => $googleUser->getName(),
            'password'  => bcrypt(str()->random(16)), // random password
            'google_id' => $googleUser->getId(),
        ]
    );

    Auth::login($user);

    // Redirect to complete profile if necessary
    if (!$user->phone || !$user->nik || !$user->address || !$user->city) {
        return redirect()->route('profile.complete');
    }

    return redirect()->route('index');
});


// ============================
// Authenticated Routes (User Sudah Login)
// ============================
Route::middleware('auth')->group(function () {
    // Dashboard & General Pages
    Route::get('/home', [DashboardController::class, 'index'])->name('index');
    Route::get('/inbox', [DashboardController::class, 'inbox'])->name('inbox');
    Route::get('/help', fn() => view('pages.help'))->name('help');
    Route::get('/terms', [DashboardController::class, 'terms'])->name('terms');
    Route::post('/feedback', [DashboardController::class, 'feedback'])->name('feedback');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/useredit/{id}', [DashboardController::class, 'userUpdate'])->name('user.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/setting/avatar', [ProfileController::class, 'updateAvatar'])->name('setting.avatar');
    Route::post('/setting/password', [ProfileController::class, 'updatePassword'])->name('setting.password');
    Route::post('/setting/profile', [ProfileController::class, 'updateProfile'])->name('setting.profile');
    Route::delete('/user/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('user.deleteAvatar');

    // Training
    Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('/training/general-knowledge', fn() => view('pages.Training.training1'))->name('general.knowledge');
    Route::get('/training/mandatory', fn() => view('pages.Training.training2'))->name('mandatory.training');
    Route::get('/training/license', fn() => view('pages.Training.training4'))->name('license.training');
    Route::get('/training/customer-requested', [TrainingController::class, 'customerRequested'])->name('customer.requested');
    Route::get('/training/detail-training', fn() => view('pages.Training.detail_training'))->name('detail.training');
    Route::get('/training/{id}/detail', [TrainingController::class, 'detail'])->name('training.detail');
    Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::post('/training/store', [TrainingController::class, 'store'])->name('training.store');

    // Certificates
    Route::get('/sertifikat', fn() => view('pages.sertifikat', ['user' => Auth::user()]))->name('sertifikat');
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');

    // ============================
    // Admin & Super Admin Routes
    // ============================
    Route::middleware(['check_role:admin,super_admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
        Route::post('/admin/user/add', [DashboardController::class, 'addUser'])->name('users.create');
        Route::delete('/admin/user/{id}', [DashboardController::class, 'deleteUser'])->name('admin.user.delete');
        Route::get('/admin/example-modal', [DashboardController::class, 'exampleModal'])->name('admin.example.modal');
    });
});
