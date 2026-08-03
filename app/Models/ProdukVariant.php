<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukVariant extends Model
{
    protected $table = 'produk_variants';

    protected $fillable = [
        'produk_id', 'nama', 'harga', 'berat', 'stok_status', 'is_active', 'urutan',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
