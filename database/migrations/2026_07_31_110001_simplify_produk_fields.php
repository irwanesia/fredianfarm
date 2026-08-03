<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('jenis_wadah')->nullable()->after('deskripsi');
            $table->string('umur_simpan')->nullable()->after('jenis_wadah');

            $table->dropColumn([
                'spesifikasi',
                'musim_tanam',
                'ketinggian_lahan',
                'usia_panen',
                'hasil_panen',
                'cara_penyimpanan',
                'keunggulan',
                'sertifikat',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->json('spesifikasi')->nullable();
            $table->string('musim_tanam')->nullable();
            $table->string('ketinggian_lahan')->nullable();
            $table->string('usia_panen')->nullable();
            $table->string('hasil_panen')->nullable();
            $table->text('cara_penyimpanan')->nullable();
            $table->text('keunggulan')->nullable();
            $table->string('sertifikat')->nullable();

            $table->dropColumn(['jenis_wadah', 'umur_simpan']);
        });
    }
};
