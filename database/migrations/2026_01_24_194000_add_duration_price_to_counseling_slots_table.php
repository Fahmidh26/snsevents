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
        Schema::table('counseling_slots', function (Blueprint $table) {
            $table->integer('duration')->default(60)->after('end_time'); // Duration in minutes
            $table->decimal('price', 10, 2)->nullable()->after('duration'); // Price for this slot
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('counseling_slots', function (Blueprint $table) {
            $table->dropColumn(['duration', 'price']);
        });
    }
};
