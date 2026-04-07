<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name', 'email', 'ic', 'phone', 'school', 'subject', 'message',
        'is_read', 'read_by', 'read_at', 'replied_at', 'email_notified',
    ];

    protected $casts = [
        'is_read'        => 'boolean',
        'read_at'        => 'datetime',
        'replied_at'     => 'datetime',
        'email_notified' => 'boolean',
    ];

    public function readBy() { return $this->belongsTo(User::class, 'read_by'); }
}
