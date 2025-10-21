<?php

namespace App\Livewire\Training\Members;

use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\User;
use App\Notifications\TrainingInvitationNotification;
use Livewire\Component;

class CreateUserAndMember extends Component
{
    public $trainingId;
    public $training;

    // Properti untuk form
    public $newUserName = '';
    public $newUserNik = '';
    public $newUserEmail = '';
    public $newUserStatus = 'active';

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
            // Logika pembuatan user dan member tetap sama
            $newUser = User::create([
                'name' => $this->newUserName,
                'email' => $this->newUserEmail,
                'nik' => $this->newUserNik,
                'password' => bcrypt($this->newUserNik),
                'role' => 'user',
                'status' => $this->newUserStatus,
            ]);

            $trainingDetail = $this->training->detail ?? $this->training->detail()->create([
                'start_date' => now(),
                'end_date' => now()->addMonth(),
            ]);

            $trainingDetail->members()->create([
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
        // Render view dengan layout utama untuk training
        return view('livewire.training.members.create-user-and-member')
            ->layout('layouts.training', ['title' => 'Add New Member']);
    }
}
