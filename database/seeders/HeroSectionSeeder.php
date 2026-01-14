<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'heading' => 'Creating Unforgettable Moments',
                'subheading' => 'Where Dreams Meet Reality',
                'button_text' => 'Plan Your Event',
                'background_image_path' => 'https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'sort_order' => 0,
                'is_active' => true,
            ],
            [
                'heading' => 'Exquisite Weddings',
                'subheading' => 'Tailored to Your Love Story',
                'button_text' => 'View Gallery',
                'background_image_path' => 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'heading' => 'Corporate Events Redefined',
                'subheading' => 'Professionalism Meets Innovation',
                'button_text' => 'Get a Quote',
                'background_image_path' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSection::create($slide);
        }
    }
}
