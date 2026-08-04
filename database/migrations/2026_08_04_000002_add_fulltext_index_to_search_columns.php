<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        Schema::table('produk', function (Blueprint $table) {
            $table->fullText(['nama', 'deskripsi'], 'idx_fulltext_produk');
        });

        Schema::table('artikel', function (Blueprint $table) {
            $table->fullText(['judul', 'konten'], 'idx_fulltext_artikel');
        });
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        Schema::table('produk', function (Blueprint $table) {
            $table->dropIndex('idx_fulltext_produk');
        });

        Schema::table('artikel', function (Blueprint $table) {
            $table->dropIndex('idx_fulltext_artikel');
        });
    }
};
