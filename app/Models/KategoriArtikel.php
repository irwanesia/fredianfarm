<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class KategoriArtikel extends Model
{
    use HasSlug;

    protected $table = 'kategori_artikel';

    protected $fillable = ['nama', 'deskripsi', 'urutan', 'is_active'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'kategori_id');
    }
}
