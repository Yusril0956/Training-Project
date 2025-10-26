<?php

namespace App\Livewire\Training;

use App\Models\Training;
use App\Models\JenisTraining;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\TrainingService;

class TrainingManage extends Component
{
    use WithPagination;

    public string $search = '';
    public string $jenis = '';
    protected $paginationTheme = 'bootstrap';

    // Removed form properties - moved to separate components

    protected TrainingService $trainingService;

    public function boot(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
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

    // Removed form methods - moved to separate components

    public function destroy($id)
    {
        try {
            $this->trainingService->deleteTraining($id);
            session()->flash('success', 'Pelatihan berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus pelatihan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $trainings = Training::query()
            ->with(['jenisTraining', 'members'])
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
