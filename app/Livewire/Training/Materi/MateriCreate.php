<?php

namespace App\Livewire\Training\Materi;

use App\Models\Materi;
use App\Models\Training;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Exception; // Diperlukan untuk try-catch

class MateriCreate extends Component
{
    use WithFileUploads;

    public Training $training;

    // Properti untuk form
    public $title = '';
    public $description = '';
    public $file;

    // [PERBAIKAN] Kembali menggunakan properti $rules untuk validasi
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,gif,mp4,avi,mov|max:10240', // 10MB
    ];

    // [OPTIMASI] Tetap gunakan Route-Model Binding untuk 'mount'
    public function mount(Training $training)
    {
        $this->training = $training;
    }

    // [PERBAIKAN] Tambahkan kembali method 'updated' untuk validasi real-time
    // Ini akan terpicu oleh 'wire:model.live' dan 'wire:model.blur'
    public function updated($propertyName)
    {
        // Validasi hanya properti yang baru saja diubah
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        // Validasi semua data sebelum disimpan
        $validatedData = $this->validate();

        try {
            $dataToCreate = [
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'file_path' => null,
                'file_name' => null,
                'file_type' => null,
            ];

            if ($this->file) {
                $folderName = 'trainings/' . $this->training->id . '/materials';
                
                // [BEST PRACTICE] Biarkan Laravel membuat nama unik (hash)
                // Ini lebih aman dan menghindari konflik.
                $dataToCreate['file_path'] = $this->file->store($folderName, 'public');
                $dataToCreate['file_name'] = $this->file->getClientOriginalName();
                $dataToCreate['file_type'] = $this->file->getMimeType();
            }

            // [BEST PRACTICE] Gunakan relasi untuk membuat data (otomatis mengisi training_id)
            $this->training->materis()->create($dataToCreate);

            session()->flash('success', 'Materi berhasil ditambahkan!');
            
            // Gunakan redirect standar yang kompatibel
            return redirect()->route('training.materi.index', $this->training->id);

        } catch (Exception $e) {
            // [BEST PRACTICE] Log error untuk debugging
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