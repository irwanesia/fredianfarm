<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('link_tiktok')->nullable()->after('sertifikat');
            $table->string('link_shopee')->nullable()->after('link_tiktok');
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn(['link_tiktok', 'link_shopee']);
        });
    }
};
