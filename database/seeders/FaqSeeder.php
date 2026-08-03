<?php
namespace Database\Seeders;
use App\Models\Faq;
use Illuminate\Database\Seeder;
class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['pertanyaan' => 'Apakah Fredian Farm melayani pengiriman ke luar Jawa?', 'jawaban' => 'Ya, kami melayani pengiriman ke Sumatra dan Sulawesi dengan kemasan khusus bibit.', 'urutan' => 1, 'is_active' => true],
            ['pertanyaan' => 'Apakah tersedia sistem keranjang belanja online?', 'jawaban' => 'Belum. Pemesanan dilakukan via inquiry WhatsApp atau TikTok Shop.', 'urutan' => 2, 'is_active' => true],
            ['pertanyaan' => 'Bagaimana cara mengajukan penawaran partai besar?', 'jawaban' => 'Isi form RFQ di halaman Kontak atau hubungi admin langsung.', 'urutan' => 3, 'is_active' => true],
        ];
        foreach ($items as $item) {
            Faq::create($item);
        }
    }
}
