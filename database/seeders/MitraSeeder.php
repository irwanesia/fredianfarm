<?php
namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama' => 'Dinas Pertanian Wonosobo', 'urutan' => 1, 'is_active' => true],
            ['nama' => 'Dinas Pertanian Banjarnegara', 'urutan' => 2, 'is_active' => true],
            ['nama' => 'Gapoktan Dieng', 'urutan' => 3, 'is_active' => true],
            ['nama' => 'Koperasi Tani Makmur', 'urutan' => 4, 'is_active' => true],
            ['nama' => 'UPTD Balai Benih Hortikultura', 'urutan' => 5, 'is_active' => true],
        ];
        foreach ($items as $item) {
            Mitra::updateOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
