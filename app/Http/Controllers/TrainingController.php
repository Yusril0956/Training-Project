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
        $approvedTrainings = Training::where('status', 'approved')->get();
        $modalId = 'action-training';
        $modalTitle = 'Action';
        $modalDescription = 'Silahkan pilih tindakan yang diinginkan.';
        $modalButton1 = 'Reject';
        $modalButton2 = 'Approve';


        return view('pages.Training.customer_requested', compact('trainings', 'jenisTrainings', 'modalId', 'modalTitle', 'modalDescription', 'modalButton1', 'modalButton2', 'approvedTrainings'));
    }

    /**
     * Halaman detail Training
     */
    public function detail($id)
    {
        $training = Training::findOrFail($id);
        $modalId = 'reject-training'; // ID unik untuk modal
        $modalId = 'tolak-training';
        $modalTitle = 'Apa kamu yakin?';
        $modalDescription = 'Tolak permintaan kelas training';
        $modalButton = 'Tolak';
        $formAction = route('training.reject', $training->id);
        $formMethod = 'DELETE';

        return view('pages.Training.detail_training', compact('training', 'modalId', 'modalTitle', 'modalDescription', 'modalButton', 'formAction', 'formMethod'));
    }

    public function reject($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'rejected';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil ditolak');
    }

    public function approve($id)
    {
        $training = Training::findOrFail($id);
        $training->status = 'approved';
        $training->save();
        return redirect()->back()->with('success', 'Training berhasil disetujui');
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
            'jenis_training_id' => 'required|exists:jenis_training,id',
        ]);

        Training::create([
            'nama'             => $request->nama,
            'kategori'         => $request->kategori,
            'klien'            => $request->klien,
            'deskripsi'        => $request->deskripsi,
            'jenis_training_id' => $request->jenis_training_id,
            'status'           => 'pending',
        ]);

        return redirect()
            ->route('customer.requested')
            ->with('success', 'Permintaan pelatihan berhasil ditambahkan.');
    }
}
