<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AssignmentController;
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
    Route::get('/auth/google/callback', function () {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name'      => $googleUser->getName(),
                'password'  => bcrypt(str()->random(16)),
                'google_id' => $googleUser->getId(),
            ]
        );

        Auth::login($user);

        if (!$user->phone || !$user->nik || !$user->address || !$user->city) {
            return redirect()->route('profile.complete');
        }

        return redirect()->route('index');
    });
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
    Route::view('/services', 'dashboard.services')->name('services');
    Route::view('/company-detail', 'dashboard.company-detail')->name('company.detail');
    Route::view('/production-statistics', 'dashboard.production-statistics')->name('production.statistics');
    Route::view('/fortal-hr', 'dashboard.fortal-hr')->name('fortal.hr');
    Route::view('/laporan-data', 'dashboard.laporan-data')->name('laporan.data');
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
        Route::get('/', [TrainingController::class, 'index'])->name('index');
        Route::get('/general-knowledge', [TrainingController::class, 'generalKnowledge'])->name('general');
        Route::get('/mandatory', [TrainingController::class, 'mandatory'])->name('mandatory');
        Route::get('/license', [TrainingController::class, 'license'])->name('license');
        Route::get('/customer-requested', [TrainingController::class, 'customerRequested'])->name('customer');

        Route::get('/create', [TrainingController::class, 'create'])->name('create');
        Route::post('/store', [TrainingController::class, 'store'])->name('store');

        Route::delete('/{id}/reject', [TrainingController::class, 'reject'])->name('reject');
        Route::put('/{id}/approve', [TrainingController::class, 'approve'])->name('approve');
        Route::get('/{idabsen}/', [TrainingController::class, 'absen'])->name('absen');
        Route::get('/{idabsen}/data', [TrainingController::class, 'absen'])->name('absen.data');

        // User Attendance with QR Code
        Route::get('/{id}/user-absen', [AttendanceController::class, 'userAbsen'])->name('user.absen');
        Route::get('/{id}/generate-qr', [AttendanceController::class, 'generateQR'])->name('generate.qr');
        Route::get('/{id}/download-qr', [AttendanceController::class, 'downloadQR'])->name('download.qr');
        Route::post('/{id}/process-qr', [AttendanceController::class, 'processQR'])->name('process.qr');

        // Settings
        Route::get('/settings/{name}', [TrainingController::class, 'settings'])->name('settings');
        Route::post('/setting/{id}/update', [TrainingController::class, 'updateSettings'])->name('settings.update');

        // Register
        Route::get('/register/{id}', [TrainingController::class, 'daftarTraining'])->name('register');
        Route::post('/{id}/self-register', [TrainingController::class, 'selfRegister'])->name('self.register');
    });

    // Certificates
    Route::resource('certificates', CertificateController::class)->only(['index', 'store', 'update', 'destroy']);

    // ============================
    // Member Routes
    // ============================
    Route::middleware('isMember')->prefix('training')->name('training.')->group(function () {
        Route::get('/training/{id}', [TrainingController::class, 'home'])->name('home');
        Route::get('/members/{id}', [TrainingController::class, 'members'])->name('members');
        Route::get('/materials/{id}', [TrainingController::class, 'materials'])->name('materials');
        Route::get('/schedule/{id}', [TrainingController::class, 'schedule'])->name('schedule');
        Route::post('/schedule/{id}', [TrainingController::class, 'storeSchedule'])->name('schedule.store');
        Route::delete('/schedule/{trainingId}/{scheduleId}', [TrainingController::class, 'deleteSchedule'])->name('schedule.delete');
        Route::get('/tasks/{id}', [TaskController::class, 'index'])->name('tasks');
        Route::post('/tasks/{trainingId}/{taskId}/submit', [TaskController::class, 'submit'])->name('task.submit');
        Route::post('/tasks/{trainingId}/{taskId}/edit', [TaskController::class, 'editTask'])->name('task.edit');
        Route::post('/{trainingName}/tasks/{taskId}/submit', [TaskController::class, 'submit'])->name('training.task.submit');
        Route::get('/tasks/{trainingId}/detail/{taskId}', [TaskController::class, 'show'])->name('task.detail');
        Route::get('/feedback/{id}', [TrainingController::class, 'feedback'])->name('feedback');
        Route::post('/training/{id}/feedback', [TrainingController::class, 'submitFeedback'])->name('feedback.submit');
    });


    // Member Management
    Route::prefix('training/{id}')->name('training.')->middleware('isMember')->group(function () {
        Route::get('/add-member', [TrainingController::class, 'showAddMemberForm'])->name('member.add.form');
        Route::post('/add-member', [TrainingController::class, 'addMember'])->name('member.add');
        Route::post('/add-member-user', [TrainingController::class, 'addUserMember'])->name('member.add.user');
    });

    // ============================
    // Admin Routes
    // ============================
    Route::middleware(['check_role:Admin,Super Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('index');
        Route::get('/export-users', [DashboardController::class, 'exportUsers'])->name('export.users');
        Route::post('/user/add', [DashboardController::class, 'addUser'])->name('user.add');
        Route::delete('/user/{id}', [DashboardController::class, 'deleteUser'])->name('user.delete');

        Route::get('/setting', [DashboardController::class, 'adminSettings'])->name('settings');
        Route::post('/settings/reset-password/{id}', [DashboardController::class, 'resetUserPassword'])->name('reset.password');

        Route::get('/admin/extcertificate/create', fn() => view('manual-certificates.create'))->name('certificate.create');
        Route::patch('/extcertificate/{extcertificateId}/accept', [DashboardController::class, 'acceptCertificate'])->name('certificate.accept');
        Route::patch('/extcertificate/{extcertificateId}/reject', [DashboardController::class, 'rejectCertificate'])->name('certificate.reject');

        // Training Management
        Route::get('/training/manage', [TrainingController::class, 'tManage'])->name('training.manage');
        Route::delete('/training/{trainingId}', [TrainingController::class, 'destroy'])->name('training.destroy');
        Route::patch('/training/{trainingId}/member/{memberId}/accept', [TrainingController::class, 'acceptMember'])->name('training.member.accept');
        Route::patch('/training/{trainingId}/member/{memberId}/reject', [TrainingController::class, 'rejectMember'])->name('training.member.reject');
        Route::get('/training/{trainingId}/member/{memberId}/graduate', [TrainingController::class, 'graduateMember'])->name('training.member.graduate');
        Route::get('/member/delete/{memberId}/{trainingId}', [TrainingController::class, 'deleteMember'])->name('training.member.delete.get');
        Route::delete('/member/delete/{memberId}/{trainingId}', [TrainingController::class, 'deleteMember'])->name('training.member.delete');

        Route::get('/training/{trainingId}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/training/{trainingId}/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/training/{trainingId}/tasks/', [TaskController::class, 'index'])->name('submission.download');
        Route::get('/training/{trainingId}/tasks/{taskId}/review/{submissionId}', [TaskController::class, 'reviewTaskSubmission'])->name('task.review');
        Route::post('training/tasks/review/{submissionId}', [TaskController::class, 'storeReview'])->name('submission.review.store');
    });
});

// ============================
// Public Routes
// ============================
Route::view('/sistem-training', 'training.system')->name('sistem-training');
Route::view('/404', 'errors.training-404')->name('404');
Route::get('/calendar/events', [ScheduleController::class, 'events'])->name('calendar.events');