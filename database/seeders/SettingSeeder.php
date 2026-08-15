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
            ['key' => 'FOOTER_TEXT', 'value' => '© ' . date('Y') . ' Fredian Farm. Seluruh hak cipta dilindungi.'],
            ['key' => 'FOOTER_TAGLINE', 'value' => 'Produsen dan distributor bibit kentang bersertifikat sejak 2012 — Dieng, Jawa Tengah.'],
            ['key' => 'SEJARAH', 'value' => 'Fredian Farm berdiri sejak 2012 di dataran tinggi Dieng, Jawa Tengah. Bermula dari kebutuhan bibit unggul yang sulit didapat petani sekitar, pendiri mulai menyeleksi dan mengembangbiakkan bibit kentang varietas lokal dan impor dari satu petak kebun keluarga. Kini Fredian Farm memproduksi bibit kentang kultur jaringan dan turunannya, memasok lebih dari 800 mitra tani di Jawa, Sumatra, dan Sulawesi, serta didukung laboratorium kultur jaringan mini dengan proses produksi tersertifikasi.'],
            ['key' => 'VISI', 'value' => 'Menjadi penyedia bibit kentang tepercaya nomor satu di Indonesia yang mendukung ketahanan pangan hortikultura.'],
            ['key' => 'MISI', 'value' => "Menyediakan bibit kentang bersertifikat dengan grading konsisten.\nMendampingi petani mitra melalui edukasi budidaya berkelanjutan.\nMemperluas jangkauan distribusi ke seluruh sentra kentang Indonesia."],
            ['key' => 'NIB', 'value' => '0812xxxxxxxx'],
            ['key' => 'SERTIFIKAT', 'value' => 'Benih Bersertifikat BPSB'],
            ['key' => 'IZIN', 'value' => 'Izin Usaha Pertanian'],
            ['key' => 'ANGGOTA', 'value' => 'Asosiasi Benih Hortikultura'],
            ['key' => 'LOKASI_MAPS_EMBED', 'value' => 'https://www.google.com/maps?q=Dieng,Wonosobo,Jawa%20Tengah&output=embed'],
            ['key' => 'JAM_OPERASIONAL', 'value' => 'Senin–Sabtu, 08.00–16.00 WIB'],
        ];
        foreach ($items as $item) {
            Setting::updateOrCreate(['key' => $item['key']], ['value' => $item['value']]);
        }
    }
}
