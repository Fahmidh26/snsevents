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
        Schema::create('service_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Dallas"
            $table->string('slug')->unique();
            $table->string('city')->nullable();
            $table->string('state')->default('Texas');
            $table->string('zip_code')->nullable();
            $table->text('description')->nullable();
            $table->string('map_url')->nullable(); // Google Maps embed or link
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_areas');
    }
};
