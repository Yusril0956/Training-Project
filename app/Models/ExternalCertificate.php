<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'participant_name',
        'activity_name',
        'activity_date',
        'file_path',
    ];

    protected $table = 'external_certificate'; // Fix table name to match migration

    protected $casts = [
        'activity_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
