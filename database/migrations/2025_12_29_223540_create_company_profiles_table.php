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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path')->nullable();
            $table->string('ceo_name')->nullable();
            $table->text('ceo_bio')->nullable();
            $table->text('ceo_background')->nullable();
            $table->text('ceo_why_business')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('team_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
