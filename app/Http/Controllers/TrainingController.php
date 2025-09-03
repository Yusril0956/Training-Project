<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JenisTraining;
use App\Models\User;
use App\Models\Tasks;

class TrainingController extends Controller
{
    /**
     * Halaman utama Training
     */
    public function index()
    {
        return view('pages.Training.index');
    }

    /**
     * Halaman Customer Requested Training
     */
    public function customerRequested()
    {
        $trainings = Training::all();
        $jenisTrainings = JenisTraining::all();
        $approvedTrainings = Training::where('status', 'approved')->get();
        $modalId = 'action-training';
        $modalTitle = 'Action';
        $modalDescription = 'Silahkan pilih tindakan yang diinginkan.';
        $modalButton1 = 'Reject';
        $modalButton2 = 'Approve';


        return view('pages.Training.customer_requested', compact('trainings', 'jenisTrainings', 'modalId', 'modalTitle', 'modalDescription', 'modalButton1', 'modalButton2', 'approvedTrainings'));
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

        return view('pages.Training.detail_training', compact('training', 'modalId', 'modalTitle', 'modalDescription', 'modalButton', 'formAction', 'formMethod'));
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
            'nama'             => 'required|string|max:255',
            'kategori'         => 'required|string',
            'klien'            => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'jenis_training_id' => 'required|exists:jenis_training,id',
        ]);

        Training::create([
            'nama'             => $request->nama,
            'kategori'         => $request->kategori,
            'klien'            => $request->klien,
            'deskripsi'        => $request->deskripsi,
            'jenis_training_id' => $request->jenis_training_id,
            'status'           => 'pending',
        ]);

        return redirect()
            ->route('customer.requested')
            ->with('success', 'Permintaan pelatihan berhasil ditambahkan.');
    }

    public function crPage($id)
    {
        $training = Training::findOrFail($id);
        $members_count = Training::count('member');
        return view('pages.Training.pages.main', compact('training', 'members_count'));
    }

    public function materials($id)
    {
        $training = Training::with('materials')->findOrFail($id);
        return view('pages.Training.pages.materi-moduls', compact('training'));
    }

    public function tasks($id)
    {
        $training = Training::findOrFail($id);
        return view('pages.Training.pages.tasks', compact('training'));
    }

    public function showTasks($trainingId, $taskId)
    {
        $training = Training::findOrFail($trainingId);
        $task = Tasks::with(['training', 'submissions.user'])->findOrFail($taskId);
        return view('pages.Training.pages.taskDetail', compact('training', 'task'));
    }
    public function members($id)
    {
        $training = Training::with('members')->findOrFail($id);
        return view('pages.Training.pages.members', compact('training'));
    }

    public function showAddMemberForm($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        $users = User::whereNull('training_id')->where('role', 'user')->get(); // hanya user yang belum terdaftar
        return view('pages.Training.addMember', compact('training', 'users'));
    }

    public function addMember(Request $request, $trainingId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->training_id = $trainingId;
        $user->save();

        return redirect()->route('training.members', $trainingId)->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function settings($nama)
    {
        $training = Training::where('nama', $nama)->firstOrFail();
        return view('pages.Training.pages.setting', compact('training'));
    }

    public function updateSettings(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $training = Training::findOrFail($id);
        $training->nama = $request->name;
        $training->kategori = $request->kategori;
        $training->deskripsi = $request->deskripsi;
        $training->status = $request->status;
        $training->save();

        return redirect()->route('training.settings', $training->nama)->with('success', 'Pengaturan pelatihan berhasil diperbarui!');
    }
}