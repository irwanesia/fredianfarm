<?php
namespace Database\Seeders;
use App\Models\KategoriArtikel;
use Illuminate\Database\Seeder;
class KategoriArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama' => 'Budidaya', 'deskripsi' => 'Teknik dan tips budidaya kentang', 'urutan' => 1, 'is_active' => true],
            ['nama' => 'Bibit', 'deskripsi' => 'Seputar pemilihan & penyimpanan bibit', 'urutan' => 2, 'is_active' => true],
            ['nama' => 'Pemupukan', 'deskripsi' => 'Jadwal dan dosis pemupukan', 'urutan' => 3, 'is_active' => true],
            ['nama' => 'Penyakit', 'deskripsi' => 'Hama dan penyakit tanaman kentang', 'urutan' => 4, 'is_active' => true],
            ['nama' => 'Panen', 'deskripsi' => 'Waktu dan teknik panen ideal', 'urutan' => 5, 'is_active' => true],
        ];
        foreach ($items as $item) {
            KategoriArtikel::create($item);
        }
    }
}
