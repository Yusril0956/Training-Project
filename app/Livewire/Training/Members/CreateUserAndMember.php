<?php

namespace App\Livewire\Training\Members;

use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\User;
use App\Notifications\TrainingInvitationNotification;
use Livewire\Component;
use App\Services\AuthService;

class CreateUserAndMember extends Component
{
    public $trainingId;
    public $training;

    public $newUserName = '';
    public $newUserNik = '';
    public $newUserEmail = '';
    public $newUserStatus = 'active';

    protected $authService;

    public function boot(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->training = Training::findOrFail($trainingId);
    }

    public function addNewUser()
    {
        $this->validate([
            'newUserName' => 'required|string|max:255',
            'newUserNik' => 'required|numeric|digits:6',
            'newUserEmail' => 'required|email|unique:users,email',
            'newUserStatus' => 'required|in:active,inactive',
        ]);

        try {
            $newUser = $this->authService->createUser([
                'name' => $this->newUserName,
                'email' => $this->newUserEmail,
                'nik' => $this->newUserNik,
                'password' => $this->newUserNik,
                'role' => 'User',
            ]);

            $newUser->update(['status' => $this->newUserStatus]);

            if (!$this->training->start_date) {
                $this->training->update([
                    'start_date' => now(),
                    'end_date' => now()->addMonth(),
                ]);
            }

            $this->training->members()->create([
                'user_id' => $newUser->id,
                'status' => 'accept',
                'series' => 'TRN-' . strtoupper(uniqid()),
            ]);

            $newUser->notify(new TrainingInvitationNotification($this->training));

            return redirect()->route('training.members.index', $this->trainingId)
                ->with('success', 'User baru berhasil ditambahkan dan didaftarkan.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    public function render()
    {

        return view('livewire.training.members.create-user-and-member')
            ->layout('layouts.training', ['title' => 'Add New Member', 'training' => $this->training]);
    }
}
