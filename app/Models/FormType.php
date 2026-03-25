<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormType extends Model
{
    protected $fillable = ['name', 'description', 'file_path', 'sort_order', 'is_active', 'created_by', 'updated_by'];

    protected $casts = ['is_active' => 'boolean'];

    public function submissions() { return $this->hasMany(FormSubmission::class); }
    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }
    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by'); }
}
