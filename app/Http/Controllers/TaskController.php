<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        // latest tasks with pagination
        $tasks = $training->tasks()->latest()->paginate(10);
        return view('training.tasks.index', compact('training', 'tasks'));
    }

    public function store(Request $request, $trainingId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'training_id' => 'required|exists:trainings,id',
            'deadline' => 'required|date',
            'attachment' => 'nullable|file|max:5120',
        ]);

        $path = $request->file('attachment')?->store('attachments', 'public');

        Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'training_id' => $request->training_id,
            'deadline' => $request->deadline,
            'attachment_path' => $path,
        ]);

        return redirect()->route('training.tasks', $trainingId)->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show($trainingId, $taskId)
    {
        $task = Tasks::where('training_id', $trainingId)->findOrFail($taskId);
        return view('training.tasks.detail', compact('task'));
    }

    public function create($trainingId)
    {
        $training = Training::findOrFail($trainingId);
        return view('training.tasks.create', compact('training'));
    }

    public function destroy($trainingId, $taskId)
    {
        $task = Tasks::where('training_id', $trainingId)->findOrFail($taskId);
        $task->delete();

        return back()->with('success', 'Tugas berhasil dihapus.');
    }
}
