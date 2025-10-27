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
        $filters = [
            'search' => $this->search,
            'jenis' => $this->jenis,
        ];

        $trainings = $this->trainingService->getTrainingsWithFilters($filters)->paginate(9);

        $jenisTrainings = cache()->remember('jenis_trainings', 3600, function () {
            return JenisTraining::all();
        });

        $instructors = cache()->remember('training_instructors', 3600, function () {
            return $this->trainingService->getInstructors();
        });

        return view('livewire.training.training-manage', [
            'trainings' => $trainings,
            'jenisTrainings' => $jenisTrainings,
            'instructors' => $instructors,
        ])->layout('layouts.dashboard', ['title' => 'Training Management']);
    }
}
