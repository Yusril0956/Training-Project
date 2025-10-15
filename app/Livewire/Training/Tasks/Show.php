<?php

namespace App\Livewire\Training\Tasks;

use App\Models\Training;
use App\Models\Tasks;
use App\Models\TaskSubmission;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class Show extends Component
{
    use WithFileUploads;

    public $trainingId;
    public $taskId;
    public $training;
    public $task;
    public $submissions;
    public $userSubmission;
    public $submission_file;
    public $message;
    public $editMode = false;
    public $showReview = false;

    protected $rules = [
        'submission_file' => 'nullable|file|max:5120', // 5MB
        'message' => 'nullable|string|max:1000',
    ];

    public function mount($trainingId, $taskId)
    {
        $this->trainingId = $trainingId;
        $this->taskId = $taskId;

        $this->training = Training::findOrFail($trainingId);
        $this->task = Tasks::with(['submissions.user', 'submissions.review'])
            ->where('training_id', $trainingId)
            ->findOrFail($taskId);

        $this->loadSubmissions();
    }

    private function loadSubmissions(): void
    {
        $this->task->refresh();
        $this->submissions = $this->task->submissions()->with(['user', 'review'])->get();
        $this->userSubmission = $this->submissions->firstWhere('user_id', Auth::id());
    }

    private function uploadFile($file): ?string
    {
        if (!$file) return null;

        $user = Auth::user();
        $safeTaskTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $this->task->title);
        $safeUserName = str_replace(' ', '_', $user->name);
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        $newFileName = "{$originalName}_{$safeUserName}.{$extension}";
        $folder = "task_submissions/{$safeTaskTitle}";

        return $file->storeAs($folder, $newFileName, 'public');
    }

    public function submitTask(): void
    {
        $this->validate();
        $user = Auth::user();

        if (TaskSubmission::where('user_id', $user->id)->where('task_id', $this->taskId)->exists()) {
            throw ValidationException::withMessages([
                'submission_file' => 'Anda sudah mengumpulkan tugas ini sebelumnya.',
            ]);
        }

        try {
            TaskSubmission::create([
                'user_id' => $user->id,
                'task_id' => $this->taskId,
                'answer' => $this->message,
                'file_path' => $this->uploadFile($this->submission_file),
                'submitted_at' => now(),
            ]);

            $this->reset(['submission_file', 'message']);
            $this->loadSubmissions();
            session()->flash('success', 'Tugas berhasil dikirim.');
        } catch (\Throwable $e) {
            report($e);
            session()->flash('error', 'Gagal mengirim tugas. Silakan coba lagi.');
        }
    }

    public function editTask(): void
    {
        $this->validate();
        $user = Auth::user();
        $submission = TaskSubmission::where('user_id', $user->id)->where('task_id', $this->taskId)->first();

        if (!$submission) {
            session()->flash('error', 'Pengumpulan tugas tidak ditemukan.');
            return;
        }

        if ($submission->review) {
            session()->flash('error', 'Tidak dapat mengedit tugas yang sudah dinilai.');
            return;
        }

        if ($this->task->deadline < now()) {
            session()->flash('error', 'Tidak dapat mengedit tugas setelah deadline.');
            return;
        }

        // Replace file if new uploaded
        if ($this->submission_file) {
            if ($submission->file_path && Storage::disk('public')->exists($submission->file_path)) {
                Storage::disk('public')->delete($submission->file_path);
            }
            $submission->file_path = $this->uploadFile($this->submission_file);
        }

        $submission->update([
            'answer' => $this->message,
            'submitted_at' => now(),
        ]);

        $this->editMode = false;
        $this->reset(['submission_file', 'message']);
        $this->loadSubmissions();

        session()->flash('success', 'Tugas berhasil diperbarui.');
    }

    public function toggleEditMode(): void
    {
        $this->editMode = !$this->editMode;
        if ($this->editMode && $this->userSubmission) {
            $this->message = $this->userSubmission->answer;
        }
    }

    public function toggleReview(): void
    {
        $this->showReview = !$this->showReview;
    }

    public function render()
    {
        return view('livewire.training.tasks.show', [
            'training' => $this->training,
            'task' => $this->task,
            'submissions' => $this->submissions,
            'userSubmission' => $this->userSubmission,
        ])->layout('components.layouts.training', [
            'title' => 'Detail Tugas',
        ]);
    }
}
