<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->cascadeOnDelete();
            $table->string('nama');
            $table->decimal('harga', 12, 2);
            $table->string('berat')->nullable();
            $table->enum('stok_status', ['tersedia', 'terbatas', 'pre_order'])->default('tersedia');
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_variants');
    }
};
