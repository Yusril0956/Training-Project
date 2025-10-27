<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\TrainingService;

class TrainingIndex extends Component
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

    public function home($id)
    {
        $training = Training::findOrFail($id);
        return view('training.main', compact('id', 'training'));
    }

    /**
     * Reject training request
     */
    public function reject($id)
    {
        try {
            $this->trainingService->rejectTraining($id);
            session()->flash('success', 'Training berhasil ditolak');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menolak training: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Approve training request
     */
    public function approve($id)
    {
        try {
            $this->trainingService->approveTraining($id);
            session()->flash('success', 'Training berhasil disetujui');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyetujui training: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * register/daftar Training untuk user
     */
    public function register($trainingId)
    {
        try {
            $this->trainingService->registerUserForTraining($trainingId, Auth::id());
            session()->flash('success', 'Pendaftaran berhasil! Status Anda sedang menunggu persetujuan admin.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        $this->render(); // Re-render to update the status
    }

    public function render()
    {
        $filters = [
            'search' => $this->search,
            'jenis' => $this->jenis,
        ];

        $trainings = $this->trainingService->getTrainingsWithFilters($filters)->paginate(9);

        $userId = Auth::id();
        $userStatuses = $this->trainingService->getUserTrainingStatuses($trainings, $userId);

        return view('livewire.training.training-index', [
            'trainings' => $trainings,
            'userStatuses' => $userStatuses,
        ])->layout('layouts.app', ['title' => 'Training']);
    }
}
