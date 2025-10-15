<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class TrainingIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $jenis = '';
    protected $paginationTheme = 'bootstrap';

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

        $userId = Auth::id();
        $userStatuses = [];
        foreach ($trainings as $training) {
            $member = $training->members->where('user_id', $userId)->first();
            $userStatuses[$training->id] = $member ? $member->status : 'none';
        }

        return view('livewire.training.training-index', [
            'trainings' => $trainings,
            'userStatuses' => $userStatuses,
        ]);
    }
}
