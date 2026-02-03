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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('primary_color')->default('#c9a227')->nullable();
            $table->string('secondary_color')->default('#0f0f0f')->nullable();
            $table->string('accent_color')->default('#d4af37')->nullable();
            $table->string('text_color')->default('#1a1a1a')->nullable();
            $table->string('background_color')->default('#ffffff')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'primary_color',
                'secondary_color',
                'accent_color',
                'text_color',
                'background_color',
            ]);
        });
    }
};
