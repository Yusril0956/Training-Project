<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'Feedback';
    protected $fillable = [
        'nama_pengirim',
        'pesan',
        'tanggal_kirim',
    ];

    protected $dates = [
        'tanggal_kirim',
    ];

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
