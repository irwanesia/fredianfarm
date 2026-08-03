<?php
namespace Database\Seeders;
use App\Models\Testimoni;
use Illuminate\Database\Seeder;
class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama' => 'Pak Suryana', 'daerah' => 'Ketua Gapoktan, Garut', 'review' => 'Bibit dari Fredian Farm hasilnya seragam, panen kami jadi lebih mudah dihitung.', 'rating' => 5, 'is_active' => true],
            ['nama' => 'Ibu Wulandari', 'daerah' => 'Distributor, Purworejo', 'review' => 'Pengiriman selalu tepat waktu meski jarak cukup jauh dari Dieng.', 'rating' => 5, 'is_active' => true],
            ['nama' => 'Pak Ridwan', 'daerah' => 'Petani Mandiri, Dieng', 'review' => 'Admin sangat membantu memilihkan kelas bibit yang cocok untuk lahan saya.', 'rating' => 4, 'is_active' => true],
        ];
        foreach ($items as $item) {
            Testimoni::create($item);
        }
    }
}
