<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banner', function (Blueprint $table) {
            $table->string('link_text')->nullable()->after('link_url');
            $table->string('link_url_2')->nullable()->after('link_text');
            $table->string('link_text_2')->nullable()->after('link_url_2');
        });
    }

    public function down(): void
    {
        Schema::table('banner', function (Blueprint $table) {
            $table->dropColumn(['link_text', 'link_url_2', 'link_text_2']);
        });
    }
};
