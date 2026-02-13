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
        // Add fields to counseling_settings
        Schema::table('counseling_settings', function (Blueprint $table) {
            $table->string('card_name')->default('Coaching Session')->after('page_subtitle');
            $table->string('card_category')->default('Counseling')->after('card_name');
            $table->text('card_description')->nullable()->after('card_category');
            $table->boolean('show_on_homepage')->default(true)->after('is_active');
            $table->boolean('show_on_services_page')->default(true)->after('show_on_homepage');
        });

        // Add fields to management_session_settings
        Schema::table('management_session_settings', function (Blueprint $table) {
            $table->string('card_name')->default('Management Session')->after('page_subtitle');
            $table->string('card_category')->default('Counseling')->after('card_name');
            $table->text('card_description')->nullable()->after('card_category');
            $table->boolean('show_on_homepage')->default(true)->after('is_active');
            $table->boolean('show_on_services_page')->default(true)->after('show_on_homepage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('counseling_settings', function (Blueprint $table) {
            $table->dropColumn(['card_name', 'card_category', 'card_description', 'show_on_homepage', 'show_on_services_page']);
        });

        Schema::table('management_session_settings', function (Blueprint $table) {
            $table->dropColumn(['card_name', 'card_category', 'card_description', 'show_on_homepage', 'show_on_services_page']);
        });
    }
};
