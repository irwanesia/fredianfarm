<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_produk')->cascadeOnDelete();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->json('spesifikasi')->nullable();
            $table->decimal('harga', 12, 2)->nullable();
            $table->enum('stok_status', ['tersedia', 'terbatas', 'pre_order'])->default('tersedia');
            $table->string('berat')->nullable();
            $table->string('musim_tanam')->nullable();
            $table->string('ketinggian_lahan')->nullable();
            $table->string('usia_panen')->nullable();
            $table->string('hasil_panen')->nullable();
            $table->text('cara_penyimpanan')->nullable();
            $table->text('keunggulan')->nullable();
            $table->string('sertifikat')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
