<?php

namespace App\Livewire\Training\Materi;

use App\Models\Materi;
use App\Models\Training;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MateriIndex extends Component
{
    use WithPagination;

    public $trainingId;
    public $training;
    public $trainingName;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->training = Training::findOrFail($trainingId);
        $this->trainingName = $this->training->name;
    }

    /**
     * Reset halaman saat melakukan pencarian.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Hapus materi dan file dari storage.
     */
    public function deleteMateri($materiId)
    {
        if (!Auth::user()->hasAnyRole(['Admin', 'Super Admin'])) {
            session()->flash('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
            return;
        }

        try {
            $materi = Materi::findOrFail($materiId);

            if ($materi->file_path) {
                Storage::disk('public')->delete($materi->file_path);
            }

            // Hapus juga cover image jika ada
            if ($materi->cover_image) {
                Storage::disk('public')->delete($materi->cover_image);
            }

            $materi->delete();
            session()->flash('success', 'Materi berhasil dihapus!');
        } catch (Exception $e) {
            session()->flash('error', 'Gagal menghapus materi: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $materisQuery = Materi::where('training_id', $this->trainingId)
            ->when($this->search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc');

        return view('livewire.training.materi.materi-index', [
            'materis' => $materisQuery->paginate(12),
            'isAdmin' => Auth::user()->hasAnyRole(['Admin', 'Super Admin'])
        ])->layout('layouts.training');
    }
}
