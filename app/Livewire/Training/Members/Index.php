<?php

namespace App\Livewire\Training\Members;

use Livewire\Component;
use App\Models\Training;
use App\Models\TrainingMember;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $trainingId;
    public $training;
    public $pendingMembers;
    public $graduateMember;

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $user = Auth::user();
        if ($user->hasAnyRole(['Admin', 'Super Admin'])) {
            $this->training = Training::with(['members' => function ($q) {
                $q->where('status', 'accept');
            }])->findOrFail($trainingId);

            $this->pendingMembers = TrainingMember::with('user')->whereHas('trainingDetail', function ($q) use ($trainingId) {
                $q->where('training_id', $trainingId);
            })->where('status', 'pending')->get();

            $this->graduateMember = TrainingMember::with(['user.certificates' => function ($q) use ($trainingId) {
                $q->where('training_id', $trainingId);
            }])->whereHas('trainingDetail', function ($q) use ($trainingId) {
                $q->where('training_id', $trainingId);
            })->where('status', 'graduate')->get();
        } else {
            $userId = Auth::id();
            $this->training = Training::whereHas('members', function ($q) use ($userId) {
                $q->where('user_id', $userId)->whereIn('status', ['accept', 'graduate']);
            })
                ->with(['detail', 'jenisTraining', 'members'])
                ->findOrFail($trainingId);
        }
    }

    public function render()
    {
        return view('livewire.training.members.index');
    }
}
