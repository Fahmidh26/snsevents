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
        // Settings Table
        Schema::create('management_session_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->default('Management Consultation');
            $table->string('page_subtitle')->nullable();
            $table->text('intro_text')->nullable();
            $table->string('intro_title')->nullable();
            $table->integer('session_duration')->default(60); // in minutes
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_label')->default('per session');
            $table->boolean('is_active')->default(true);
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            
            // Images
            $table->string('hero_image')->nullable();
            $table->string('intro_image')->nullable();
            $table->string('booking_image')->nullable();
            
            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            
            $table->timestamps();
        });

        // Slots Table
        Schema::create('management_session_slots', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration')->default(60); // Duration in minutes
            $table->decimal('price', 10, 2)->nullable(); // Price for this slot
            $table->boolean('is_available')->default(true);
            $table->boolean('is_booked')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Index for faster queries
            $table->index(['date', 'is_available', 'is_booked']);
        });

        // Bookings Table
        Schema::create('management_session_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')->constrained('management_session_slots')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->string('confirmation_code')->unique();
            $table->string('event_type')->nullable(); // Specific to management session
            $table->date('event_date')->nullable(); // Specific to management session
            $table->timestamps();
            
            // Index for faster lookups
            $table->index(['status', 'created_at']);
            $table->index('confirmation_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('management_session_bookings');
        Schema::dropIfExists('management_session_slots');
        Schema::dropIfExists('management_session_settings');
    }
};
