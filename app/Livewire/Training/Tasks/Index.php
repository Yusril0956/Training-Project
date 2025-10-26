<?php

namespace App\Livewire\Training\Tasks;

use App\Models\Training;
use App\Models\Tasks;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $trainingId;
    public $training;

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->training = Training::findOrFail($trainingId);
    }

    public function deleteTask($taskId)
    {
        $task = Tasks::where('training_id', $this->training->id)->findOrFail($taskId);
        $task->submissions()->delete();
        $task->delete();

        session()->flash('success', 'Tugas berhasil dihapus.');
    }

    public function render()
    {
        $tasks = Tasks::where('training_id', $this->trainingId)
            ->latest()
            ->paginate(10);

        return view('livewire.training.tasks.index', [
            'training' => $this->training,
            'tasks' => $tasks,
        ])->layout('layouts.training', ['title' => 'Daftar Tugas', 'training' => $this->training]);
    }
}
