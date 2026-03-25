<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobAttachment extends Model
{
    protected $fillable = ['application_id', 'file_path', 'file_name', 'file_size'];

    public function application() { return $this->belongsTo(JobApplication::class, 'application_id'); }
}
