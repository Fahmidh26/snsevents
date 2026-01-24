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
        Schema::create('counseling_settings', function (Blueprint $table) {
            $table->id();
            $table->text('intro_text')->nullable();
            $table->string('page_title')->default('Relationship Counseling');
            $table->string('page_subtitle')->nullable();
            $table->integer('session_duration')->default(60); // in minutes
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_label')->default('per session');
            $table->boolean('is_active')->default(true);
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_settings');
    }
};
