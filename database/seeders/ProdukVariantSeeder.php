<?php

namespace Database\Seeders;

use App\Models\ProdukVariant;
use Illuminate\Database\Seeder;

class ProdukVariantSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // G-0 (id:1)
            ['produk_id' => 1, 'nama' => '100 Biji (Ukuran Kelereng)', 'harga' => 125000, 'berat' => null, 'stok_status' => 'tersedia', 'urutan' => 1],
            ['produk_id' => 1, 'nama' => '100 Biji (Ukuran Besar)',   'harga' => 175000, 'berat' => null, 'stok_status' => 'terbatas', 'urutan' => 2],
            ['produk_id' => 1, 'nama' => '10 Kg (Karung)',            'harga' => 250000, 'berat' => '10', 'stok_status' => 'terbatas', 'urutan' => 3],
            // G-0 MZ (id:2)
            ['produk_id' => 2, 'nama' => '5 Kg',    'harga' => 150000, 'berat' => '5',  'stok_status' => 'tersedia', 'urutan' => 1],
            ['produk_id' => 2, 'nama' => '10 Kg',   'harga' => 275000, 'berat' => '10', 'stok_status' => 'tersedia', 'urutan' => 2],
            ['produk_id' => 2, 'nama' => '25 Kg',   'harga' => 650000, 'berat' => '25', 'stok_status' => 'pre_order', 'urutan' => 3],
            // Granola L (id:3)
            ['produk_id' => 3, 'nama' => '10 Kg',   'harga' => 80000,  'berat' => '10', 'stok_status' => 'tersedia', 'urutan' => 1],
            ['produk_id' => 3, 'nama' => '25 Kg',   'harga' => 180000, 'berat' => '25', 'stok_status' => 'tersedia', 'urutan' => 2],
            ['produk_id' => 3, 'nama' => '50 Kg',   'harga' => 340000, 'berat' => '50', 'stok_status' => 'pre_order', 'urutan' => 3],
            // G-0 Plus (id:4)
            ['produk_id' => 4, 'nama' => '10 Kg',   'harga' => 300000, 'berat' => '10', 'stok_status' => 'pre_order', 'urutan' => 1],
        ];

        foreach ($items as $item) {
            ProdukVariant::create($item);
        }
    }
}
