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
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AssignmentController; 


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
    Route::get('/history', [DashboardController::class, 'history'])->name('history');
    Route::get('/notifikasi', [DashboardController::class, 'notification'])->name('notifikasi');
    Route::get('/help', fn() => view('pages.help'))->name('help');
    Route::get('/services', fn() => view('pages.services'))->name('services');
    Route::get('/company-detail', fn() => view('pages.company-detail'))->name('company.detail');
    Route::get('/production-statistics', fn() => view('pages.production-statistics'))->name('production.statistics');
    Route::get('/fortal-hr', fn() => view('pages.fortal-hr'))->name('fortal.hr');
    Route::get('/laporan-data', fn() => view('pages.laporan-data'))->name('laporan.data');
    Route::get('/kontak-divisi', fn() => view('pages.kontak-divisi'))->name('kontak.divisi');
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
    Route::get('/training/general-knowledge', [TrainingController::class, 'generalKnowledge'])->name('general.knowledge');
    Route::get('/training/mandatory', [TrainingController::class, 'mandatory'])->name('mandatory.training');
    Route::get('/training/license', [TrainingController::class, 'license'])->name('license.training');
    Route::get('/training/customer-requested', [TrainingController::class, 'customerRequested'])->name('customer.requested');
    Route::get('/training/detail-training', fn() => view('pages.Training.detail_training'))->name('detail.training');
    Route::get('/training/{id}/detail', [TrainingController::class, 'detail'])->name('training.detail');
    Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::post('/training/store', [TrainingController::class, 'store'])->name('training.store');
    Route::delete('/training/{id}/reject', [TrainingController::class, 'reject'])->name('training.reject');
    Route::put('/training/{id}/approve', [TrainingController::class, 'approve'])->name('training.approve');
    Route::get('/training/{idabsen}/', [TrainingController::class, 'absen'])->name('training.absen');
    Route::post('/training/absen/mark/{memberId}', [TrainingController::class, 'markAttendance'])->name('training.absen.mark');

    Route::get('/training/customer-requested/tasks/{taskId}/{trainingId}', [TrainingController::class, 'showTasks'])->name('training.task.show');
    Route::get('/gj', [TrainingController::class, 'showTasks'])->name('training.task.submit');

    // training setting
    Route::get('/training/customer-requested/settings/{name}', [TrainingController::class, 'settings'])->name('training.settings');
    Route::post('/training/setting/{id}/update', [TrainingController::class, 'updateSettings'])->name('training.settings.update');

    Route::get('/training/register/{id}', [TrainingController::class, 'daftarTraining'])->name('training.register');

    // Self registration for training
    Route::post('/training/{id}/self-register', [TrainingController::class, 'selfRegister'])->name('training.self.register');

    // Route::post('training/{id}/tasks', [TaskController::class, 'store'])->name('training.task.create');
    // Route::delete('training/{id}/tasks/{taskId}', [TaskController::class, 'destroy'])->name('training.task.delete');

    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');

    // Tambahkan dua rute ini
    Route::put('/certificates/{certificate}', [CertificateController::class, 'update'])->name('certificates.update');
    Route::delete('/certificates/{certificate}', [CertificateController::class, 'destroy'])->name('certificates.destroy');

    // Schedule routes


    // ============================
    // Member training Routes
    // ============================
    Route::middleware('isMember')->group(function () {
        Route::get('/training/customer-requested/{id}', [TrainingController::class, 'crPage'])->name('cr.page');

        Route::get('/training/customer-requested/members/{id}', [TrainingController::class, 'members'])->name('training.members');
        Route::get('/training/customer-requested/materials/{id}', [TrainingController::class, 'materials'])->name('training.materials');
        Route::get('/training/customer-requested/schedule/{id}', [TrainingController::class, 'schedule'])->name('training.schedule');
        Route::post('/training/customer-requested/schedule/{id}', [TrainingController::class, 'storeSchedule'])->name('training.schedule.store');
        Route::delete('/training/customer-requested/schedule/{trainingId}/{scheduleId}', [TrainingController::class, 'deleteSchedule'])->name('training.schedule.delete');
        Route::get('/training/customer-requested/tasks/{name}', [TrainingController::class, 'tasks'])->name('training.tasks');
        Route::get('/training/customer-requested/feedback/{id}', [TrainingController::class, 'feedback'])->name('training.feedback');
        Route::get('training/{id}/add-member', [TrainingController::class, 'showAddMemberForm'])->name('training.member.add.form');
        Route::post('training/{id}/add-member', [TrainingController::class, 'addMember'])->name('training.member.add');
        Route::post('training/{id}/add-member-user', [TrainingController::class, 'addUserMember'])->name('add.user.member');
    });

    // ============================
    // Admin & Super Admin Routes
    // ============================
    Route::middleware(['check_role:Admin,Super Admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
        Route::post('/admin/user/add', [DashboardController::class, 'addUser'])->name('users.create');
        Route::delete('/admin/user/{id}', [DashboardController::class, 'deleteUser'])->name('admin.user.delete');
        Route::get('/admin/example-modal', [DashboardController::class, 'exampleModal'])->name('admin.example.modal');
        Route::get('/setting', [DashboardController::class, 'adminSettings'])->name('admin.settings');
        Route::post('/admin/settings/open-access', [DashboardController::class, 'openAllAccess'])->name('admin.open.access');
        Route::post('/admin/settings/delete-database', [DashboardController::class, 'deleteDatabase'])->name('admin.delete.database');
        Route::post('/admin/settings/reset-password/{id}', [DashboardController::class, 'resetUserPassword'])->name('admin.reset.password');

        // training admin
        Route::get('/training/manage', [TrainingController::class, 'tManage'])->name('training.manage');
        Route::patch('/training/{trainingId}/member/{memberId}/accept', [TrainingController::class, 'acceptMember'])->name('training.member.accept');
        Route::patch('/training/{trainingId}/member/{memberId}/reject', [TrainingController::class, 'rejectMember'])->name('training.member.reject');
        Route::get('/training/{trainingId}/member/{memberId}/graduate', [TrainingController::class, 'graduateMember'])->name('training.member.graduate');
        Route::get('/member/delete/{memberId}/{trainingId}', [TrainingController::class, 'deleteMember'])->name('training.member.delete');
    });
});


Route::get('/404', function () {
    return response()->view('pages.Training.errors.404', [], 404);
})->name('404');

Route::get('/sistem-training', function () {
    return view('pages.sistem-training');
})->name('sistem-training');

Route::get('/calendar/events', [ScheduleController::class, 'events'])->name('calendar.events');


Route::prefix('training/{trainingId}/assignments')->group(function () {
    Route::get('/', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/', [AssignmentController::class, 'store'])->name('assignments.store');
});

Route::post('/assignments/{assignmentId}/submit', [AssignmentController::class, 'submit'])->name('assignments.submit');
Route::get('/assignments/{assignmentId}/submissions', [AssignmentController::class, 'submissions'])->name('assignments.submissions');
Route::post('/submissions/{submissionId}/grade', [AssignmentController::class, 'grade'])->name('assignments.grade');
