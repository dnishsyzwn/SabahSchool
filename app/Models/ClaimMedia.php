<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimMedia extends Model
{
    protected $table = 'claim_media';
    protected $fillable = ['claim_id', 'image_path', 'caption', 'sort_order'];

    public function claim() { return $this->belongsTo(Claim::class, 'claim_id'); }
}
