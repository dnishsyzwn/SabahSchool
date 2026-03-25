<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'action', 'model_type', 'model_id',
        'description', 'ip_address', 'user_agent',
    ];

    protected $casts = ['created_at' => 'datetime'];

    public function user() { return $this->belongsTo(User::class); }

    // Helper to easily log an action
    public static function record(string $action, ?string $description = null, ?Model $model = null): void
    {
        static::create([
            'user_id'     => auth()->id(),
            'action'      => $action,
            'model_type'  => $model ? get_class($model) : null,
            'model_id'    => $model?->id,
            'description' => $description,
            'ip_address'  => request()?->ip(),
            'user_agent'  => request()?->userAgent(),
            'created_at'  => now(),
        ]);
    }
}
