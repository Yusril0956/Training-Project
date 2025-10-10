<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Livewire\Component;

class Absen extends Component
{
    public $id;
    public $training;
    public $members;

    public function mount($id)
    {
        $this->id = $id;
        $this->training = Training::with(['detail', 'jenisTraining'])->findOrFail($id);
        $this->members = $this->training->members()->with(['user', 'attendance'])->get();
    }

    public function render()
    {
        return view('livewire.training.absen');
    }
}
