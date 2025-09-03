<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'tipe',
        'url',
        'training_id',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
