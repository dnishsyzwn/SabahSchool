<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id', 'name', 'ic_no', 'email', 'phone', 'resume_path', 'message',
        'status', 'admin_notes', 'status_changed_by', 'status_changed_at', 'email_notified',
    ];

    protected $casts = [
        'status_changed_at' => 'datetime',
        'email_notified'    => 'boolean',
    ];

    public function job() { return $this->belongsTo(Job::class); }
    public function attachments() { return $this->hasMany(JobAttachment::class, 'application_id'); }
    public function statusChangedBy() { return $this->belongsTo(User::class, 'status_changed_by'); }
}
