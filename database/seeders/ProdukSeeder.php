<?php
namespace Database\Seeders;
use App\Models\Produk;
use Illuminate\Database\Seeder;
class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'kategori_id' => 1, 'nama' => 'G-0',
                'deskripsi' => '<p>Benih kentang G-0 (Generasi ke-0) merupakan bibit paling murni yang dihasilkan dari kultur jaringan bebas virus dan patogen tanah. Setiap umbi terjamin seragam secara genetik dan bebas dari penyakit bawaan. Cocok untuk petani yang mengutamakan kualitas hasil panen premium.</p>',
                'jenis_wadah' => 'Kardus + Bubble wrap',
                'umur_simpan' => '3 bulan',
                'harga' => 250000, 'stok_status' => 'terbatas', 'berat' => 10,
                'is_active' => true,
            ],
            [
                'kategori_id' => 1, 'nama' => 'G-0 MZ',
                'deskripsi' => '<p>G-0 MZ (Mata Zonal) adalah hasil perbanyakan G-0 melalui teknik mata zonal (single node cutting). Setiap potongan mata tunas ditumbuhkan menjadi planlet sebelum diaklimatisasi, menghasilkan bibit dengan karakteristik identik dengan induknya. Solusi ekonomis untuk mendapatkan bibit G-0 dalam jumlah lebih banyak.</p>',
                'jenis_wadah' => 'Kardus + Bubble wrap',
                'umur_simpan' => '3 bulan',
                'harga' => 275000, 'stok_status' => 'tersedia', 'berat' => 10,
                'is_active' => true,
            ],
            [
                'kategori_id' => 2, 'nama' => 'Granola L',
                'deskripsi' => '<p>Granola L adalah bibit kentang G-1 (Generasi ke-1) yang telah mengalami satu kali perbanyakan dari G-0. Memiliki ukuran umbi lebih besar dan harga yang lebih terjangkau. Sangat cocok untuk petani skala menengah hingga besar yang menginginkan bibit siap sebar dengan performa terjamin.</p>',
                'jenis_wadah' => 'Karung',
                'umur_simpan' => '2 bulan',
                'harga' => 180000, 'stok_status' => 'tersedia', 'berat' => 25,
                'is_active' => true,
            ],
            [
                'kategori_id' => 1, 'nama' => 'G-0 Plus',
                'deskripsi' => '<p>G-0 Plus adalah generasi lanjutan dari G-0 yang telah melalui seleksi ketat untuk menghasilkan volume umbi lebih besar dan potensi hasil lebih tinggi. Diperuntukkan bagi petani yang menargetkan produktivitas maksimal dengan kualitas premium. Tersedia dalam jumlah terbatas setiap musim.</p>',
                'jenis_wadah' => 'Kardus + Bubble wrap',
                'umur_simpan' => '3 bulan',
                'harga' => 300000, 'stok_status' => 'pre_order', 'berat' => 10,
                'is_active' => true,
            ],
        ];
        foreach ($items as $item) {
            Produk::create($item);
        }
    }
}
