<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'slug'];

    public function posts() { return $this->hasMany(NewsPost::class, 'category_id'); }
}
