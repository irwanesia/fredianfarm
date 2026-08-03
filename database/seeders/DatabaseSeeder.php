<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Fredian',
            'email' => 'admin@fredianfarm.co.id',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            KategoriProdukSeeder::class,
            ProdukSeeder::class,
            ProdukVariantSeeder::class,
            KategoriArtikelSeeder::class,
            ArtikelSeeder::class,
            TestimoniSeeder::class,
            FaqSeeder::class,
            BannerSeeder::class,
            KontakSeeder::class,
            SettingSeeder::class,
            MediaSosialSeeder::class,
        ]);
    }
}
