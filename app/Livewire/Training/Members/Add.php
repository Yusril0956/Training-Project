<?php

namespace App\Livewire\Training\Members;

use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\User;
use App\Notifications\TrainingInvitationNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Exception;

class Add extends Component
{
    public Training $training;
    
    public $users = [];
    public $selectedUsers = [];
    public $selectAll = false;

    public function mount($trainingId) 
    {
        $this->training = Training::findOrFail($trainingId);
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $trainingDetail = $this->training->detail()->firstOrCreate([], [
            'start_date' => now(),
            'end_date'   => now()->addMonth(),
        ]);

        $existingMemberIds = TrainingMember::where('training_detail_id', $trainingDetail->id)
            ->pluck('user_id');

        $this->users = User::whereNotIn('id', $existingMemberIds)
            ->select('id', 'name', 'email', 'nik')
            ->orderBy('name')
            ->get();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = $this->users->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectedUsers()
    {
        $this->selectAll = count($this->selectedUsers) === count($this->users);
    }

    public function addMembers()
    {
        $this->validate([
            'selectedUsers'   => 'required|array|min:1',
            'selectedUsers.*' => 'exists:users,id',
        ]);

        try {
            $trainingDetail = $this->training->detail;

            $alreadyMemberIds = TrainingMember::where('training_detail_id', $trainingDetail->id)
                ->whereIn('user_id', $this->selectedUsers)
                ->pluck('user_id')
                ->toArray();

            $newUserIds = array_diff($this->selectedUsers, $alreadyMemberIds);

            if (empty($newUserIds)) {
                session()->flash('info', 'Semua peserta yang dipilih sudah terdaftar.');
                return redirect()->route('training.members.index', $this->training->id); // Asumsi nama route
            }

            $newMembersData = [];
            $now = now();
            foreach ($newUserIds as $userId) {
                $newMembersData[] = [
                    'training_detail_id' => $trainingDetail->id,
                    'user_id'            => $userId,
                    'status'             => 'accept',
                    'series'             => 'TRN-' . strtoupper(uniqid()),
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ];
            }

            DB::table('training_members')->insert($newMembersData);

            $newlyAddedUsers = User::whereIn('id', $newUserIds)->get();
            foreach ($newlyAddedUsers as $user) {
                $user->notify(new TrainingInvitationNotification($this->training));
            }

            $addedCount = count($newUserIds);
            $skippedCount = count($alreadyMemberIds);
            $message = "$addedCount peserta berhasil ditambahkan.";
            if ($skippedCount > 0) {
                $message .= " $skippedCount peserta sudah terdaftar dan diabaikan.";
            }

            session()->flash('success', $message);
        } catch (Exception $e) {
            Log::error('Gagal tambah member: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menambahkan peserta.');
        }
        return redirect()->route('training.members.index', $this->training->id);
    }

    public function render()
    {
        return view('livewire.training.members.add')
            ->layout('layouts.training');
    }
}
