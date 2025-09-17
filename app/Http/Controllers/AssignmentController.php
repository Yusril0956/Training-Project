<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Menampilkan daftar tugas untuk training tertentu
     */
    public function index($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        $assignments = Assignment::where('training_id', $trainingId)->get();

        return view('assignments.index', compact('training', 'assignments'));
    }

    /**
     * Form buat tugas baru
     */
    public function create($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        return view('assignments.create', compact('training'));
    }

    /**
     * Simpan tugas baru
     */
    public function store(Request $request, $trainingId)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'type'        => 'required|in:online,offline',
        'location'    => 'nullable|string',
        'due_date'    => 'nullable|date',
    ]);

    // ✅ Update atau buat Training otomatis
    Training::updateOrCreate(
        ['id' => $trainingId], // cari berdasarkan ID training
        [
            'name'             => 'Pelatihan Sistem Avionik',
            'category'         => 'technical',
            'description'      => 'Pelatihan mengenai sistem avionik terbaru untuk teknisi.',
            'jenis_training_id'=> 1,
            'status'           => 'approved',
        ]
    );

    // ✅ Buat assignment
    Assignment::create([
        'training_id' => $trainingId,
        'title'       => $request->title,
        'description' => $request->description,
        'type'        => $request->type,
        'location'    => $request->type === 'offline' ? $request->location : null,
        'due_date'    => $request->due_date,
    ]);

    return redirect()->route('assignments.index', $trainingId)
        ->with('success', 'Tugas berhasil dibuat dan Training otomatis diperbarui.');
}


    /**
     * Peserta submit tugas
     */
    public function submit(Request $request, $assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);

        $request->validate([
            'answer' => 'nullable|string',
            'file'   => 'nullable|file|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'user_id'       => Auth::id(),
            'answer'        => $request->answer,
            'file'          => $filePath,
            'score'         => null,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan.');
    }

    /**
     * Admin melihat submissions
     */
    public function submissions($assignmentId)
    {
        $assignment = Assignment::with('submissions.user')->findOrFail($assignmentId);
        return view('assignments.submissions', compact('assignment'));
    }

    /**
     * Admin memberi nilai
     */
    public function grade(Request $request, $submissionId)
    {
        $request->validate([
            'score' => 'required|numeric|min:0|max:100',
        ]);

        $submission = AssignmentSubmission::findOrFail($submissionId);
        $submission->score = $request->score;
        $submission->save();

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }
}
