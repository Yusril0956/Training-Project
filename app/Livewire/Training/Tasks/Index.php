<?php

namespace App\Livewire\Training\Tasks;

use Livewire\Component;
use App\Models\Training;
use App\Models\Tasks;

class Index extends Component
{
    public $trainingId;
    public $training;
    protected $tasks;

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->training = Training::findOrFail($trainingId);
        $this->tasks = Tasks::where('training_id', $trainingId)->paginate();
    }

    public function render()
    {
        return view('livewire.training.tasks.index', ['tasks' => $this->tasks]);
    }
}
