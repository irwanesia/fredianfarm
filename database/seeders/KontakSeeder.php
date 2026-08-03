<?php
namespace Database\Seeders;
use App\Models\Kontak;
use Illuminate\Database\Seeder;
class KontakSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama' => 'Budi Santoso', 'email' => 'budi@email.com', 'no_wa' => '0813-2222-1111', 'pesan' => 'Ingin tanya stok G-0 untuk 200kg.', 'dibaca' => false],
            ['nama' => 'Kelompok Tani Makmur', 'email' => 'ktm@email.com', 'no_wa' => '0821-3333-4444', 'pesan' => 'Butuh penawaran partai besar 1 ton.', 'dibaca' => false],
            ['nama' => 'Dinas Pertanian Wonosobo', 'email' => 'disperta@wonosobo.go.id', 'no_wa' => '0274-xxxxxx', 'pesan' => 'Permintaan kerja sama pengadaan bibit.', 'dibaca' => false],
            ['nama' => 'Toko Tani Sejahtera', 'email' => 'tokotani@email.com', 'no_wa' => '0815-5555-6666', 'pesan' => 'Tanya ketersediaan bulan depan.', 'dibaca' => true],
        ];
        foreach ($items as $item) {
            Kontak::create($item);
        }
    }
}
