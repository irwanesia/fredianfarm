<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';

    protected $fillable = ['nama', 'daerah', 'foto', 'video_url', 'review', 'rating', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
    ];
}
