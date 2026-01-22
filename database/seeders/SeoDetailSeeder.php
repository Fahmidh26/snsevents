<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SeoDetail::create([
            'page_identifier' => 'homepage',
            'title' => 'SNS Events - Premier Event Decoration Services in Texas',
            'meta_description' => 'Transform your events with SNS Events, Texas\' leading event decoration company. Specializing in weddings, corporate events, birthdays, and custom decor solutions across Dallas, Houston, Austin, and San Antonio.',
            'meta_keywords' => 'event decoration texas, wedding decorations texas, party decorations dallas, event planning houston, corporate event decor austin, birthday party decorations san antonio, event decorator texas, luxury event decor, custom event decorations, texas event services',
            'og_title' => 'SNS Events - Premier Event Decoration Services in Texas',
            'og_description' => 'Transform your events with SNS Events, Texas\' leading event decoration company. Specializing in weddings, corporate events, birthdays, and custom decor solutions.',
            'og_image' => null,
            'json_ld_schema' => null, // Will be generated dynamically
            'is_active' => true,
        ]);
    }
}
