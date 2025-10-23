<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    public function records()
    {
        return $this->hasMany(AttendanceRecord::class, 'attendance_session_id');
    }
}