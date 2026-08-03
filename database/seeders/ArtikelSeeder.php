<?php
namespace Database\Seeders;
use App\Models\Artikel;
use Illuminate\Database\Seeder;
class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['kategori_id' => 1, 'user_id' => 1, 'judul' => '5 Kesalahan Umum saat Menanam Bibit Kentang', 'excerpt' => 'Kesalahan umum yang sering dilakukan petani kentang', 'konten' => '<p>Artikel tentang kesalahan menanam kentang...</p>', 'is_published' => true, 'published_at' => '2026-07-12', 'ai_generated' => false],
            ['kategori_id' => 2, 'user_id' => 1, 'judul' => 'Cara Memilih Bibit Kentang Bersertifikat', 'excerpt' => 'Panduan memilih bibit kentang yang baik', 'konten' => '<p>Panduan memilih bibit...</p>', 'is_published' => true, 'published_at' => '2026-07-08', 'ai_generated' => false],
            ['kategori_id' => 3, 'user_id' => 1, 'judul' => 'Jadwal Pemupukan Kentang dari Tanam hingga Panen', 'excerpt' => 'Jadwal pemupukan yang tepat', 'konten' => '<p>Jadwal pemupukan...</p>', 'is_published' => true, 'published_at' => '2026-07-02', 'ai_generated' => false],
            ['kategori_id' => 4, 'user_id' => 1, 'judul' => 'Mengenali Gejala Awal Penyakit Busuk Daun', 'excerpt' => 'Gejala awal penyakit busuk daun', 'konten' => '<p>Gejala busuk daun...</p>', 'is_published' => false, 'published_at' => null, 'ai_generated' => false],
            ['kategori_id' => 5, 'user_id' => 1, 'judul' => 'Tanda-Tanda Kentang Siap Dipanen', 'excerpt' => 'Ciri-ciri kentang siap panen', 'konten' => '<p>Tanda-tanda panen...</p>', 'is_published' => true, 'published_at' => '2026-06-20', 'ai_generated' => false],
            ['kategori_id' => 2, 'user_id' => 1, 'judul' => 'Penyimpanan Bibit Kentang Sebelum Tanam', 'excerpt' => 'Cara menyimpan bibit kentang', 'konten' => '<p>Cara menyimpan bibit...</p>', 'is_published' => false, 'published_at' => null, 'ai_generated' => false],
        ];
        foreach ($items as $item) {
            Artikel::create($item);
        }
    }
}
