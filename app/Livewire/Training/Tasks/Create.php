<?php

namespace App\Livewire\Training\Tasks;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Training;
use App\Models\Tasks;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    // Properti yang akan di-bind ke form
    public $training;
    public $training_id;
    public $title;
    public $description;
    public $deadline;
    public $attachment;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'deadline' => 'required|date',
        'attachment' => 'nullable|file|max:5120', // maks 5MB
    ];

    public function mount($trainingId)
    {
        $this->training = Training::findOrFail($trainingId);
        $this->training_id = $this->training->id;
    }


    public function save()
    {
        $this->validate();

        try {
            // Simpan file jika ada
            $path = $this->attachment
                ? $this->attachment->store('attachments', 'public')
                : null;

            // Simpan ke database
            $task = Tasks::create([
                'training_id' => $this->training_id,
                'title' => $this->title,
                'description' => $this->description,
                'deadline' => $this->deadline,
                'attachment_path' => $path,
            ]);

            // Kirim notifikasi ke member yang diterima
            $training = Training::with(['members.user'])->findOrFail($this->training_id);
            $acceptedMembers = $training->members->where('status', 'accept');

            foreach ($acceptedMembers as $member) {
                if ($member->user) {
                    $member->user->notify(new \App\Notifications\TaskNotification($task));
                }
            }

            // Reset form setelah berhasil
            $this->reset(['title', 'description', 'deadline', 'attachment']);

            // Flash message dan redirect
            session()->flash('success', 'Tugas berhasil ditambahkan dan notifikasi telah dikirim ke semua peserta.');
            return redirect()->route('training.tasks', $this->training_id);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan tugas: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.training.tasks.create', [
            'training' => $this->training,
        ])->layout('components.layouts.training', ['title' => 'Buat Tugas']);
    }
}
