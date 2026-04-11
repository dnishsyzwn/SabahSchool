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
        'event_date',
        'is_active',
        'sort_order',
    ];
}
