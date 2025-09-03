<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Schedule extends Model
{
    protected $fillable = [
        'training_id',
        'judul',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'pengajar'
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
