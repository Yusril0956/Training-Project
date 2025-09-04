<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingDetail extends Model
{
    use HasFactory;

    protected $fillable = ['training_id', 'start_date', 'end_date'];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    public function members()
    {
        return $this->hasMany(TrainingMember::class, 'training_detail_id');
    }
}
