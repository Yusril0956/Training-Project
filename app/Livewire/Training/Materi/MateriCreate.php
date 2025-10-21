<?php

namespace App\Livewire\Training\Materi;

use App\Models\Materi;
use App\Models\Training;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

class MateriCreate extends Component
{
    use WithFileUploads;

    public $trainingId;
    public Training $training;
    public $title = '';
    public $description = '';
    public $file;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,gif,mp4,avi,mov|max:10240', // 10MB
    ];

    public function mount($trainingId)
    {
        $this->trainingId = $trainingId;
        $this->training = Training::findOrFail($trainingId);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            $dataToCreate = [
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'training_id' => $this->trainingId,
                'file_path' => null,
                'file_name' => null,
                'file_type' => null,
            ];

            if ($this->file) {
                $originalName = $this->file->getClientOriginalName();
                $extension = $this->file->getClientOriginalExtension();
                $uniqueName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;
                $folderName = 'trainings/' . $this->trainingId . '/materials';

                $dataToCreate['file_path'] = $this->file->storeAs($folderName, $uniqueName, 'public');
                $dataToCreate['file_name'] = $originalName;
                $dataToCreate['file_type'] = $this->file->getMimeType();
            }

            Materi::create($dataToCreate);

            session()->flash('success', 'Materi berhasil ditambahkan!');
            return redirect()->route('training.materi.index', $this->trainingId);
        } catch (Exception $e) {
            session()->flash('error', 'Gagal menambahkan materi. Terjadi kesalahan pada server.');
        }
    }

    public function render()
    {
        return view('livewire.training.materi.materi-create')
            ->layout('layouts.training');
    }
}
