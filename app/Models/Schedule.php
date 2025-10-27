<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'location',
        'instructor',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
