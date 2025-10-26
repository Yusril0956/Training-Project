<?php

namespace App\Livewire\Training;

use App\Models\Training;
use App\Models\JenisTraining;
use Livewire\Component;
use App\Services\TrainingService;

class TrainingEdit extends Component
{
    public $trainingId;
    public $training;
    public $name = '';
    public $description = '';
    public $jenis_training_id = '';
    public $instructor_id = '';
    public $status = 'open';
    public $start_date = '';
    public $end_date = '';

    protected TrainingService $trainingService;

    public function boot(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->training = Training::findOrFail($trainingId);

        $this->name = $this->training->name;
        $this->description = $this->training->description;
        $this->jenis_training_id = $this->training->jenis_training_id;
        $this->instructor_id = $this->training->instructor_id;
        $this->status = $this->training->status;
        $this->start_date = $this->training->start_date ? $this->training->start_date->format('Y-m-d') : '';
        $this->end_date = $this->training->end_date ? $this->training->end_date->format('Y-m-d') : '';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jenis_training_id' => 'required|exists:jenis_trainings,id',
            'instructor_id' => 'nullable|exists:users,id',
            'status' => 'required|in:open,close',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        try {
            $this->trainingService->updateTraining($this->trainingId, [
                'name' => $this->name,
                'description' => $this->description,
                'jenis_training_id' => $this->jenis_training_id,
                'instructor_id' => $this->instructor_id,
                'status' => $this->status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            session()->flash('success', 'Pelatihan berhasil diperbarui.');
            return redirect()->route('admin.training.manage');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memperbarui pelatihan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $jenisTrainings = JenisTraining::all();
        $instructors = \App\Models\User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->get();

        return view('livewire.training.training-edit', [
            'jenisTrainings' => $jenisTrainings,
            'instructors' => $instructors,
        ])->layout('layouts.dashboard', [
            'title' => 'Edit Training',
            'breadcrumb' => [
                ['title' => 'Admin', 'url' => route('admin.index')],
                ['title' => 'Training Management', 'url' => route('admin.training.manage')],
                ['title' => 'Edit Training', 'url' => null],
            ]
        ]);
    }
}
