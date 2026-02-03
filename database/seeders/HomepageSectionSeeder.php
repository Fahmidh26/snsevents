<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageSection;

class HomepageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            ['name' => 'hero', 'display_name' => 'Hero Section', 'order' => 1],
            ['name' => 'mission_vision', 'display_name' => 'Mission & Vision', 'order' => 2],
            ['name' => 'services', 'display_name' => 'Services', 'order' => 3],
            ['name' => 'about', 'display_name' => 'About Us', 'order' => 4],
            ['name' => 'gallery', 'display_name' => 'Gallery', 'order' => 5],
            ['name' => 'testimonials', 'display_name' => 'Testimonials', 'order' => 6],
            ['name' => 'faq', 'display_name' => 'FAQ', 'order' => 7],
            ['name' => 'service_areas', 'display_name' => 'Service Areas', 'order' => 8],
            ['name' => 'contact', 'display_name' => 'Contact Us', 'order' => 9],
        ];

        foreach ($sections as $section) {
            HomepageSection::updateOrCreate(
                ['name' => $section['name']],
                [
                    'display_name' => $section['display_name'],
                    'order' => $section['order'],
                    'is_visible' => true,
                ]
            );
        }
    }
}
