<?php

namespace App\Livewire\Training\Members;

use App\Models\Certificate;
use App\Models\Training;
use App\Models\TrainingMember;
use App\Notifications\TrainingAcceptedNotification;
use App\Notifications\TrainingGraduatedNotification;
use App\Notifications\TrainingKickedNotification;
use App\Notifications\TrainingRejectedNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $trainingId;
    public $training;
    public $pendingMembers;
    public $graduateMember;
    public $isAdmin = false;

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->loadData();
    }

    public function loadData()
    {
        $user = Auth::user();

        if ($user->hasAnyRole(['Admin', 'Super Admin'])) {
            $this->isAdmin = true;

            $this->training = Training::with([
                'members' => fn($q) => $q->where('status', 'accept')->with('user'),
                'pendingMembers' => fn($q) => $q->where('status', 'pending')->with('user'),
                'graduateMembers' => fn($q) => $q->where('status', 'graduate')->with('user.certificates', fn($cert) => $cert->where('training_id', $this->trainingId)),
            ])->findOrFail($this->trainingId);

            $this->pendingMembers = $this->training->pendingMembers;
            $this->graduateMember = $this->training->graduateMembers;
        } else {
            $this->isAdmin = false;
            $this->training = Training::whereHas('members', function ($q) {
                $q->where('user_id', Auth::id())->whereIn('status', ['accept', 'graduate']);
            })
                ->with(['jenisTraining', 'members.user'])
                ->findOrFail($this->trainingId);
        }
    }

    public function render()
    {
        $view = $this->isAdmin ? 'livewire.training.members.index' : 'livewire.training.members.user-member';
        return view($view)->layout('layouts.training', ['title' => 'Daftar Peserta']);
    }

    private function findMemberOrFail($memberId)
    {
        return TrainingMember::with('user', 'training')->findOrFail($memberId);
    }

    public function acceptMember($memberId)
    {
        try {
            $member = $this->findMemberOrFail($memberId);
            $member->update(['status' => 'accept']);
            $member->user->notify(new TrainingAcceptedNotification($member->training));
            session()->flash('success', 'Peserta telah diterima.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menerima peserta: ' . $e->getMessage());
        }
        $this->loadData();
    }

    public function rejectMember($memberId)
    {
        try {
            $member = $this->findMemberOrFail($memberId);
            $training = $member->training;
            $user = $member->user;

            $member->delete();
            $user->notify(new TrainingRejectedNotification($training));

            session()->flash('success', 'Peserta telah ditolak dan dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menolak peserta: ' . $e->getMessage());
        }
        $this->loadData();
    }

    public function deleteMember($memberId)
    {
        try {
            $member = $this->findMemberOrFail($memberId);
            $training = $member->training;
            $user = $member->user;

            $member->delete();
            $user->notify(new TrainingKickedNotification($training));

            session()->flash('success', 'Peserta telah dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus peserta: ' . $e->getMessage());
        }
        $this->loadData();
    }

    public function graduateMemberAction($memberId)
    {
        try {
            $member = $this->findMemberOrFail($memberId);
            $training = $member->training;
            $user = $member->user;

            $member->update(['status' => 'graduate']);

            $certificateNumber = strtoupper('CERT-' . $training->id . '-' . $user->id . '-' . now()->format('Ymd'));
            $data = [
                'user' => $user,
                'training' => $training,
                'certificateNumber' => $certificateNumber,
                'supervisorName' => 'Ir. Budi Santoso, M.T.',
            ];

            $pdf = Pdf::loadView('certificate.template', $data)->setPaper('a4', 'landscape');
            $filename = 'certificates/' . $certificateNumber . '.pdf';
            Storage::disk('public')->put($filename, $pdf->output());

            Certificate::create([
                'user_id' => $user->id,
                'training_id' => $training->id,
                'name' => 'Sertifikat ' . $training->name,
                'organization' => 'PT Dirgantara Indonesia',
                'issue_date' => now(),
                'file_path' => $filename,
            ]);

            $user->notify(new TrainingGraduatedNotification($training));
            session()->flash('success', 'Peserta telah lulus dan sertifikat telah dibuat.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal meluluskan peserta: ' . $e->getMessage());
        }
        $this->loadData();
    }
}
