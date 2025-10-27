<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    protected $table = 'jenis_trainings';

    public function trainings()
    {
        return $this->hasMany(Training::class, 'jenis_training_id');
    }

}
