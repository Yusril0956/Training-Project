<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\JenisTraining;

class TrainingController extends Controller
{
    /**
     * Halaman utama Training
     */
    public function index()
    {
        return view('pages.Training.index');
    }

    /**
     * Halaman Customer Requested Training
     */
    public function customerRequested()
    {
        $trainings = Training::all();
        $jenisTrainings = JenisTraining::all();

        return view('pages.Training.customer_requested', compact('trainings', 'jenisTrainings'));
    }

    /**
     * Halaman detail Training
     */
    public function detail($id)
    {
        $training = Training::findOrFail($id);

        return view('pages.Training.detail_training', compact('training'));
    }

    /**
     * Simpan data Training baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'             => 'required|string|max:255',
            'kategori'         => 'required|string',
            'klien'            => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'jenis_training_id'=> 'required|exists:jenis_training,id',
        ]);

        Training::create([
            'nama'             => $request->nama,
            'kategori'         => $request->kategori,
            'klien'            => $request->klien,
            'deskripsi'        => $request->deskripsi,
            'jenis_training_id'=> $request->jenis_training_id,
            'status'           => 'pending',
        ]);

        return redirect()
            ->route('training.index')
            ->with('success', 'Permintaan pelatihan berhasil ditambahkan.');
    }
}
