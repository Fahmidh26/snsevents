<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (PrivacyPolicy::count() === 0) {
            PrivacyPolicy::create([
                'content' => '<h2>Privacy Policy</h2><p>This is the default privacy policy content. Please update this from the admin panel.</p>',
            ]);
        }
    }
}
