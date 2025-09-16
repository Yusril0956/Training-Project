<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'training_member_id',
        'attended_at',
        'status',
    ];

    protected $casts = [
        'attended_at' => 'datetime',
    ];

    public function trainingMember()
    {
        return $this->belongsTo(TrainingMember::class, 'training_member_id');
    }
}
