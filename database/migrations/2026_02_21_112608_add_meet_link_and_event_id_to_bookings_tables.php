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
        Schema::table('counseling_bookings', function (Blueprint $table) {
            $table->string('meet_link')->nullable()->after('confirmation_code');
            $table->string('google_event_id')->nullable()->after('meet_link');
        });

        Schema::table('management_session_bookings', function (Blueprint $table) {
            $table->string('meet_link')->nullable()->after('confirmation_code');
            $table->string('google_event_id')->nullable()->after('meet_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('counseling_bookings', function (Blueprint $table) {
            $table->dropColumn(['meet_link', 'google_event_id']);
        });

        Schema::table('management_session_bookings', function (Blueprint $table) {
            $table->dropColumn(['meet_link', 'google_event_id']);
        });
    }
};
