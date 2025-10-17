<?php

namespace App\Livewire\Training\Members;

use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\User;
use App\Notifications\TrainingInvitationNotification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Add extends Component
{
    public Training $training;
    public $users;

    public $selectedUsers = [];
    public $selectAll = false;

    public function mount(Training $training)
    {
        $this->training = $training;
        $this->loadUsers();
    }

    public function loadUsers()
    {
        // 1. Ambil semua ID user yang sudah menjadi anggota di pelatihan ini
        $existingMemberIds = TrainingMember::whereHas('trainingDetail', function ($query) {
            $query->where('training_id', $this->training->id);
        })->pluck('user_id')->toArray();

        // 2. Ambil semua user yang ID-nya tidak termasuk dalam daftar di atas
        $this->users = User::whereNotIn('id', $existingMemberIds)->get();
    }

    public function addMembers()
    {
        $this->validate([
            'selectedUsers'   => 'required|array|min:1',
            'selectedUsers.*' => 'exists:users,id',
        ]);

        try {
            // Pastikan training detail ada, jika tidak, buat baru
            $trainingDetail = $this->training->detail()->firstOrCreate([], [
                'start_date' => now(),
                'end_date'   => now()->addMonth(),
            ]);

            // 1. Ambil ID pengguna yang dipilih dan sudah menjadi anggota untuk diabaikan
            $alreadyMemberIds = TrainingMember::where('training_detail_id', $trainingDetail->id)
                ->whereIn('user_id', $this->selectedUsers)
                ->pluck('user_id')
                ->toArray();
                
            // 2. Filter untuk mendapatkan hanya ID pengguna baru yang akan ditambahkan
            $newUserIds = array_diff($this->selectedUsers, $alreadyMemberIds);

            if (empty($newUserIds)) {
                session()->flash('info', 'Semua peserta yang dipilih sudah terdaftar.');
                $this->dispatch('close-modal', 'add-member-modal'); // Tutup modal
                return;
            }

            // 3. Siapkan data untuk bulk insert
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

            // 4. Lakukan bulk insert
            DB::table('training_members')->insert($newMembersData);
            
            // 5. Kirim notifikasi ke pengguna yang baru ditambahkan
            $newlyAddedUsers = User::whereIn('id', $newUserIds)->get();
            foreach ($newlyAddedUsers as $user) {
                $user->notify(new TrainingInvitationNotification($this->training));
            }

            // Siapkan pesan flash
            $addedCount = count($newUserIds);
            $skippedCount = count($alreadyMemberIds);
            $message = "$addedCount peserta berhasil ditambahkan.";
            if ($skippedCount > 0) {
                $message .= " $skippedCount peserta sudah terdaftar dan diabaikan.";
            }

            session()->flash('success', $message);

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } finally {
            // Reset state dan muat ulang data
            $this->reset(['selectedUsers', 'selectAll']);
            $this->loadUsers();
            $this->dispatch('close-modal', 'add-member-modal'); // Selalu tutup modal
        }
    }

    public function canAddMembers()
    {
        return count($this->selectedUsers) > 0;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = $this->users->pluck('id')->map(fn ($id) => (string) $id)->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }
    
    public function updatedSelectedUsers()
    {
        $this->selectAll = count($this->selectedUsers) === count($this->users);
    }

    public function render()
    {
        return view('livewire.training.members.add')->layout('components.layouts.training');
    }
}