<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Tasks;
use App\Models\TaskSubmission;
use App\Models\TaskReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{
    public function index($id)
    {
        $training = Training::findOrFail($id);
        // latest tasks with pagination
        $tasks = $training->tasks()->latest()->paginate(10);
        return view('training.tasks.index', compact('training', 'tasks'));
    }

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

        Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'training_id' => $request->training_id,
            'deadline' => $request->deadline,
            'attachment_path' => $path,
        ]);

        return redirect()->route('training.tasks', $trainingId)->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show($trainingId, $taskId)
    {
        $task = Tasks::where('training_id', $trainingId)->findOrFail($taskId);
        $training = Training::findOrFail($trainingId);

        // Load submissions relationship
        $task->load('submissions.user');

        return view('training.tasks.show', compact('task', 'training'));
    }

    public function create($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        return view('training.tasks.create', compact('training'));
    }

    public function submit(Request $request, $trainingName, $taskId)
    {
        $request->validate([
            'submission_file' => 'required|file|max:5120',
            'message' => 'nullable|string|max:1000',
        ]);

        $user = User::find(Auth::id());
        $task = Tasks::findOrFail($taskId);

        // Check if user already submitted this task
        $existingSubmission = TaskSubmission::where('user_id', $user->id)
            ->where('task_id', $taskId)
            ->first();

        if ($existingSubmission) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini sebelumnya.');
        }

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('submission_file')) {
            $filePath = $request->file('submission_file')->store('task_submissions', 'public');
        }

        // Create submission record
        TaskSubmission::create([
            'user_id' => $user->id,
            'task_id' => $taskId,
            'answer' => $request->message,
            'file_path' => $filePath,
            'submitted_at' => now(),
        ]);

        return back()->with('success', 'Tugas berhasil dikirim.');
    }

    public function destroy($trainingId, $taskId)
    {
        $task = Tasks::where('training_id', $trainingId)->findOrFail($taskId);
        $task->delete();

        return back()->with('success', 'Tugas berhasil dihapus.');
    }

    public function reviewTaskSubmission($submissionId)
    {
        $submission = TaskSubmission::with('user', 'task.training')->findOrFail($submissionId);
        $training = $submission->task->training;
        return view('training.tasks.review', compact('submission', 'training'));
    }

    public function storeReview(Request $request, $submissionId)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'comment' => 'nullable|string',
        ]);

        $submission = TaskSubmission::findOrFail($submissionId);

        $submission->review()->create([
            'score' => $request->score,
            'comment' => $request->comment,
            'reviewer_id' => auth::id(),
        ]);

        return redirect()->route('training.task.detail', [$submission->task->training_id, $submission->task_id])->with('success', 'Penilaian berhasil disimpan.');
    }
}
