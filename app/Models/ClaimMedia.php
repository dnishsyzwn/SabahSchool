<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimMedia extends Model
{
    protected $fillable = ['section_id', 'file_path', 'file_type', 'caption', 'sort_order', 'uploaded_by'];

    public function section() { return $this->belongsTo(ClaimSection::class, 'section_id'); }
    public function uploadedBy() { return $this->belongsTo(User::class, 'uploaded_by'); }
}
