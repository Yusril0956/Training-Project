<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JenisTraining;
use App\Models\User;
use App\Models\Tasks;
use App\Models\TrainingMember;
use App\Models\Notification;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    /**
     * Halaman utama Training
     */
    public function index()
    {
        $trainings = Training::with(['jenisTraining', 'detail', 'members', 'materis'])
            ->where('status', 'approved')
            ->paginate(9);

        $userId = Auth::id();

        // Prepare arrays to hold user statuses for each training
        $userStatuses = [];

        foreach ($trainings as $training) {
            $member = $training->members->where('user_id', $userId)->first();
            $userStatuses[$training->id] = $member ? $member->status : 'none';
            $status = $userStatuses[$training->id] ?? 'none';
        }

        return view('training.index', compact('trainings', 'userStatuses', 'status'));
    }

    public function absen($id)
    {
        $training = Training::with(['detail', 'jenisTraining'])->findOrFail($id);

        // Load members with attendance eager loaded
        $members = $training->members()->with(['user', 'attendance'])->get();

        return view('training.absen', compact('training', 'members'));
    }

    public function markAttendance($memberId)
    {
        $member = TrainingMember::findOrFail($memberId);

        // Check if attendance already exists
        if ($member->attendance()->count() > 0) {
            // Update attended_at to current time to reflect actual click time
            $attendance = $member->attendance()->latest()->first();
            $attendance->attended_at = now()->setTimezone('Asia/Jakarta');
            $attendance->save();

            return redirect()->back()->with('success', 'Waktu absen berhasil diperbarui.');
        }

        $member->attendance()->create([
            'attended_at' => now()->setTimezone('Asia/Jakarta'),
            'status' => 'present',
        ]);

        return redirect()->back()->with('success', 'Absen berhasil dicatat.');
    }

    public function generalKnowledge(Request $request)
    {
        $jenisGK = JenisTraining::where('code', 'GK')->firstOrFail();

        // Eager-load relasi yang benar dan eksekusi query-nya
        $trainings = Training::where('jenis_training_id', $jenisGK->id)
            ->with(['materis', 'detail', 'members'])
            ->paginate(9);  // ganti ->get() kalau tidak perlu pagination



        $pageTitle = 'General Knowledge Training';
        $heroTitle = 'General Knowledge Training';
        $description = 'Pelatihan umum untuk meningkatkan pengetahuan karyawan.';
        $breadcrumbItems = [
            ['title' => 'Training', 'url' => route('training.index')],
            ['title' => 'General Knowledge', 'url' => route('general.knowledge')],
        ];
        $routeName = 'general.knowledge';

        return view('training.mandatory', compact('trainings', 'jenisGK', 'pageTitle', 'heroTitle', 'description', 'breadcrumbItems', 'routeName'));
    }

    public function mandatory(Request $request)
    {
        $jenisMD = JenisTraining::where('code', 'MD')->firstOrFail();

        // Eager-load relasi yang benar dan eksekusi query-nya
        $trainings = Training::where('jenis_training_id', $jenisMD->id)
            ->with(['materis', 'detail', 'members'])
            ->paginate(9);  // ganti ->get() kalau tidak perlu pagination

        $userId = Auth::id();

        // Prepare arrays to hold user statuses for each training
        $userStatuses = [];

        foreach ($trainings as $training) {
            $member = $training->members->where('user_id', $userId)->first();
            $userStatuses[$training->id] = $member ? $member->status : 'none';
        }

        return view('training.mandatory', compact('trainings', 'jenisMD', 'userStatuses'));
    }

    public function license(Request $request)
    {
        $jenisLS = JenisTraining::where('code', 'LS')->firstOrFail();

        // Eager-load relasi yang benar dan eksekusi query-nya
        $trainings = Training::where('jenis_training_id', $jenisLS->id)
            ->with(['materis', 'detail', 'members'])
            ->paginate(9);

        $pageTitle = 'License Training';
        $heroTitle = 'License Training';
        $description = 'Pelatihan resmi dengan masa berlaku untuk sertifikasi dan lisensi.';
        $breadcrumbItems = [
            ['title' => 'Training', 'url' => route('training.index')],
            ['title' => 'License', 'url' => route('license.training')],
        ];
        $routeName = 'license.training';

        return view('training.mandatory', compact('trainings', 'jenisLS', 'pageTitle', 'heroTitle', 'description', 'breadcrumbItems', 'routeName'));
    }

    /**
     * Halaman Customer Requested Training
     */

    public function customerRequested()
    {
        $jenisCR = JenisTraining::where('code', 'CR')->first();

        $trainings = Training::where('jenis_training_id', $jenisCR->id)->get();

        // $trainings = Training::all();
        $approvedTrainings = Training::where('status', 'approved')->where('jenis_training_id', $jenisCR->id)->get();
        $modalId = 'action-training';
        $modalTitle = 'Action';
        $modalDescription = 'Silahkan pilih tindakan yang diinginkan.';
        $modalButton1 = 'Reject';
        $modalButton2 = 'Approve';


        return view('training.customer-requested', compact('trainings', 'jenisCR', 'modalId', 'modalTitle', 'modalDescription', 'modalButton1', 'modalButton2', 'approvedTrainings'));
    }

    /**
     * Halaman detail Training
     */
    public function detail($id)
    {
        $training = Training::findOrFail($id);
        $modalId = 'reject-training'; // ID unik untuk modal
        $modalId = 'tolak-training';
        $modalTitle = 'Apa kamu yakin?';
        $modalDescription = 'Tolak permintaan kelas training';
        $modalButton = 'Tolak';
        $formAction = route('training.reject', $training->id);
        $formMethod = 'DELETE';

        return view('training.detail', compact('training', 'modalId', 'modalTitle', 'modalDescription', 'modalButton', 'formAction', 'formMethod'));
    }

    public function reject($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'rejected';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil ditolak');
    }

    public function approve($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'approved';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil disetujui');
    }

    /**
     * Simpan data Training baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'category'         => 'required|string',
            'description'      => 'nullable|string',
        ]);

        Training::create([
            'name'             => $request->name,
            'category'         => $request->category,
            'description'      => $request->description,
            'jenis_training_id' => 3, //default ke customer request
            'status'           => 'pending',
        ]);

        return redirect()
            ->route('admin.training.manage')
            ->with('success', 'Permintaan pelatihan berhasil ditambahkan.');
    }

    public function home($id)
    {
        $training = Training::withCount(['members', 'materis', 'tasks'])->findOrFail($id);
        $schedule = $training->schedules()->orderBy('date', 'asc')->first();

        return view('training.customer-requested', compact('training', 'schedule'));
    }

    public function schedule($id)
    {
        $training = Training::with('schedules')->findOrFail($id);
        return view('training.schedule.index', compact('training'));
    }

    public function storeSchedule(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
        ]);

        $training = Training::findOrFail($id);

        $training->schedules()->create([
            'title' => $request->title,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'instructor' => $request->instructor,
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function deleteSchedule($trainingId, $scheduleId)
    {
        $training = Training::findOrFail($trainingId);
        $schedule = $training->schedules()->findOrFail($scheduleId);

        $schedule->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }

    public function deleteMember($memberId, $trainingId)
    {
        $member = TrainingMember::findOrFail($memberId);
        $member->delete();

        $training = Training::findOrFail($trainingId);

        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Kick Training' . $training->name,
            'message' => 'Anda telah dikeluarkan dari training' . $training->name,
        ]);

        return redirect()->back()->with('success', 'Peserta telah dihapus.');
    }

    public function materials($id)
    {
        $training = Training::with('materis')->findOrFail($id);
        return view('training.materials.index', compact('training'));
    }

    public function tasks($name)
    {
        $training = Training::findOrFail($name);
        return view('training.tasks.index', compact('training'));
    }

    public function showTasks($trainingId, $taskId)
    {
        $training = Training::findOrFail($trainingId);
        $task = Tasks::with(['training', 'submissions.user'])->findOrFail($taskId);
        return view('training.tasks.show', compact('training', 'task'));
    }

    public function members($id)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->roles()->whereIn('name', ['Admin', 'Super Admin'])->exists()) {
            $training = Training::with(['members' => function ($q) {
                $q->where('status', 'accept');
            }])->findOrFail($id);

            $pendingMembers = TrainingMember::with('user')->whereHas('trainingDetail', function ($q) use ($id) {
                $q->where('training_id', $id);
            })->where('status', 'pending')->get();

            $graduateMember = TrainingMember::with('user')->whereHas('trainingDetail', function ($q) use ($id) {
                $q->where('training_id', $id);
            })->where('status', 'graduate')->get();


            return view('training.members.index', compact('training', 'pendingMembers', 'graduateMember'));
        } else {
            $userId = Auth::id();

            $training = Training::whereHas('members', function ($q) use ($userId) {
                $q->where('user_id', $userId)->where('status', 'accept');
            })
                ->with(['detail', 'jenisTraining', 'members'])
                ->findOrFail($id);

            return view('training.members.user-member', compact('training'));
        }
    }

    public function showAddMemberForm($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        $users = User::whereDoesntHave('trainingMembers', function ($query) use ($trainingId) {
            $query->whereHas('trainingDetail', function ($q) use ($trainingId) {
                $q->where('training_id', $trainingId);
            });
        })->get(); // hanya user yang belum terdaftar di training ini
        return view('training.members.add', compact('training', 'users'));
    }

    public function addUserMember(Request $request, $trainingId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:6',
            'email' => 'required|email|unique:users,email',
            'status' => 'required',
        ]);

        try {
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nik' => $request->nik,
                'password' => $request->nik,
                'role' => 'user',
                'status' => $request->status,
            ]);
            $request->merge(['user_ids' => [$newUser->id]]); // tambahkan user_id baru ke request
            return $this->addMember($request, $trainingId);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan user!');
        }
    }

    public function addMember(Request $request, $trainingId)
    {
        $request->validate([
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
            'message' => 'nullable|string|max:500',
        ]);

        $training = Training::findOrFail($trainingId);

        // Get or create training detail for this training
        $trainingDetail = $training->detail;
        if (!$trainingDetail) {
            // Provide default start_date and end_date if creating new training detail
            $trainingDetail = $training->detail()->create([
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonth()->toDateString(),
            ]);
        }

        $addedCount = 0;
        $skippedCount = 0;
        $errors = [];

        foreach ($request->user_ids as $userId) {
            // Check if user is already a member
            $existingMember = TrainingMember::where('training_detail_id', $trainingDetail->id)
                ->where('user_id', $userId)->where('status', 'accept')
                ->first();

            if ($existingMember) {
                $skippedCount++;
                continue;
            }

            // Create new training member
            $newMember = TrainingMember::create([
                'training_detail_id' => $trainingDetail->id,
                'user_id' => $userId,
                'status' => 'accept',
                'series' => 'TRN-' . strtoupper(uniqid()),
            ]);

            // Create attendance record automatically
            $newMember->attendance()->create([
                'attended_at' => now()->setTimezone('Asia/Jakarta'),
                'status' => 'present',
            ]);

            $addedCount++;
        }

        // Prepare success message
        $message = '';
        if ($addedCount > 0) {
            $message .= "$addedCount peserta berhasil ditambahkan.";
        }
        if ($skippedCount > 0) {
            $message .= " $skippedCount peserta sudah terdaftar (diabaikan).";
        }

        if ($request->message) {
            $message .= " Pesan: " . $request->message;
        }

        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Anda telah ditambahkan ke ' . $training->name,
            'message' => 'Anda telah ditambahkan ke ' . $training->name . 'selamat datang',
        ]);

        return redirect()->route('training.members', $trainingId)->with('success', $message);
    }

    public function settings($name)
    {
        $training = Training::where('name', $name)->firstOrFail();
        return view('training.settings', compact('training'));
    }

    public function updateSettings(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $training = Training::findOrFail($id);
        $training->name = $request->name;
        $training->category = $request->category;
        $training->description = $request->description;
        $training->status = $request->status;
        $training->save();

        return redirect()->route('training.settings', $training->name)->with('success', 'Pengaturan pelatihan berhasil diperbarui!');
    }

    public function selfRegister(Request $request, $trainingId)
    {
        $training = Training::findOrFail($trainingId);

        // Get or create training detail
        $trainingDetail = $training->detail;
        if (!$trainingDetail) {
            // Provide default start_date and end_date if creating new training detail
            $trainingDetail = $training->detail()->create([
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonth()->toDateString(),
            ]);
        }

        // Check if user is already registered
        $existingMember = TrainingMember::where('training_detail_id', $trainingDetail->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingMember) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar sebagai peserta training ini.');
        }
        // Create new training member

        // Create new training member with pending status
        TrainingMember::create([
            'training_detail_id' => $trainingDetail->id,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'series' => 'TRN-' . strtoupper(uniqid()),
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Status Anda sedang menunggu persetujuan admin.');
    }

    public function acceptMember($trainingId, $memberId)
    {
        $member = TrainingMember::findOrFail($memberId);
        $member->update(['status' => 'accept']);

        // Create notification
        Notification::create([
            'user_id' => $member->user_id,
            'title' => 'Pendaftaran Training Diterima',
            'message' => 'Selamat! Pendaftaran Anda untuk training "' . $member->trainingDetail->training->name . '" telah diterima.',
        ]);

        return redirect()->back()->with('success', 'Peserta telah diterima.');
    }

    public function rejectMember($trainingId, $memberId)
    {
        $member = TrainingMember::findOrFail($memberId);
        $member->delete();

        // Create notification
        Notification::create([
            'user_id' => $member->user_id,
            'title' => 'Pendaftaran Training Ditolak',
            'message' => 'Maaf, pendaftaran Anda untuk training "' . $member->trainingDetail->training->name . '" telah ditolak.',
        ]);

        return redirect()->back()->with('success', 'Peserta telah ditolak.');
    }

    public static function getUserTrainingStatus($training, $userId)
    {
        $member = $training->members->where('user_id', $userId)->first();
        if ($member) {
            return $member->status;
        }
        return 'none';
    }

    public function tManage()
    {
        $trainings = Training::with('detail')->paginate(10);
        $jenisTraining = JenisTraining::all();
        return view('training.manage', compact('trainings', 'jenisTraining'));
    }

    public function destroy($trainingId)
    {
        $training = Training::findOrFail($trainingId);

        // Delete related records first
        if ($training->detail) {
            $training->detail->delete();
        }

        // Delete training members and their related records
        $training->members()->delete();

        // Delete schedules
        $training->schedules()->delete();

        // Delete materials
        $training->materis()->delete();

        // Delete tasks and their submissions
        foreach ($training->tasks as $task) {
            $task->submissions()->delete();
            $task->delete();
        }

        // Delete certificates
        $training->certificates()->delete();

        // Finally delete the training
        $training->delete();

        return redirect()->route('admin.training.manage')->with('success', 'Pelatihan berhasil dihapus.');
    }

    public function register($userId, $trainingId)
    {
        $user = User::findOrFail($userId);
        $training = Training::findOrFail($trainingId);

        $user->trainingMembers()->create([
            'training_detail_id' => $training->detail->id,
            'status' => 'pending',
            'series' => 'TRN-' . strtoupper(uniqid()),
        ]);

        return redirect()->back()->with('success', 'Selamat! Anda berhasil mendaftar sebagai peserta training "' . $training->name . '".');
    }

    public function graduateMember(Request $request, $trainingId, $memberId)
    {
        $member = TrainingMember::findOrFail($memberId);
        $member->update(['status' => 'graduate']);

        $training = $member->trainingDetail->training;

        $user = $request->user();

        // Siapkan data untuk sertifikat
        $data = [
            'user'             => $user,
            'training'         => $training->load('detail'),
            'certificateNumber' => strtoupper('CERT-' . $training->id . '-' . $user->id . '-' . now()->format('Ymd')),
        ];

        // Render Blade menjadi PDF (A4 landscape)
        $pdf = PDF::loadView('certificate.template', $data)
            ->setPaper('a4', 'landscape');

        // Simpan ke disk public/storage/certificates
        $filename = 'certificates/' . $data['certificateNumber'] . '.pdf';
        Storage::disk('public')->put($filename, $pdf->output());

        // Create certificate record with correct file_path
        Certificate::create([
            'user_id' => $member->user_id,
            'training_id' => $training->id,
            'name' => 'Sertifikat ' . $training->name,
            'organization' => 'PT Dirgantara Indonesia',
            'issue_date' => now()->toDateString(),
            'expiry_date' => null,
            'file_path' => $filename,
        ]);



        // Create notification
        Notification::create([
            'user_id' => $member->user_id,
            'title' => 'Selamat! Anda telah lulus dari Training',
            'message' => 'Selamat! Anda telah lulus dari training "' . $training->name . '" dan menerima sertifikat.',
        ]);

        return redirect()->back()->with('success', 'Peserta telah ditandai sebagai lulus dan sertifikat telah dibuat.');
    }
}
