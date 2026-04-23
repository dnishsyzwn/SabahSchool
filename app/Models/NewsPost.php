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

    public function getExcerptPlainTextAttribute()
    {
        if ($this->excerpt) return $this->excerpt;
        if (!$this->content) return '';

        $data = json_decode($this->content, true);
        if (json_last_error() !== JSON_ERROR_NONE || !isset($data['blocks'])) {
            return \Illuminate\Support\Str::limit(strip_tags($this->content), 120);
        }

        $text = '';
        foreach ($data['blocks'] as $block) {
            if (isset($block['data']['text'])) {
                $text .= strip_tags($block['data']['text']) . ' ';
            }
        }

        return \Illuminate\Support\Str::limit(trim($text), 120);
    }
}
