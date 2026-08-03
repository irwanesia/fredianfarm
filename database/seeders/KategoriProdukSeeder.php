<?php
namespace Database\Seeders;
use App\Models\KategoriProduk;
use Illuminate\Database\Seeder;
class KategoriProdukSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama' => 'Bibit Sumber · Kultur Jaringan', 'deskripsi' => 'Bibit generasi awal G-0 dan turunannya', 'urutan' => 1, 'is_active' => true],
            ['nama' => 'Bibit Sebar · Konsumsi', 'deskripsi' => 'Bibit siap tanam untuk petani', 'urutan' => 2, 'is_active' => true],
        ];
        foreach ($items as $item) {
            KategoriProduk::create($item);
        }
    }
}
