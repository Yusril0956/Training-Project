<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'training_id',
        'status',
        'series',
    ];

    protected $table = 'training_members';

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class, 'training_member_id');
    }
}
