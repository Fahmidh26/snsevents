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
        Schema::create('custom_package_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('event_type');
            $table->date('event_date')->nullable();
            $table->integer('guest_count')->nullable();
            $table->string('venue')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->text('requirements')->nullable();
            $table->enum('status', ['pending', 'contacted', 'quoted', 'converted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_package_requests');
    }
};
