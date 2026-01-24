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
            $table->string('hero_image')->nullable();
            $table->string('intro_image')->nullable();
            $table->string('booking_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('counseling_settings', function (Blueprint $table) {
            $table->dropColumn(['hero_image', 'intro_image', 'booking_image']);
        });
    }
};
