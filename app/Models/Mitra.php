<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $table = 'mitra';

    protected $fillable = ['nama', 'urutan', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
