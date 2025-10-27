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

    public string $defaultTabId = 'tab-submit';

    protected $rules = [
        'submission_file' => 'nullable|file|max:5120', // 5MB
        'message' => 'nullable|string|max:1000',
    ];

    protected $listeners = ['fileSubmitted' => 'resetFile'];

    public function mount($trainingId, $taskId)
    {
        $this->trainingId = $trainingId;
        $this->taskId = $taskId;

        $this->training = Training::findOrFail($trainingId);
        $this->task = Tasks::with(['submissions.user', 'submissions.review'])
            ->where('training_id', $trainingId)
            ->findOrFail($taskId);

        $this->loadSubmissions();

        // --- LOGIKA PENENTUAN TAB AKTIF AWAL (Untuk menentukan class 'active' pertama kali di Blade) ---
        if (Auth::user()->hasAnyRole(['Admin', 'Super Admin'])) {
            $this->defaultTabId = 'tab-admin';
        } elseif ($this->userSubmission) {
            if ($this->userSubmission->review) {
                $this->defaultTabId = 'tab-review';
            } else {
                $this->defaultTabId = 'tab-view';
            }
        } else {
            $this->defaultTabId = 'tab-submit';
        }

        // Jika ada session flash sukses (setelah submit/edit), pastikan tab yang terbuka adalah 'view'
        if (session()->has('success') && $this->userSubmission) {
            $this->defaultTabId = 'tab-view';
            // Session tidak perlu dihapus di sini, biarkan blade yang menghapusnya jika perlu.
        }
    }

    private function loadSubmissions(): void
    {
        $this->task->refresh();
        $this->submissions = $this->task->submissions()->with(['user', 'review'])->get();
        $this->userSubmission = $this->submissions->firstWhere('user_id', Auth::id());

        // Isi properti message untuk form edit/update
        if ($this->userSubmission) {
            $this->message = $this->userSubmission->answer;
        }
    }

    private function uploadFile($file): ?string
    {
        if (!$file) return null;

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

    public function submitTask(): void
    {
        // ... (Logika submitTask tetap sama) ...
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

            $this->dispatch('fileSubmitted');

            $this->loadSubmissions();
            // Pindahkan ke tab 'view' setelah submit, Bootstrap akan mengurus tampilannya
            $this->defaultTabId = 'tab-view';
            session()->flash('success', 'Tugas berhasil dikirim. Anda dapat melihat kiriman di tab Lihat Kiriman.');

            // Kirim event untuk mengganti tab secara paksa jika Livewire/Bootstrap tidak sinkron
            $this->dispatch('show-tab', ['tabId' => 'tab-view']);
        } catch (\Throwable $e) {
            report($e);
            session()->flash('error', 'Gagal mengirim tugas. Silakan coba lagi.');
        }
    }

    public function editTask(): void
    {
        // ... (Logika editTask tetap sama) ...
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

        $this->dispatch('fileSubmitted');

        // Pindahkan ke tab 'view' setelah edit
        $this->defaultTabId = 'tab-view';
        $this->loadSubmissions();

        session()->flash('success', 'Tugas berhasil diperbarui.');

        // Kirim event untuk mengganti tab secara paksa
        $this->dispatch('show-tab', ['tabId' => 'tab-view']);
    }

    public function resetFile(): void
    {
        $this->reset(['submission_file']);
    }

    // Menghapus fungsi setActiveTab karena kontrol tab dipegang Bootstrap/Tabler
    /*
    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->reset(['submission_file']); 
        if ($tab === 'edit' && $this->userSubmission) {
            $this->message = $this->userSubmission->answer;
        }
    }
    */

    public function render()
    {
        $fileIsImage = false;
        if ($this->userSubmission && $this->userSubmission->file_path) {
            $extension = pathinfo($this->userSubmission->file_path, PATHINFO_EXTENSION);
            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $fileIsImage = true;
            }
        }

        return view('livewire.training.tasks.show', [
            'training' => $this->training,
            'task' => $this->task,
            'submissions' => $this->submissions,
            'userSubmission' => $this->userSubmission,
            'fileIsImage' => $fileIsImage,
            'defaultTabId' => $this->defaultTabId,
        ])->layout('layouts.training', [
            'title' => 'Detail Tugas',
            'training' => $this->training,
        ]);
    }
}
