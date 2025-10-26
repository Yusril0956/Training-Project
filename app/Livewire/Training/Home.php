<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Livewire\Component;

class Home extends Component
{
    public $trainingId;
    public $training;

    public function mount($trainingId)
    {
        $this->id = $trainingId;
        $this->training = Training::withCount(['members', 'tasks', 'materis'])
            ->with(['attendanceSessions' => function ($query) {
                $query->where('date', '>=', now()->toDateString())
                    ->orderBy('date', 'asc')
                    ->limit(3);
            }])
            ->findOrFail($trainingId);
    }

    public function render()
    {
        return view('livewire.training.home')
            ->layout('layouts.training', ['title' => 'Home', 'training' => $this->training]);
    }
}
