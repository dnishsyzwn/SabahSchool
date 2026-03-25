<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    protected $fillable = ['post_id', 'image_path', 'caption', 'sort_order'];

    public function post() { return $this->belongsTo(NewsPost::class, 'post_id'); }
}
