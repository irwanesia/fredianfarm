<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Produk extends Model
{
    use HasSlug;

    protected $table = 'produk';

    protected $fillable = [
        'kategori_id', 'jenis', 'varietas', 'nama', 'deskripsi', 'jenis_wadah', 'umur_simpan',
        'harga', 'stok_status', 'berat',
        'link_tiktok', 'link_shopee', 'is_active',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function gambar()
    {
        return $this->hasMany(GambarProduk::class, 'produk_id')->orderBy('urutan');
    }

    public function getFotoUtamaAttribute()
    {
        return $this->gambar->first()->url ?? null;
    }

    public function variants()
    {
        return $this->hasMany(ProdukVariant::class, 'produk_id')->where('is_active', true)->orderBy('urutan');
    }

    public function getHargaMinAttribute(): ?float
    {
        $prices = $this->variants->pluck('harga')->map(fn($v) => (float) $v)->filter();
        if ($prices->count()) {
            return $prices->min();
        }
        return $this->harga !== null ? (float) $this->harga : null;
    }

    public function getHargaMaxAttribute(): ?float
    {
        $prices = $this->variants->pluck('harga')->map(fn($v) => (float) $v)->filter();
        if ($prices->count()) {
            return $prices->max();
        }
        return $this->harga !== null ? (float) $this->harga : null;
    }

    public function getHargaRangeLabelAttribute(): string
    {
        $min = $this->hargaMin;
        if ($min === null) {
            return 'Rp 0';
        }
        $fmt = fn($n) => 'Rp ' . number_format((float) $n, 0, ',', '.');
        if ($this->hargaMax === $min) {
            return $fmt($min);
        }
        return $fmt($min) . ' – ' . $fmt($this->hargaMax);
    }
}
