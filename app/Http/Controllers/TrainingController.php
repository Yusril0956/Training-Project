<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JenisTraining;
use App\Models\User;
use App\Models\Tasks;
use App\Models\TrainingMember;
use App\Models\Notification;
use App\Models\Certificate;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TrainingAcceptedNotification;
use App\Notifications\TrainingRejectedNotification;
use App\Notifications\TrainingInvitationNotification;
use App\Notifications\TrainingGraduatedNotification;
use App\Notifications\TrainingKickedNotification;

class TrainingController extends Controller
{
    /**
     * Halaman utama Training
     */
    public function index(Request $request)
    {
        $query = Training::with(['jenisTraining', 'detail', 'members', 'materis']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $trainings = $query->paginate(9);
        $userId = Auth::id();
        $userStatuses = [];

        foreach ($trainings as $training) {
            $member = $training->members->where('user_id', $userId)->first();
            $userStatuses[$training->id] = $member ? $member->status : 'none';
        }

        return view('training.index', compact('trainings', 'userStatuses', 'request'));
    }

    public function home($id)
    {
        $training = Training::withCount(['members', 'materis', 'tasks'])->findOrFail($id);
        $schedule = $training->schedules()->orderBy('date', 'asc')->first();

        return view('training.main', compact('training', 'schedule'));
    }

    /**
     * Halaman absen training
     */
    public function absen($id)
    {
        $training = Training::with(['detail', 'jenisTraining'])->findOrFail($id);
        $members = $training->members()->with(['user', 'attendance'])->get();

        return view('training.absen', compact('training', 'members'));
    }

    /**
     * Reject training request
     */
    public function reject($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'close';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil ditolak');
    }

    /**
     * Approve training request
     */
    public function approve($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'open';
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
            'description'      => 'nullable|string',
            'jenisTraining'    => 'required|exists:jenis_trainings,id',
            'status'           => 'required|in:open,close',
        ]);

        try {
            Training::create([
                'name'             => $request->name,
                'description'      => $request->description,
                'jenis_training_id' => $request->jenisTraining,
                'status'           => $request->status,
            ]);
            return redirect()->back()->with('success', 'Permintaan pelatihan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan pelatihan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Halaman jadwal training
     */
    public function schedule($id)
    {
        $training = Training::with('schedules')->findOrFail($id);
        return view('training.schedule.index', compact('training'));
    }

    /**
     * Simpan jadwal training (validasi)
     */
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

        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan jadwal: ' . $e->getMessage());
        }
    }

    /**
     * Hapus jadwal training
     */
    public function deleteSchedule($trainingId, $scheduleId)
    {
        try {
            $training = Training::findOrFail($trainingId);
            $schedule = $training->schedules()->findOrFail($scheduleId);
            $schedule->delete();
    
            return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus jadwal: ' . $e->getMessage());
        }
    }

    /**
     * Hapus member dari training
     */
    public function deleteMember($memberId, $trainingId)
    {
        try {
            $member = TrainingMember::findOrFail($memberId);
            $training = Training::findOrFail($trainingId);
            $user = $member->user;
            $member->delete();

            $user->notify(new TrainingKickedNotification($training));

            return redirect()->back()->with('success', 'Peserta telah dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus peserta: ' . $e->getMessage());
        }
    }

    /**
     * Halaman materi training
     */
    public function materials($id)
    {
        $training = Training::with('materis')->findOrFail($id);
        return view('training.materials.index', compact('training'));
    }



