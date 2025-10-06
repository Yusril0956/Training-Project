<?php

namespace App\Livewire;

use App\Models\Training;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class TrainingSearch extends Component
{
    use WithPagination;

    public string $search = '';

    public $jenis = '';

    protected $paginationTheme = 'bootstrap'; // Biar cocok sama Tabler

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

        return view('livewire.training-search', [
            'trainings' => $trainings,
        ]);
    }
}
