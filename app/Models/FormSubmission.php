<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
        'form_type_id', 'name', 'email', 'phone', 'subject',
        'message', 'file_path', 'status', 'admin_notes',
        'status_changed_by', 'status_changed_at', 'email_notified',
    ];

    protected $casts = [
        'status_changed_at' => 'datetime',
        'email_notified'    => 'boolean',
    ];

    public function formType() { return $this->belongsTo(FormType::class); }
    public function statusChangedBy() { return $this->belongsTo(User::class, 'status_changed_by'); }
}
