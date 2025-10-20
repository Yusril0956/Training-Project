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
        $this->status = 'open';
        $this->start_date = '';
        $this->end_date = '';
        $this->editingId = null;
        $this->showCreateForm = false;
    }

    public function create()
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
            'status' => 'required|in:open,close',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $training = Training::create([
            'name' => $this->name,
            'description' => $this->description,
            'jenis_training_id' => $this->jenis_training_id,
            'status' => $this->status,
        ]);

        // Create training detail with dates
        $training->detail()->create([
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
        $this->status = $training->status;
        $this->start_date = $training->detail ? $training->detail->start_date : '';
        $this->end_date = $training->detail ? $training->detail->end_date : '';
        $this->showCreateForm = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jenis_training_id' => 'required|exists:jenis_trainings,id',
            'status' => 'required|in:open,close',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $training = Training::findOrFail($this->editingId);
        $training->update([
            'name' => $this->name,
            'description' => $this->description,
            'jenis_training_id' => $this->jenis_training_id,
            'status' => $this->status,
        ]);

        // Update or create training detail
        $training->detail()->updateOrCreate(
            ['training_id' => $training->id],
            [
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]
        );

        session()->flash('success', 'Pelatihan berhasil diperbarui.');
        $this->resetForm();
    }

    public function destroy($id)
    {
        $training = Training::findOrFail($id);

        if ($training->detail) $training->detail->delete();
        $training->members()->delete();
        $training->schedules()->delete();

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
            ->with(['jenisTraining', 'detail', 'members'])
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

        return view('livewire.training.training-manage', [
            'trainings' => $trainings,
            'jenisTrainings' => $jenisTrainings,
        ]);
    }
}
