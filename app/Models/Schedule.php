<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Schedule extends Model
{
    protected $fillable = [
        'training_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'location',
        'instructor'
    ];

    protected $table = 'schedules';

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
