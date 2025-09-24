<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskReview extends Model
{
    protected $fillable = [
        'submission_id',
        'score',
        'comment',
        'reviewer_id',
    ];

    protected $table = 'task_reviews';

    public function submission()
    {
        return $this->belongsTo(TaskSubmission::class, 'submission_id', 'id');
        // Pastikan TaskSubmission model menggunakan protected $table = 'task_submissions';
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
