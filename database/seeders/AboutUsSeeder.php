<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'title' => 'About Us',
            'subtitle' => 'Crafting Perfect Celebrations Since 2010 — Based in Texas',
            'main_heading' => 'Your Vision, Our Expertise',
            'description' => "At SNS Events, based in Texas, we believe every celebration is unique and deserves to be treated as such. With over a decade of experience in creating magical moments, we've mastered the art of turning dreams into reality.\n\nOur team of dedicated professionals works tirelessly to ensure every detail is perfect, from the initial concept to the final execution. We pride ourselves on our creativity, attention to detail, and unwavering commitment to excellence.",
            'events_count' => '500+',
            'events_label' => 'Events Planned',
            'clients_count' => '450+',
            'clients_label' => 'Happy Clients',
            'experience_years' => '10+',
            'experience_label' => 'Years Experience',
        ]);
    }
}
