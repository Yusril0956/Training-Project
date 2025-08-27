<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingDetail extends Model
{
    use HasFactory;

    protected $fillable = ['training_id', 'tanggal_awal', 'tanggal_akhir'];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function members()
    {
        return $this->hasMany(TrainingMember::class);
    }
}
