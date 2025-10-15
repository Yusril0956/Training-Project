<?php

namespace App\Livewire\Training\Tasks;

use App\Models\Training;
use App\Models\Tasks;
use App\Models\TaskSubmission;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Review extends Component
{
    public $trainingId;
    public $taskId;
    public $submissionId;
    public $training;
    public $task;
    public $submission;
    public $score;
    public $comment;

    protected $rules = [
        'score' => 'required|integer|min:0|max:100',
        'comment' => 'nullable|string',
    ];

    public function mount($trainingId, $taskId, $submissionId)
    {
        $this->trainingId = $trainingId;
        $this->taskId = $taskId;
        $this->submissionId = $submissionId;
        $this->training = Training::findOrFail($trainingId);
        $this->task = Tasks::findOrFail($taskId);
        $this->submission = TaskSubmission::with('user')->where('task_id', $taskId)->findOrFail($submissionId);
    }

    public function saveReview()
    {
        $this->validate();

        if ($this->submission->review) {
            $this->submission->review->update([
                'score' => $this->score,
                'comment' => $this->comment,
                'reviewer_id' => Auth::id(),
            ]);
            $message = 'Penilaian berhasil diperbarui.';
        } else {
            $this->submission->review()->create([
                'score' => $this->score,
                'comment' => $this->comment,
                'reviewer_id' => Auth::id(),
            ]);
            $message = 'Penilaian berhasil disimpan.';
        }

        // Notifikasi ke user
        $user = User::find($this->submission->user_id);
        if ($user) {
            $user->notify(new \App\Notifications\TaskSubmissionNotification($this->task, $this->submission));
        }

        session()->flash('success', $message);
        return redirect()->route('training.task.detail', [$this->trainingId, $this->taskId]);
    }

    public function render()
    {
        return view('livewire.training.tasks.review')->layout('components.layouts.training', [
            'training' => $this->training,
            'task' => $this->task,
            'submission' => $this->submission,
        ]);
    }
}
