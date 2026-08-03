<?php
namespace Database\Seeders;
use App\Models\Banner;
use Illuminate\Database\Seeder;
class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['judul' => 'Promo Bibit G-0 Musim Tanam Agustus', 'deskripsi' => 'Dapatkan diskon khusus untuk pemesanan awal', 'urutan' => 1, 'link_url' => '#', 'is_active' => true],
            ['judul' => 'Kunjungi Kebun Kami di Dieng', 'deskripsi' => 'Lihat langsung proses produksi bibit kentang', 'urutan' => 2, 'link_url' => '#', 'is_active' => true],
            ['judul' => 'Ikuti TikTok @fredianfarm', 'deskripsi' => 'Konten edukatif seputar budidaya kentang', 'urutan' => 3, 'link_url' => 'https://tiktok.com/@fredianfarm', 'is_active' => false],
        ];
        foreach ($items as $item) {
            Banner::create($item);
        }
    }
}
