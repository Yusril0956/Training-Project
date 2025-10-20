<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Livewire\Component;

class Index extends Component
{
    public $id;
    public $training;
    public $schedule;

    public function mount($id)
    {
        $this->id = $id;
        $this->training = Training::withCount(['members', 'tasks'])->findOrFail($id);
        $this->schedule = $this->training->schedules()->orderBy('date', 'asc')->first();
    }

    public function render()
    {
        return view('livewire.training.index')
            ->layout('layouts.training');
    }
}
