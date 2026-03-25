<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'image_path', 'event_date',
        'location', 'status', 'published_at', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'event_date'   => 'date',
        'published_at' => 'datetime',
    ];

    public function images() { return $this->hasMany(ActivityImage::class)->orderBy('sort_order'); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by'); }
}
