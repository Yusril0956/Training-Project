<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tasks extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'deadline',
        'training_id',
    ];

    protected $dates = ['deadline'];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function is_completed_by(User $user)
    {
        return $this->completed_by === $user->id;
    }

    public function submissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }
}
