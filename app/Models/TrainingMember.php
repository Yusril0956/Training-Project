<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMember extends Model
{
    use HasFactory;

    protected $fillable = ['training_detail_id', 'user_id', 'seri'];

    public function detail()
    {
        return $this->belongsTo(TrainingDetail::class, 'training_detail_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
