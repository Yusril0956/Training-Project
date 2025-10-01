<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Tasks;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * List semua tugas pada training tertentu
     */
    public function index($id)
    {
        $training = Training::with(['tasks' => function ($q) {
            $q->latest();
        }])->findOrFail($id);

        $tasks = $training->tasks()->latest()->paginate(10);

        return view('training.tasks.index', compact('training', 'tasks'));
    }

    /**
     * Simpan tugas baru ke training
     */
    public function store(Request $request, $trainingId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'training_id' => 'required|exists:trainings,id',
            'deadline' => 'required|date',
            'attachment' => 'nullable|file|max:5120',
        ]);

        $path = $request->file('attachment')?->store('attachments', 'public');

        try {
            $task = Tasks::create([
                'title' => $request->title,
                'description' => $request->description,
                'training_id' => $request->training_id,
                'deadline' => $request->deadline,
                'attachment_path' => $path,
            ]);
    
            // Notifikasi ke semua member yang diterima (eager loading user)
            $training = Training::with(['members.user'])->findOrFail($trainingId);
            $acceptedMembers = $training->members->where('status', 'accept');
    
            foreach ($acceptedMembers as $member) {
                if ($member->user) {
                    $member->user->notify(new \App\Notifications\TaskNotification($task));
                }
            }
    
            return redirect()->route('training.tasks', $trainingId)
                ->with('success', 'Tugas berhasil ditambahkan dan notifikasi telah dikirim ke semua peserta.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tugas gagal ditambahkan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan detail tugas beserta submission
     */
    public function show($trainingId, $taskId)
    {
        $training = Training::findOrFail($trainingId);
        $task = Tasks::with(['submissions.user'])->where('training_id', $trainingId)->findOrFail($taskId);

        return view('training.tasks.show', compact('task', 'training'));
    }

    /**
     * Form tambah tugas
     */
    public function create($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        return view('training.tasks.create', compact('training'));
    }

    /**
     * Submit tugas oleh user
     */
    public function submit(Request $request, $trainingName, $taskId)
    {
        $request->validate([
            'submission_file' => 'required|file|max:5120',
            'message' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $task = Tasks::findOrFail($taskId);

        // Cek submission sebelumnya
        $existingSubmission = TaskSubmission::where('user_id', $user->id)
            ->where('task_id', $taskId)
            ->first();

        if ($existingSubmission) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini sebelumnya.');
        }

        // Upload file
        $filePath = null;
        if ($request->hasFile('submission_file')) {
            $originalFileName = $request->file('submission_file')->getClientOriginalName();
            $userName = str_replace(' ', '_', $user->name);
            $extension = $request->file('submission_file')->getClientOriginalExtension();
            $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $userName . '.' . $extension;

            $filePath = $request->file('submission_file')->storeAs(
                'task_submissions/' . $task->title,
                $newFileName,
                'public'
            );
        }

        try {
            TaskSubmission::create([
                'user_id' => $user->id,
                'task_id' => $taskId,
                'answer' => $request->message,
                'file_path' => $filePath,
                'submitted_at' => now(),
            ]);
    
            return back()->with('success', 'Tugas berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim tugas: ' . $e->getMessage());
        }
    }

    /**
     * Hapus tugas beserta submission-nya
     */
    public function destroy($trainingId, $taskId)
    {
        $task = Tasks::where('training_id', $trainingId)->findOrFail($taskId);
        $task->submissions()->delete();
        $task->delete();

        return back()->with('success', 'Tugas berhasil dihapus.');
    }

    /**
     * Review submission tugas
     */
    public function reviewTaskSubmission($trainingId, $taskId, $submissionId)
    {
        $training = Training::findOrFail($trainingId);
        $task = Tasks::findOrFail($taskId);
        $submission = TaskSubmission::with('user')->where('task_id', $taskId)->findOrFail($submissionId);

        return view('training.tasks.review', compact('training', 'task', 'submission'));
    }

    /**
     * Simpan review penilaian tugas
     */
    public function storeReview(Request $request, $submissionId)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'comment' => 'nullable|string',
        ]);

        $submission = TaskSubmission::with('task')->findOrFail($submissionId);

        if ($submission->review) {
            $submission->review->update([
                'score' => $request->score,
                'comment' => $request->comment,
                'reviewer_id' => Auth::id(),
            ]);
            $message = 'Penilaian berhasil diperbarui.';
        } else {
            $submission->review()->create([
                'score' => $request->score,
                'comment' => $request->comment,
                'reviewer_id' => Auth::id(),
            ]);
            $message = 'Penilaian berhasil disimpan.';
        }

        // Notifikasi ke user
        $user = User::find($submission->user_id);
        if ($user) {
            $user->notify(new \App\Notifications\TaskSubmissionNotification($submission->task, $submission));
        }

        return redirect()->route('training.task.detail', [
            $submission->task->training_id,
            $submission->task_id
        ])->with('success', $message);
    }

    /**
     * Edit submission tugas
     */
    public function editTask(Request $request, $trainingId, $taskId)
    {
        $request->validate([
            'submission_file' => 'nullable|file|max:5120',
            'message' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $task = Tasks::findOrFail($taskId);

        if ($task->deadline < now()) {
            return back()->with('error', 'Tidak dapat mengedit tugas setelah deadline telah berlalu.');
        }

        $existingSubmission = TaskSubmission::where('user_id', $user->id)
            ->where('task_id', $taskId)
            ->first();

        if (!$existingSubmission) {
            return back()->with('error', 'Pengumpulan tugas tidak ditemukan.');
        }

        if ($existingSubmission->review) {
            return back()->with('error', 'Tidak dapat mengedit tugas yang sudah dinilai.');
        }

        $filePath = $existingSubmission->file_path;

        if ($request->hasFile('submission_file')) {
            if ($existingSubmission->file_path && Storage::disk('public')->exists($existingSubmission->file_path)) {
                Storage::disk('public')->delete($existingSubmission->file_path);
            }

            $originalFileName = $request->file('submission_file')->getClientOriginalName();
            $userName = str_replace(' ', '_', $user->name);
            $extension = $request->file('submission_file')->getClientOriginalExtension();
            $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $userName . '.' . $extension;

            $filePath = $request->file('submission_file')->storeAs(
                'task_submissions/' . $task->title,
                $newFileName,
                'public'
            );
        }

        $existingSubmission->update([
            'answer' => $request->message,
            'file_path' => $filePath,
            'submitted_at' => now(),
        ]);

        return back()->with('success', 'Tugas berhasil diperbarui.');
    }
}
