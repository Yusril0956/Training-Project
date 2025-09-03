<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kategori', 'klien', 'deskripsi', 'status', 'jenis_training_id'];

    public function jenisTraining()
    {
        return $this->belongsTo(JenisTraining::class);
    }

    public function details()
    {
        return $this->hasMany(TrainingDetail::class);
    }

    // App\Models\Training.php
    public function members()
    {
        return $this->hasMany(User::class);
    }
}
