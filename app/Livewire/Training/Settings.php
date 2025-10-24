<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Livewire\Component;

class Settings extends Component
{
    public $trainingId;
    public $training;
    public $name;
    public $description;
    public $status;

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->training = Training::findOrFail($trainingId);
        $this->name = $this->training->name;
        $this->description = $this->training->description;
        $this->status = $this->training->status;
    }

    public function updateSettings()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,close',
        ]);

        try {
            $this->training->update([
                'name' => $this->name,
                'description' => $this->description,
                'status' => $this->status,
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
