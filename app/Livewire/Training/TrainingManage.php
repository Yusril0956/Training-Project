<?php

namespace App\Livewire\Training;

use App\Models\Training;
use App\Models\JenisTraining;
use Livewire\Component;
use Livewire\WithPagination;

class TrainingManage extends Component
{
    use WithPagination;

    public string $search = '';
    public string $jenis = '';
    protected $paginationTheme = 'bootstrap';

    public $showCreateForm = false;
    public $editingId = null;
    public $name = '';
    public $description = '';
    public $jenis_training_id = '';
    public $instructor_id = '';
    public $status = 'open';
    public $start_date = '';
    public $end_date = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingJenis()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->search = '';
        $this->jenis = '';
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->jenis_training_id = '';
        $this->instructor_id = '';
        $this->status = 'open';
        $this->start_date = '';
        $this->end_date = '';
        $this->editingId = null;
        $this->showCreateForm = false;
    }

    public function showCreateModal()
    {
        $this->resetForm();
        $this->showCreateForm = true;
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

        $training = Training::create([
            'name' => $this->name,
            'description' => $this->description,
            'jenis_training_id' => $this->jenis_training_id,
            'instructor_id' => $this->instructor_id,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        session()->flash('success', 'Pelatihan berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $training = Training::findOrFail($id);
        $this->editingId = $id;
        $this->name = $training->name;
        $this->description = $training->description;
        $this->jenis_training_id = $training->jenis_training_id;
        $this->instructor_id = $training->instructor_id;
        $this->status = $training->status;
        $this->start_date = $training->start_date ? $training->start_date->format('Y-m-d') : '';
        $this->end_date = $training->end_date ? $training->end_date->format('Y-m-d') : '';
        $this->showCreateForm = true;
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

        $training = Training::findOrFail($this->editingId);
        $training->update([
            'name' => $this->name,
            'description' => $this->description,
            'jenis_training_id' => $this->jenis_training_id,
            'instructor_id' => $this->instructor_id,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        session()->flash('success', 'Pelatihan berhasil diperbarui.');
        $this->resetForm();
    }

    public function destroy($id)
    {
        $training = Training::findOrFail($id);

        $training->members()->delete();

        foreach ($training->tasks as $task) {
            $task->submissions()->delete();
            $task->delete();
        }

        $training->certificates()->delete();
        $training->delete();

        session()->flash('success', 'Pelatihan berhasil dihapus.');
    }

    public function render()
    {
        $trainings = Training::query()
            ->with(['jenisTraining', 'instructor', 'members'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->jenis, function ($query) {
                $query->whereHas('jenisTraining', function ($q) {
                    $q->where('name', $this->jenis);
                });
            })
            ->orderBy('status', 'desc')
            ->paginate(9);

        $jenisTrainings = JenisTraining::all();
        $instructors = \App\Models\User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->get();

        return view('livewire.training.training-manage', [
            'trainings' => $trainings,
            'jenisTrainings' => $jenisTrainings,
            'instructors' => $instructors,
        ])->layout('layouts.dashboard', ['title' => 'Training Management']);
    }
}
