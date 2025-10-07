<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\JenisTraining;
use App\Models\Tasks;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class TrainingSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public string $jenis = '';
    public string $pageType = 'user';
    protected $paginationTheme = 'bootstrap';

    // CRUD properties
    public $showCreateForm = false;
    public $editingId = null;
    public $name = '';
    public $description = '';
    public $jenis_training_id = '';
    public $status = 'open';

    public function mount($pageType = 'user')
    {
        $this->pageType = $pageType;
    }

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
        if ($this->pageType !== 'admin') return;
        $this->name = '';
        $this->description = '';
        $this->jenis_training_id = '';
        $this->status = 'open';
        $this->editingId = null;
        $this->showCreateForm = false;
    }

    public function create()
    {
        if ($this->pageType !== 'admin') return;
        $this->resetForm();
        $this->showCreateForm = true;
    }

    public function store()
    {
        if ($this->pageType !== 'admin') return;
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jenis_training_id' => 'required|exists:jenis_trainings,id',
            'status' => 'required|in:open,close',
        ]);

        Training::create([
            'name' => $this->name,
            'description' => $this->description,
            'jenis_training_id' => $this->jenis_training_id,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Pelatihan berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        if ($this->pageType !== 'admin') return;
        $training = Training::findOrFail($id);
        $this->editingId = $id;
        $this->name = $training->name;
        $this->description = $training->description;
        $this->jenis_training_id = $training->jenis_training_id;
        $this->status = $training->status;
        $this->showCreateForm = true;
    }

    public function update()
    {
        if ($this->pageType !== 'admin') return;
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jenis_training_id' => 'required|exists:jenis_trainings,id',
            'status' => 'required|in:open,close',
        ]);

        $training = Training::findOrFail($this->editingId);
        $training->update([
            'name' => $this->name,
            'description' => $this->description,
            'jenis_training_id' => $this->jenis_training_id,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Pelatihan berhasil diperbarui.');
        $this->resetForm();
    }

    public function destroy($id)
    {
        if ($this->pageType !== 'admin') return;
        $training = Training::findOrFail($id);

        if ($training->detail) $training->detail->delete();
        $training->members()->delete();
        $training->schedules()->delete();
        $training->materis()->delete();

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
            ->with(['jenisTraining', 'detail', 'members', 'materis'])
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

<<<<<<< HEAD
        $userId = Auth::id();
        $userStatuses = [];
        foreach ($trainings as $training) {
            $member = $training->members->where('user_id', $userId)->first();
            $userStatuses[$training->id] = $member ? $member->status : 'none';
        }
=======
        $jenisTrainings = $this->pageType === 'admin' ? JenisTraining::all() : [];
>>>>>>> cd79f30d2b859c81db9c7bd5f9f40e77c04bf38a

        $viewName = $this->pageType === 'admin'
            ? 'livewire.tmanage-search'
            : 'livewire.training-search';

        return view($viewName, [
            'trainings' => $trainings,
<<<<<<< HEAD
            'userStatuses' => $userStatuses,
=======
            'jenisTrainings' => $jenisTrainings,
>>>>>>> cd79f30d2b859c81db9c7bd5f9f40e77c04bf38a
        ]);
    }
}
