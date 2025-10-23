<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ExternalCertificateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================
// Guest Routes (Belum Login)
// ============================
Route::middleware('guest')->group(function () {
    Route::view('/', 'layouts.welcome')->name('welcome');

    // Auth
    Route::view('/login', 'auth.login')->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::view('/register', 'auth.register')->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    // Complete Profile setelah login Google
    Route::get('/complete-profile', [AuthController::class, 'completeForm'])->name('profile.complete');
    Route::post('/complete-profile', [AuthController::class, 'saveCompleteForm'])->name('profile.complete.save');

    // Google Login
    Route::get('auth/google', fn() => Socialite::driver('google')->redirect())->name('google.login');
    Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('google.callback');
});

// ============================
// Authenticated Routes (Sudah Login)
// ============================
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/home', [DashboardController::class, 'index'])->name('index');
    Route::get('/inbox', [DashboardController::class, 'inbox'])->name('inbox');
    Route::get('/sertifikat', [DashboardController::class, 'mysertifikat'])->name('mysertifikat');
    Route::get('/notifikasi', [DashboardController::class, 'notification'])->name('notifikasi');
    Route::get('/terms', [DashboardController::class, 'terms'])->name('terms');
    Route::post('/feedback', [DashboardController::class, 'feedback'])->name('feedback');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/useredit/{id}', [DashboardController::class, 'userUpdate'])->name('user.update');

    // Static Pages
    Route::view('/help', 'dashboard.help')->name('help');
    Route::view('/kontak-divisi', 'dashboard.kontak-divisi')->name('kontak.divisi');
    Route::resource('manual-certificates', ExternalCertificateController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::post('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/avatar', [ProfileController::class, 'updateAvatar'])->name('setting.avatar');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('setting.password');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('setting.profile');
        Route::delete('/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('user.deleteAvatar');
    });

    // Training
    Route::prefix('training')->name('training.')->group(function () {
        Route::get('/', \App\Livewire\Training\TrainingIndex::class)->name('index');

        Route::delete('/{id}/reject', [TrainingController::class, 'reject'])->name('reject');
        Route::put('/{id}/approve', [TrainingController::class, 'approve'])->name('approve');

        // Settings
        Route::get('/settings/{id}', \App\Livewire\Training\Settings::class)->name('settings');
    });

    // ============================
    // Member Routes
    // ============================
    Route::middleware('isMember')->prefix('training')->name('training.')->group(function () {
        Route::get('/training/{id}', \App\Livewire\Training\Index::class)->name('home');
        Route::get('/members/{id}', \App\Livewire\Training\Members\Index::class)->name('members.index');
        Route::get('/tasks/{trainingId}', \App\Livewire\Training\Tasks\Index::class)->name('tasks');
        Route::get('/tasks/{trainingId}/detail/{taskId}', \App\Livewire\Training\Tasks\Show::class)->name('task.detail');
        Route::get('/materi/{trainingId}', \App\Livewire\Training\Materi\MateriIndex::class)->name('materi.index');
        Route::get('/materi/{trainingId}/create', \App\Livewire\Training\Materi\MateriCreate::class)->name('materi.create');
    });


    // Member Management
    Route::prefix('training/{trainingId}')->name('training.')->middleware('isMember')->group(function () {
        Route::get('/add-member', \App\Livewire\Training\Members\Add::class)->name('member.add.form');
        Route::get('/create-user-member', \App\Livewire\Training\Members\CreateUserAndMember::class)->name('member.create');
    });

    // ============================
    // Admin Routes
    // ============================
    Route::middleware(['check_role:Admin,Super Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('index');
        Route::get('/export-users', [DashboardController::class, 'exportUsers'])->name('export.users');
        Route::post('/user/add', [DashboardController::class, 'addUser'])->name('user.add');
        Route::delete('/user/{id}', [DashboardController::class, 'deleteUser'])->name('user.delete');

        Route::get('/admin/extcertificate/create', fn() => view('manual-certificates.create'))->name('certificate.create');
        Route::patch('/extcertificate/{extcertificateId}/accept', [DashboardController::class, 'acceptCertificate'])->name('certificate.accept');
        Route::patch('/extcertificate/{extcertificateId}/reject', [DashboardController::class, 'rejectCertificate'])->name('certificate.reject');

        // Training Management
        Route::get('/training/manage', \App\Livewire\Training\TrainingManage::class)->name('training.manage');

        Route::get('/training/{trainingId}/tasks/create', \App\Livewire\Training\Tasks\Create::class)->name('tasks.create');
        Route::get('/training/{trainingId}/tasks/{taskId}/review/{submissionId}', \App\Livewire\Training\Tasks\Review::class)->name('task.review');

        Route::get('/training/{trainingId}/attendance', App\Livewire\Training\Attendance\ManageTrainingAttendance::class)->name('training.attendance.manage');
        Route::get('/training/{trainingId}/attendance/create', App\Livewire\Training\Attendance\CreateAttendanceSession::class)->name('training.attendance.create');
    });
});