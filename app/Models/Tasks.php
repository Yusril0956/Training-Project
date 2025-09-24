<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tasks extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'training_id',
        'attachment_path',
    ];

    protected $table = 'tasks';

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    public function submissions()
    {
        return $this->hasMany(TaskSubmission::class, 'task_id');
    }

    /**
     * Check if task is completed by a specific user
     */
    public function is_completed_by($user)
    {
        if (!$user) {
            return false;
        }

        return $this->submissions()->where('user_id', $user->id)->exists();
    }
}
