<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borang extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_size',
    ];
}
