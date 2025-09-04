<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JenisTraining;
use App\Models\User;
use App\Models\Tasks;
use App\Models\TrainingMember;

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
            'name'             => 'required|string|max:255',
            'category'         => 'required|string',
            'client'           => 'required|string|max:255',
            'description'      => 'nullable|string',
        ]);

        Training::create([
            'name'             => $request->name,
            'category'         => $request->category,
            'client'           => $request->client,
            'description'      => $request->description,
            'jenis_training_id' => 3,//default ke customer request
            'status'           => 'pending',
        ]);

        return redirect()
            ->route('customer.requested')
            ->with('success', 'Permintaan pelatihan berhasil ditambahkan.');
    }

    public function crPage($id)
    {
        $training = Training::withCount(['members', 'materis', 'tasks'])->findOrFail($id);

        return view('pages.Training.pages.main', compact('training'));
    }

    public function schedule($id)
    {
        $training = Training::with('schedules')->findOrFail($id);
        return view('pages.Training.pages.schedule', compact('training'));
    }

    public function materials($id)
    {
        $training = Training::with('materis')->findOrFail($id);
        return view('pages.Training.pages.materi-moduls', compact('training'));
    }

    public function tasks($name)
    {
        $training = Training::findOrFail($name);
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
        $users = User::whereDoesntHave('trainingMembers')->get(); // hanya user yang belum terdaftar
        return view('pages.Training.addMember', compact('training', 'users'));
    }

    public function addMember(Request $request, $trainingId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $training = Training::findOrFail($trainingId);

        // Get or create training detail for this training
        $trainingDetail = $training->details()->firstOrCreate([]);

        // Check if user is already a member
        $existingMember = TrainingMember::where('training_detail_id', $trainingDetail->id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($existingMember) {
            return redirect()->back()->with('error', 'User sudah menjadi peserta dalam pelatihan ini.');
        }

        // Create new training member
        TrainingMember::create([
            'training_detail_id' => $trainingDetail->id,
            'user_id' => $request->user_id,
            'series' => 'TRN-' . strtoupper(uniqid()),
        ]);

        return redirect()->route('training.members', $trainingId)->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function settings($name)
    {
        $training = Training::where('name', $name)->firstOrFail();
        return view('pages.Training.pages.setting', compact('training'));
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
}