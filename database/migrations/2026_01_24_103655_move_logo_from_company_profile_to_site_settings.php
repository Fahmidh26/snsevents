<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('logo_path')->nullable()->after('site_title');
        });

        // Migrate data
        $companyProfile = DB::table('company_profiles')->first();
        if ($companyProfile && isset($companyProfile->logo_path)) {
            DB::table('site_settings')->updateOrInsert([], ['logo_path' => $companyProfile->logo_path]);
        }

        Schema::table('company_profiles', function (Blueprint $table) {
            $table->dropColumn('logo_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_profiles', function (Blueprint $table) {
            $table->string('logo_path')->nullable();
        });

        // Migrate data back
        $settings = DB::table('site_settings')->first();
        if ($settings && isset($settings->logo_path)) {
            DB::table('company_profiles')->updateOrInsert([], ['logo_path' => $settings->logo_path]);
        }

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('logo_path');
        });
    }
};
