<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'training_id',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
