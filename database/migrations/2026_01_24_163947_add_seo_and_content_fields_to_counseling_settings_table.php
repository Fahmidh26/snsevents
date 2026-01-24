<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('counseling_settings', function (Blueprint $table) {
            $table->string('intro_title')->nullable()->after('intro_text');
            $table->string('seo_title')->nullable()->after('booking_image');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->text('seo_keywords')->nullable()->after('seo_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('counseling_settings', function (Blueprint $table) {
            $table->dropColumn(['intro_title', 'seo_title', 'seo_description', 'seo_keywords']);
        });
    }
};
