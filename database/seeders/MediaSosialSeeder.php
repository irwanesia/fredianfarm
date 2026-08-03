<?php
namespace Database\Seeders;

use App\Models\MediaSosial;
use Illuminate\Database\Seeder;

class MediaSosialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['platform' => 'TikTok', 'url' => 'https://www.tiktok.com/@fredianfarm', 'icon' => 'fab fa-tiktok', 'urutan' => 1, 'is_active' => true],
            ['platform' => 'Instagram', 'url' => 'https://www.instagram.com/fredianfarm', 'icon' => 'fab fa-instagram', 'urutan' => 2, 'is_active' => true],
            ['platform' => 'WhatsApp', 'url' => 'https://wa.me/6281234567890', 'icon' => 'fab fa-whatsapp', 'urutan' => 3, 'is_active' => true],
            ['platform' => 'YouTube', 'url' => 'https://www.youtube.com/@fredianfarm', 'icon' => 'fab fa-youtube', 'urutan' => 4, 'is_active' => true],
            ['platform' => 'Facebook', 'url' => 'https://www.facebook.com/fredianfarm', 'icon' => 'fab fa-facebook-f', 'urutan' => 5, 'is_active' => true],
        ];
        foreach ($items as $item) {
            MediaSosial::updateOrCreate(['platform' => $item['platform']], $item);
        }
    }
}
