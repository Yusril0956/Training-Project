<?php

namespace App\Livewire\Training\Materi;

use App\Models\Materi;
use App\Models\Training;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str; // <-- Tambahkan ini untuk Str::limit di breadcrumb

class MateriCreate extends Component
{
    use WithFileUploads;

    public Training $training;

    // Properti untuk form
    public $title = '';
    public $description = '';
    public $file;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        // Validasi 'file' akan berjalan saat 'store' dipanggil
        'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,gif,mp4,avi,mov|max:10240', // 10MB
    ];

    public function mount(Training $training)
    {
        $this->training = $training;
    }

    // [DIHAPUS] Metode 'updated' tidak diperlukan lagi
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function store()
    {
        // Validasi semua data, TERMASUK FILE, sekaligus
        $validatedData = $this->validate();

        try {
            $dataToCreate = [
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'file_path' => null,
                'file_name' => null,
                'file_type' => null,
            ];

            // 'if ($this->file)' sekarang aman karena $file adalah bagian dari form submit
            if ($this->file) {
                $folderName = 'trainings/' . $this->training->id . '/materials';

                $dataToCreate['file_path'] = $this->file->store($folderName, 'public');
                $dataToCreate['file_name'] = $this->file->getClientOriginalName();
                $dataToCreate['file_type'] = $this->file->getMimeType();
            }

            $this->training->materis()->create($dataToCreate);

            session()->flash('success', 'Materi berhasil ditambahkan!');

            return redirect()->route('training.materi.index', $this->training->id);
        } catch (Exception $e) {
            Log::error('Gagal menambahkan materi: ' . $e->getMessage());
            session()->flash('error', 'Gagal menambahkan materi. Terjadi kesalahan pada server.');
        }
    }

    public function render()
    {
        return view('livewire.training.materi.materi-create')
            ->layout('layouts.training', ['training' => $this->training]);
    }
}