<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'jenis_training_id',
        'instructor_id',
        'start_date',
        'end_date',
    ];

    public function jenisTraining()
    {
        return $this->belongsTo(JenisTraining::class, 'jenis_training_id');
    }

    protected $table = 'trainings';

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function members()
    {
        return $this->hasMany(TrainingMember::class, 'training_id');
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'training_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'training_id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class, 'training_id');
    }

    public function pendingMembers()
    {
        return $this->hasMany(TrainingMember::class, 'training_id')->where('training_members.status', 'pending');
    }

    public function graduateMembers()
    {
        return $this->hasMany(TrainingMember::class, 'training_id')->where('training_members.status', 'graduate');
    }

    public function attendanceSessions()
    {
        return $this->hasMany(AttendanceSession::class, 'training_id')->orderBy('date', 'asc');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
