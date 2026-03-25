<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['image_path', 'caption', 'event_date', 'uploaded_by'];

    protected $casts = ['event_date' => 'date'];

    public function uploadedBy() { return $this->belongsTo(User::class, 'uploaded_by'); }
}
