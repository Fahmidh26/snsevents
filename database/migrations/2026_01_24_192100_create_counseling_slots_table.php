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
        Schema::create('counseling_slots', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_available')->default(true);
            $table->boolean('is_booked')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Index for faster queries
            $table->index(['date', 'is_available', 'is_booked']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_slots');
    }
};
