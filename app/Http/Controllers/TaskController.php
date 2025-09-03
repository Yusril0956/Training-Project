<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($trainingId)
    {
        $training = Training::with('tasks')->findOrFail($trainingId);
        return view('training.tasks.index', compact('training'));
    }

    public function store(Request $request, $trainingId)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        Tasks::create([
            'training_id' => $trainingId,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('training.tasks', $trainingId)->with('success', 'Tugas berhasil dibuat.');
    }

    public function destroy($trainingId, $taskId)
    {
        $task = Tasks::where('training_id', $trainingId)->findOrFail($taskId);
        $task->delete();

        return back()->with('success', 'Tugas berhasil dihapus.');
    }
}