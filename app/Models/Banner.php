<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $fillable = ['judul', 'deskripsi', 'media_id', 'url', 'link_url', 'link_text', 'link_url_2', 'link_text_2', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
