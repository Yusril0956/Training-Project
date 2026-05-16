<?php

namespace App\Livewire\Training\Tasks;

use App\Models\TaskSubmission;
use App\Models\Tasks;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    public string $activeTab = 'submit';
    public int $submitUploadKey = 0;
    public int $editUploadKey = 0;

    protected $rules = [
        'submission_file' => 'nullable|file|max:5120',
        'message' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'submission_file.required' => 'File tugas wajib diunggah.',
        'submission_file.max' => 'Ukuran file maksimal 5MB.',
        'submission_file.file' => 'Yang Anda pilih bukan file valid.',
    ];

    public function mount($trainingId, $taskId): void
    {
        $this->trainingId = $trainingId;
        $this->taskId = $taskId;

        $this->training = Training::findOrFail($trainingId);
        $this->task = Tasks::with(['submissions.user', 'submissions.review'])
            ->where('training_id', $trainingId)
            ->findOrFail($taskId);

        $this->loadSubmissions();
        $this->activeTab = $this->resolveDefaultTab();
    }

    public function setActiveTab(string $tab): void
    {
        if (!in_array($tab, $this->availableTabs(), true)) {
            return;
        }

        $this->activeTab = $tab;

        if ($tab === 'submit') {
            $this->message = null;
            $this->clearSubmitUpload();
            return;
        }

        if ($tab === 'edit') {
            $this->message = $this->userSubmission?->answer;
            $this->clearEditUpload();
            return;
        }

        $this->clearSubmitUpload();
        $this->clearEditUpload();
    }

    public function submitTask(): void
    {
        $this->activeTab = 'submit';

        $this->validate([
            'submission_file' => 'required|file|max:5120',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($this->task->deadline < now()) {
            session()->flash('error', 'Deadline tugas sudah terlewati.');
            return;
        }

        $user = Auth::user();

        if (TaskSubmission::where('user_id', $user->id)->where('task_id', $this->taskId)->exists()) {
            throw ValidationException::withMessages([
                'submission_file' => 'Anda sudah mengumpulkan tugas ini sebelumnya. Silakan gunakan tab Edit Kiriman.',
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

            $this->loadSubmissions();
            $this->message = $this->userSubmission?->answer;
            $this->clearSubmitUpload();
            $this->activeTab = $this->resolveDefaultTab();

            session()->flash('success', 'Tugas berhasil dikirim.');
        } catch (\Throwable $e) {
            report($e);
            session()->flash('error', 'Gagal mengirim tugas. Silakan coba lagi.');
        }
    }

    public function editTask(): void
    {
        $this->activeTab = 'edit';

        $this->validate([
            'submission_file' => 'nullable|file|max:5120',
            'message' => 'nullable|string|max:1000',
        ]);

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

        if ($this->submission_file) {
            if ($submission->file_path && Storage::disk('public')->exists($submission->file_path)) {
                Storage::disk('public')->delete($submission->file_path);
            }

            $submission->file_path = $this->uploadFile($this->submission_file);
        }

        $submission->answer = $this->message;
        $submission->submitted_at = now();
        $submission->save();

        $this->loadSubmissions();
        $this->message = $this->userSubmission?->answer;
        $this->clearEditUpload();
        $this->activeTab = 'view';

        session()->flash('success', 'Tugas berhasil diperbarui.');
    }

    public function render()
    {
        $fileIsImage = false;

        if ($this->userSubmission && $this->userSubmission->file_path) {
            $extension = pathinfo($this->userSubmission->file_path, PATHINFO_EXTENSION);
            $fileIsImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true);
        }

        return view('livewire.training.tasks.show', [
            'training' => $this->training,
            'task' => $this->task,
            'submissions' => $this->submissions,
            'userSubmission' => $this->userSubmission,
            'fileIsImage' => $fileIsImage,
            'activeTab' => $this->activeTab,
        ])->layout('layouts.training', [
            'title' => 'Detail Tugas',
            'training' => $this->training,
        ]);
    }

    private function loadSubmissions(): void
    {
        $this->task = $this->task->fresh(['submissions.user', 'submissions.review']);
        $this->submissions = $this->task->submissions()->with(['user', 'review'])->get();
        $this->userSubmission = $this->submissions->firstWhere('user_id', Auth::id());

        if ($this->userSubmission) {
            $this->message = $this->userSubmission->answer;
        }
    }

    private function uploadFile($file): ?string
    {
        if (!$file) {
            return null;
        }

        $user = Auth::user();
        $safeTaskTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $this->task->title);
        $safeUserName = str_replace(' ', '_', $user->name);
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->format('YmdHis');

        $newFileName = "{$originalName}_{$safeUserName}_{$timestamp}.{$extension}";
        $folder = "task_submissions/{$safeTaskTitle}";

        return $file->storeAs($folder, $newFileName, 'public');
    }

    private function resolveDefaultTab(): string
    {
        if (Auth::user()->hasAnyRole(['Admin', 'Super Admin'])) {
            return 'admin';
        }

        if (!$this->userSubmission) {
            return 'submit';
        }

        if ($this->userSubmission->review) {
            return 'review';
        }

        return 'view';
    }

    private function availableTabs(): array
    {
        if (Auth::user()->hasAnyRole(['Admin', 'Super Admin'])) {
            return ['admin'];
        }

        $tabs = [];

        if (!$this->userSubmission) {
            $tabs[] = 'submit';
        }

        if ($this->userSubmission) {
            $tabs[] = 'view';

            if ($this->task->deadline->isFuture() && !$this->userSubmission->review) {
                $tabs[] = 'edit';
            }

            if ($this->userSubmission->review) {
                $tabs[] = 'review';
            }
        }

        return $tabs;
    }

    private function clearSubmitUpload(): void
    {
        $this->reset('submission_file');
        $this->submitUploadKey++;
    }

    private function clearEditUpload(): void
    {
        $this->reset('submission_file');
        $this->editUploadKey++;
    }
}
