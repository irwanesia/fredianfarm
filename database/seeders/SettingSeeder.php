<?php
namespace Database\Seeders;
use App\Models\Setting;
use Illuminate\Database\Seeder;
class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['key' => 'APP_NAME', 'value' => 'Fredian Farm'],
            ['key' => 'META_DESCRIPTION', 'value' => 'Produsen dan distributor bibit kentang G-0, G-0 MZ, Granola L, dan G-0 Plus dari Dieng, Jawa Tengah.'],
            ['key' => 'ALAMAT', 'value' => 'Jl. Raya Dieng No. 45, Dieng Kulon, Kabupaten Wonosobo, Jawa Tengah 56354'],
            ['key' => 'NOMOR_WA', 'value' => '0812-3456-7890'],
            ['key' => 'EMAIL', 'value' => 'halo@fredianfarm.co.id'],
            ['key' => 'FOOTER_TEXT', 'value' => '© ' . date('Y') . ' Fredian Farm. All rights reserved.'],
        ];
        foreach ($items as $item) {
            Setting::create($item);
        }
    }
}
