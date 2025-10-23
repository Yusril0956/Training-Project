<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Livewire\Component;

class Index extends Component
{
    public $id;
    public $training;

    public function mount($id)
    {
        $this->id = $id;
        $this->training = Training::withCount(['members', 'tasks'])
            ->with(['attendanceSessions' => function ($query) {
                $query->where('date', '>=', now()->toDateString())
                    ->orderBy('date', 'asc')
                    ->limit(3);
            }])
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.training.index')
            ->layout('layouts.training');
    }
}
