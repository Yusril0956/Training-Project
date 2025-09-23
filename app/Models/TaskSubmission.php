<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'task_id',
        'answer',
        'file_path',
        'submitted_at',
    ];

    protected $table = 'task_submissions';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Tasks::class, 'task_id');
    }

    public function review()
    {
        return $this->hasOne(TaskReview::class, 'submission_id');
    }
}
