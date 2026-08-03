<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaSosial extends Model
{
    protected $table = 'media_sosial';

    protected $fillable = ['platform', 'url', 'icon', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
