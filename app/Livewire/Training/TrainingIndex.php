<?php

namespace App\Livewire\Training;

use App\Models\Training;
use App\Models\JenisTraining;
use App\Models\User;
use App\Models\Tasks;
use App\Models\TrainingMember;
use App\Models\Notification;
use App\Models\Certificate;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TrainingAcceptedNotification;
use App\Notifications\TrainingRejectedNotification;
use App\Notifications\TrainingInvitationNotification;
use App\Notifications\TrainingGraduatedNotification;
use App\Notifications\TrainingKickedNotification;
use Livewire\Component;
use Livewire\WithPagination;

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
        $training = Training::findOrFail($id);
        $training->status = 'close';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil ditolak');
    }

    /**
     * Approve training request
     */
    public function approve($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'open';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil disetujui');
    }

    /**
     * register/daftar Training untuk user
     */
    public function register($trainingId)
    {
        $training = Training::findOrFail($trainingId);

        if ($training->status === 'close') {
            session()->flash('error', 'Pendaftaran untuk training ini sudah ditutup.');
            return;
        }

        $trainingDetail = $training->detail;
        if (!$trainingDetail) {
            $trainingDetail = $training->detail()->create([
                'start_date' => now()->toDateString(),
                'end_date' => now()->addMonth()->toDateString(),
            ]);
        }

        $existingMember = TrainingMember::where('training_detail_id', $trainingDetail->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingMember) {
            session()->flash('error', 'Anda sudah terdaftar sebagai peserta training ini.');
            return;
        }

        TrainingMember::create([
            'training_detail_id' => $trainingDetail->id,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'series' => 'TRN-' . strtoupper(uniqid()),
        ]);

        session()->flash('success', 'Pendaftaran berhasil! Status Anda sedang menunggu persetujuan admin.');
        $this->render(); // Re-render to update the status
    }

    /**
     * Halaman jadwal training
     */
    public function schedule($id)
    {
        $training = Training::findOrFail($id);
        return view('training.schedule.index', compact('id', 'training'));
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

        $userId = Auth::id();
        $userStatuses = [];
        foreach ($trainings as $training) {
            $member = $training->members->where('user_id', $userId)->first();
            $userStatuses[$training->id] = $member ? $member->status : 'none';
        }

        return view('livewire.training.training-index', [
            'trainings' => $trainings,
            'userStatuses' => $userStatuses,
        ])->layout('layouts.app', ['title' => 'Training']);
    }
}
