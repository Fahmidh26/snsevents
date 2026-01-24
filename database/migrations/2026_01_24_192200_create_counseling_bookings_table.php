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
        Schema::create('counseling_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')->constrained('counseling_slots')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->string('confirmation_code')->unique();
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
        Schema::dropIfExists('counseling_bookings');
    }
};
