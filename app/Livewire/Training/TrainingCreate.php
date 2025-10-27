<?php

namespace App\Livewire\Training;

use App\Models\JenisTraining;
use Livewire\Component;
use App\Services\TrainingService;

class TrainingCreate extends Component
{
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

    public function store()
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
            $this->trainingService->createTraining([
                'name' => $this->name,
                'description' => $this->description,
                'jenis_training_id' => $this->jenis_training_id,
                'instructor_id' => $this->instructor_id,
                'status' => $this->status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            session()->flash('success', 'Pelatihan berhasil ditambahkan.');
            return redirect()->route('admin.training.manage');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal membuat pelatihan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $jenisTrainings = JenisTraining::all();
        $instructors = cache()->remember('admin_instructors', 3600, function () {
            return \App\Models\User::whereHas('roles', function ($q) {
                $q->where('name', 'Admin');
            })->get();
        });

        return view('livewire.training.training-create', [
            'jenisTrainings' => $jenisTrainings,
            'instructors' => $instructors,
            'title' => 'Create Training',
            'breadcrumb' => [
                ['title' => 'Admin', 'url' => route('admin.index')],
                ['title' => 'Training Management', 'url' => route('admin.training.manage')],
                ['title' => 'Create Training', 'url' => null],
            ]
        ])->layout('layouts.dashboard', ['title' => 'Training Create']);
    }
}
