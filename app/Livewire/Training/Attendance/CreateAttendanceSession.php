<?php

namespace App\Livewire\Training\Attendance;

use App\Models\Training;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateAttendanceSession extends Component
{
    public Training $training;

    #[Rule('required|string|max:255')]
    public $title;

    #[Rule('required|date')]
    public $date;

    #[Rule('nullable|date_format:H:i')]
    public $start_time;

    #[Rule('nullable|date_format:H:i|after:start_time')]
    public $end_time;

    #[Rule('nullable|string')]
    public $description;

    public function mount($trainingId)
    {
        $this->training = Training::findOrFail($trainingId);

        $this->date = now()->format('Y-m-d');
    }

    public function storeSession()
    {
        $validated = $this->validate();

        $this->training->attendanceSessions()->create($validated);

        session()->flash('success', 'Sesi absensi baru berhasil dibuat.');

        return $this->redirectRoute('admin.training.attendance.manage', [
            'trainingId' => $this->training->id
        ]);
    }

    public function render()
    {
        return view('livewire.training.attendance.create-attendance-session')->layout('layouts.training', [
            'title' => 'Create Attendance Session',
            'training' => $this->training
        ]);
    }
}
