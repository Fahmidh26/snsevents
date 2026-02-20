<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reschedule_requests', function (Blueprint $table) {
            $table->id();
            $table->enum('booking_type', ['counseling', 'management']);
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('requested_slot_id');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->timestamps();

            $table->index(['booking_type', 'booking_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reschedule_requests');
    }
};