    /**
     * Halaman daftar member training
     */
    public function members($id)
    {
        $user = Auth::user();
        if ($user->roles()->whereIn('name', ['Admin', 'Super Admin'])->exists()) {
            $training = Training::with(['members' => function ($q) {
                $q->where('status', 'accept');
            }])->findOrFail($id);

            $pendingMembers = TrainingMember::with('user')->whereHas('trainingDetail', function ($q) use ($id) {
                $q->where('training_id', $id);
            })->where('status', 'pending')->get();

            $graduateMember = TrainingMember::with(['user.certificates' => function ($q) use ($id) {
                $q->where('training_id', $id);
            }])->whereHas('trainingDetail', function ($q) use ($id) {
                $q->where('training_id', $id);
            })->where('status', 'graduate')->get();

            return view('training.members.index', compact('training', 'pendingMembers', 'graduateMember'));
        } else {
            $userId = Auth::id();
            $training = Training::whereHas('members', function ($q) use ($userId) {
                $q->where('user_id', $userId)->whereIn('status', ['accept', 'graduate']);
            })
                ->with(['detail', 'jenisTraining', 'members'])
                ->findOrFail($id);

            return view('training.members.user-member', compact('training'));
        }
    }

    /**
     * Form tambah member ke training
     */
    public function showAddMemberForm($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        $users = User::whereDoesntHave('trainingMembers', function ($query) use ($trainingId) {
            $query->whereHas('trainingDetail', function ($q) use ($trainingId) {
                $q->where('training_id', $trainingId);
            });
        })->get();
        return view('training.members.add', compact('training', 'users'));
    }

