<?php

namespace App\Models;

use App\Models\ActivityLog;
use App\Models\Job;
use App\Models\NewsPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    // Role helpers
    public function isSuperAdmin(): bool { return $this->role === 'superadmin'; }
    public function isAdmin(): bool { return in_array($this->role, ['superadmin', 'admin']); }
    public function isEditor(): bool { return $this->role === 'editor'; }

    // Relationships
    public function newsPosts() { return $this->hasMany(NewsPost::class, 'author_id'); }
    public function jobs() { return $this->hasMany(Job::class, 'posted_by'); }
    public function activityLogs() { return $this->hasMany(ActivityLog::class); }
}
