<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Artikel extends Model
{
    use HasSlug;

    protected $table = 'artikel';

    protected $fillable = [
        'kategori_id', 'user_id', 'judul', 'konten', 'excerpt',
        'gambar', 'meta_title', 'meta_description',
        'ai_generated', 'is_published', 'published_at',
    ];

    protected $casts = [
        'ai_generated' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getImageAttribute(): ?string
    {
        if ($this->gambar) {
            return $this->gambar;
        }

        if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $this->konten ?? '', $m)) {
            return $m[1];
        }

        return null;
    }
}