    /**
     * Tambah user baru lalu daftarkan ke training
     */
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
            $request->merge(['user_ids' => [$newUser->id]]);
            return $this->addMember($request, $trainingId);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan user!');
        }
    }

    /**
     * Tambah member ke training
     */
    public function addMember(Request $request, $trainingId)
    {
        $request->validate([
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
            'message' => 'nullable|string|max:500',
        ]);

        try {
            $training = Training::findOrFail($trainingId);
            $trainingDetail = $training->detail;
            if (!$trainingDetail) {
                $trainingDetail = $training->detail()->create([
                    'start_date' => now()->toDateString(),
                    'end_date' => now()->addMonth()->toDateString(),
                ]);
            }

            $addedCount = 0;
            $skippedCount = 0;

            foreach ($request->user_ids as $userId) {
                $existingMember = TrainingMember::where('training_detail_id', $trainingDetail->id)
                    ->where('user_id', $userId)->where('status', 'accept')
                    ->first();

                if ($existingMember) {
                    $skippedCount++;
                    continue;
                }

                $newMember = TrainingMember::create([
                    'training_detail_id' => $trainingDetail->id,
                    'user_id' => $userId,
                    'status' => 'accept',
                    'series' => 'TRN-' . strtoupper(uniqid()),
                ]);

                $newMember->attendance()->create([
                    'attended_at' => now()->setTimezone('Asia/Jakarta'),
                    'status' => 'present',
                ]);

                // Notify the added user
                $newMember->user->notify(new TrainingInvitationNotification($training));

                $addedCount++;
            }

            $message = '';
            if ($addedCount > 0) $message .= "$addedCount peserta berhasil ditambahkan.";
            if ($skippedCount > 0) $message .= " $skippedCount peserta sudah terdaftar (diabaikan).";
            if ($request->message) $message .= " Pesan: " . $request->message;

            return redirect()->route('training.members', $trainingId)->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan peserta: ' . $e->getMessage());
        }
    }

    /**
     * Halaman pengaturan training
     */
    public function settings($name)
    {
        $training = Training::where('name', $name)->firstOrFail();
        return view('training.settings', compact('training'));
    }

    /**
     * Update pengaturan training
     */
    public function updateSettings(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,close',
        ]);

        try {
            $training = Training::findOrFail($id);
            $training->name = $request->name;
            $training->description = $request->description;
            $training->status = $request->status;
            $training->save();

            return redirect()->route('training.settings', $training->name)->with('success', 'Pengaturan pelatihan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui pengaturan: ' . $e->getMessage());
        }
    }

    /**
     * Admin menerima member training
     */
    public function acceptMember($trainingId, $memberId)
    {
        try {
            $member = TrainingMember::findOrFail($memberId);
            $member->update(['status' => 'accept']);

            $member->user->notify(new TrainingAcceptedNotification($member->trainingDetail->training));

            return redirect()->back()->with('success', 'Peserta telah diterima.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menerima peserta: ' . $e->getMessage());
        }
    }

    /**
     * Admin menolak member training
     */
    public function rejectMember($trainingId, $memberId)
    {
        try {
            $member = TrainingMember::findOrFail($memberId);
            $training = $member->trainingDetail->training;
            $user = $member->user;
            $member->delete();

            $user->notify(new TrainingRejectedNotification($training));

            return redirect()->back()->with('success', 'Peserta telah ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak peserta: ' . $e->getMessage());
        }
    }

    /**
     * Ambil status user pada training tertentu
     */
    public static function getUserTrainingStatus($training, $userId)
    {
        $member = $training->members->where('user_id', $userId)->first();
        return $member ? $member->status : 'none';
    }

    /**
     * Halaman manage training (eager loading + pagination)
     */
    public function tManage()
    {
        $trainings = Training::with('detail')->paginate(10);
        $jenisTraining = JenisTraining::all();
        return view('training.manage', compact('trainings', 'jenisTraining'));
    }

    /**
     * Hapus training beserta relasi terkait
     */
    public function destroy($trainingId)
    {
        try {
            $training = Training::findOrFail($trainingId);

            if ($training->detail) $training->detail->delete();
            $training->members()->delete();
            $training->schedules()->delete();
            $training->materis()->delete();

            foreach ($training->tasks as $task) {
                $task->submissions()->delete();
                $task->delete();
            }

            $training->certificates()->delete();
            $training->delete();

            return redirect()->route('admin.training.manage')->with('success', 'Pelatihan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus pelatihan: ' . $e->getMessage());
        }
    }

    /**
     * Tandai member sebagai lulus dan buat sertifikat
     */
    public function graduateMember(Request $request, $trainingId, $memberId)
    {
        try {
            $member = TrainingMember::findOrFail($memberId);
            $member->update(['status' => 'graduate']);

            $training = $member->trainingDetail->training;
            $user = $member->user;

            $data = [
                'user'             => $user,
                'training'         => $training->load('detail'),
                'certificateNumber' => strtoupper('CERT-' . $training->id . '-' . $user->id . '-' . now()->format('Ymd')),
                'supervisorName'   => 'Ir. Budi Santoso, M.T.',
            ];

            $pdf = PDF::loadView('certificate.template', $data)->setPaper('a4', 'landscape');
            $filename = 'certificates/' . $data['certificateNumber'] . '.pdf';
            Storage::disk('public')->put($filename, $pdf->output());

            Certificate::create([
                'user_id' => $member->user_id,
                'training_id' => $training->id,
                'name' => 'Sertifikat ' . $training->name,
                'organization' => 'PT Dirgantara Indonesia',
                'issue_date' => now()->toDateString(),
                'expiry_date' => null,
                'file_path' => $filename,
            ]);

            $member->user->notify(new TrainingGraduatedNotification($training));

            return redirect()->back()->with('success', 'Peserta telah ditandai sebagai lulus dan sertifikat telah dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menandai peserta sebagai lulus: ' . $e->getMessage());
        }
    }

    /**
     * Show feedback form untuk training
     */
    public function feedback($id)
    {
        $training = Training::findOrFail($id);
        return view('training.feedback', compact('training'));
    }

    /**
     * Submit feedback untuk training (validasi)
     */
    public function submitFeedback(Request $request, $id)
    {
        $request->validate([
            'nama_pengirim' => 'required|string|max:100',
            'pesan' => 'required|string',
        ]);

        try {
            Feedback::create([
                'nama_pengirim' => $request->nama_pengirim,
                'pesan' => $request->pesan,
                'tanggal_kirim' => now(),
            ]);
            return redirect()->route('training.feedback', $id)->with('success', 'Feedback berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim feedback!')->withInput();
        }
    }
}
