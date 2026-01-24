<?php

namespace Database\Seeders;

use App\Models\TermsAndCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsAndConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (TermsAndCondition::count() === 0) {
            TermsAndCondition::create([
                'content' => '<h2>Terms and Conditions</h2><p>This is the default terms and conditions content. Please update this from the admin panel.</p>',
            ]);
        }
    }
}
