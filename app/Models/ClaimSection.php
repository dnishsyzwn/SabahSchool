<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimSection extends Model
{
    protected $fillable = ['title', 'description', 'sort_order', 'is_active', 'created_by', 'updated_by'];

    protected $casts = ['is_active' => 'boolean'];

    public function media() { return $this->hasMany(ClaimMedia::class, 'section_id')->orderBy('sort_order'); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by'); }
}
