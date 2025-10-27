<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'title',
        'description',
        'media_type',
        'media_path',
        'training_id',
    ];

    protected $table = 'training_materials';

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
