<?php

namespace App\Livewire;

use App\Models\Training;
use Livewire\Component;
use Livewire\WithPagination;

class TrainingSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public string $jenis = '';
    public string $pageType = 'user';
    protected $paginationTheme = 'bootstrap';

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

        $viewName = $this->pageType === 'admin'
            ? 'livewire.tmanage-search'
            : 'livewire.training-search';

        return view($viewName, [
            'trainings' => $trainings,
        ]);
    }
}
