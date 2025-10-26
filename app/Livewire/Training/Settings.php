<?php

namespace App\Livewire\Training;

use App\Models\Training;
use App\Models\User;
use Livewire\Component;

class Settings extends Component
{
    public $trainingId;
    public $training;
    public $name;
    public $description;
    public $status;
    public $instructor_id;
    public $instructors;

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->training = Training::findOrFail($trainingId);
        $this->name = $this->training->name;
        $this->description = $this->training->description;
        $this->status = $this->training->status;
        $this->instructor_id = $this->training->instructor_id;
        $this->instructors = User::all();
    }

    public function updateSettings()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,close',
            'instructor_id' => 'required|exists:users,id',
        ]);

        try {
            $this->training->update([
                'name' => $this->name,
                'description' => $this->description,
                'status' => $this->status,
                'instructor_id' => $this->instructor_id,
            ]);

            session()->flash('success', 'Pengaturan pelatihan berhasil diperbarui!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memperbarui pengaturan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.training.settings')->layout('layouts.training', ['title' => 'Setting']);
    }
}
