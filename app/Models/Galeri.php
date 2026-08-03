<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = ['judul', 'deskripsi', 'media_id', 'url', 'kategori', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
