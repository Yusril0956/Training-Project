<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'training_detail_id',
        'status',
        'series',
    ];

    protected $table = 'training_members';

    public function trainingDetail()
    {
        return $this->belongsTo(TrainingDetail::class, 'training_detail_id', 'id');
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
