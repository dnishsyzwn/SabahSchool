<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityStory extends Model
{
    use HasFactory;

    protected $table = 'activity_stories';

    protected $fillable = [
        'title',
        'tag',
        'description',
        'image_path',
        'images',
        'event_date',
        'status',
        'published_at',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'images'       => 'array',
        'event_date'   => 'date',
        'published_at' => 'datetime',
        'is_active'    => 'boolean',
    ];
}
