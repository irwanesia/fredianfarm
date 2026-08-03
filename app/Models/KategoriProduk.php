<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class KategoriProduk extends Model
{
    use HasSlug;

    protected $table = 'kategori_produk';

    protected $fillable = ['nama', 'deskripsi', 'urutan', 'is_active'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }

    public function produks()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
