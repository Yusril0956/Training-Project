<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'status',
        'jenis_training_id',
    ];

    public function jenisTraining()
    {
        return $this->belongsTo(JenisTraining::class, 'jenis_training_id');
    }

    protected $table = 'trainings';

    public function detail()
    {
        return $this->hasOne(TrainingDetail::class, 'training_id');
    }

    public function members()
    {
        return $this->hasManyThrough(TrainingMember::class, TrainingDetail::class, 'training_id', 'training_detail_id', 'id', 'id');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class, 'training_id');
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'training_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'training_id');
    }

    public function getCategoryImageAttribute()
    {
        $categorySlug = strtolower(str_replace(' ', '-', $this->category ?? 'default'));
        $path = 'images/category/' . $categorySlug . '.jpg';
        return file_exists(public_path($path)) ? asset($path) : asset('images/default-training.jpg');
    }
}
