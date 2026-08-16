<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banner', function (Blueprint $table) {
            $table->enum('media_type', ['image', 'video'])->nullable()->after('url');
        });
    }

    public function down(): void
    {
        Schema::table('banner', function (Blueprint $table) {
            $table->dropColumn('media_type');
        });
    }
};
