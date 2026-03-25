<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'location', 'type', 'salary_range', 'description',
        'responsibilities', 'requirements', 'benefits', 'how_to_apply',
        'deadline', 'status', 'posted_by',
    ];

    protected $casts = ['deadline' => 'date'];

    public function applications() { return $this->hasMany(JobApplication::class); }
    public function postedBy() { return $this->belongsTo(User::class, 'posted_by'); }
}
