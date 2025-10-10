<?php

namespace App\Livewire\Training;

use App\Models\Training;
use Livewire\Component;
use Livewire\WithFileUploads;

class MaterialsList extends Component
{
    use WithFileUploads;

    public $id;
    public $training;
    public $judul;
    public $deskripsi;
    public $tipe;
    public $file;
    public $url;

    public function mount($id)
    {
        $this->id = $id;
        $this->training = Training::with('materis')->findOrFail($id);
    }

    public function uploadMaterial()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:pdf,video,link,ppt',
            'file' => 'nullable|file|mimes:pdf,mp4,ppt,pptx|max:10240',
            'url' => 'nullable|url',
        ]);

        try {
            $url = $this->url;
            if ($this->file) {
                $url = $this->file->store('materials', 'public');
            }

            $this->training->materis()->create([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'tipe' => $this->tipe,
                'url' => $url,
            ]);

            session()->flash('success', 'Materi berhasil diupload!');
            $this->reset(['judul', 'deskripsi', 'tipe', 'file', 'url']);
            $this->training->refresh();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengupload materi: ' . $e->getMessage());
        }
    }

    public function deleteMaterial($materialId)
    {
        try {
            $material = $this->training->materis()->findOrFail($materialId);
            $material->delete();

            session()->flash('success', 'Materi berhasil dihapus!');
            $this->training->refresh();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus materi: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.training.materials-list');
    }
}
