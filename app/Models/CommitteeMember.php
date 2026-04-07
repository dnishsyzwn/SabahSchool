<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    protected $fillable = [
        'name', 'position', 'image_path', 'type', 'division',
        'sort_order', 'row_index', 'is_active', 'is_highlight', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'is_highlight' => 'boolean',
    ];

    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by'); }
}
