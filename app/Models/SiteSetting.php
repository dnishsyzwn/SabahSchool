<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public $timestamps = false;

    protected $fillable = ['key', 'value', 'type', 'group', 'updated_by'];

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    // Get a setting value by key
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        return $setting?->value ?? $default;
    }

    // Set a setting value by key
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by'); }
}
