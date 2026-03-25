<?php

namespace App\Models;

use App\Models\NewsCategory;
use App\Models\NewsImage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'thumbnail',
        'category_id', 'author_id', 'status', 'view_count', 'published_at',
    ];

    protected $casts = ['published_at' => 'datetime'];

    public function category() { return $this->belongsTo(NewsCategory::class, 'category_id'); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function images() { return $this->hasMany(NewsImage::class, 'post_id')->orderBy('sort_order'); }
}
