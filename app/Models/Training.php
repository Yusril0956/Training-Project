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
    ];

    public function jenisTraining()
    {
        return $this->belongsTo(JenisTraining::class, 'jenis_training_id');
    }

    protected $table = 'trainings';

    public function detail()
    {
        return $this->hasOne(TrainingDetail::class, 'training_id');
    }

    public function members()
    {
        return $this->hasManyThrough(TrainingMember::class, TrainingDetail::class, 'training_id', 'training_detail_id', 'id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'training_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'training_id');
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
        return $this->hasManyThrough(TrainingMember::class, TrainingDetail::class, 'training_id', 'training_detail_id', 'id', 'id')->where('training_members.status', 'pending');
    }

    public function graduateMembers()
    {
        return $this->hasManyThrough(TrainingMember::class, TrainingDetail::class, 'training_id', 'training_detail_id', 'id', 'id')->where('training_members.status', 'graduate');
    }

    public function attendanceSessions()
    {
        return $this->hasMany(AttendanceSession::class, 'training_id')->orderBy('date', 'asc');
    }
}
