<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\MustVerifyEmail;

// Import related models
use App\Models\TrainingMember;
use App\Models\Role;
use App\Models\Training;
use App\Models\Certificate;
use App\Models\TaskSubmission;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar_url',
        'address',
        'phone',
        'nik',
        'city',
        'password',
        'google_id',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills' => 'array',
        ];
    }

    public function trainingMembers()
    {
        return $this->hasMany(TrainingMember::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    // Tambahkan fungsi ini di sini
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the user's primary role
     */
    public function getRoleAttribute()
    {
        return $this->roles()->first()?->name ?? null;
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Check if user has any of the specified roles
     */
    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('name', (array) $roles)->exists();
    }
}
