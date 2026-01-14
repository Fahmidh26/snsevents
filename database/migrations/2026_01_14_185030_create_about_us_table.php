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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->default('About Us');
            $table->string('subtitle')->nullable()->default('Crafting Perfect Celebrations Since 2010 — Based in Texas');
            $table->string('image_path')->nullable();
            $table->string('main_heading')->nullable()->default('Your Vision, Our Expertise');
            $table->text('description')->nullable(); // Full description handling multiple paragraphs
            
            // Stats
            $table->string('events_count')->nullable()->default('500+');
            $table->string('events_label')->nullable()->default('Events Planned');
            
            $table->string('clients_count')->nullable()->default('450+');
            $table->string('clients_label')->nullable()->default('Happy Clients');
            
            $table->string('experience_years')->nullable()->default('10+');
            $table->string('experience_label')->nullable()->default('Years Experience');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
