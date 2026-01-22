<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceArea;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ServiceAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data to avoid duplicates when re-seeding
        DB::table('service_areas')->truncate();

        $areas = [
            // List from image
            'Weatherford',
            'Hurst',
            'Keller',
            'North Richland Hills',
            'White Settlement',
            'Frisco',
            'Richardson',
            'Burleson',
            'Grand Prairie',
            'Grapevine',
            'Mansfield',
            'Euless',
            'McKinney',
            'Farmers Branch',
            'Irving',
            'Dallas',
            'Fort Worth',
            'Bedford',
            'Arlington',
            'Plano', // Added as a major nearby hub often included
        ];
        
        // Remove any accidental duplicates just in case
        $areas = array_unique($areas);

        foreach ($areas as $index => $cityName) {
            ServiceArea::create([
                'name' => $cityName,
                'slug' => Str::slug($cityName),
                'city' => $cityName,
                'state' => 'Texas',
                'zip_code' => '', 
                'description' => "Professional event decoration and planning services in {$cityName}, Texas. We bring your vision to life with our premium decor solutions.",
                'map_url' => "https://www.google.com/maps/place/{$cityName},+TX",
                'is_active' => true,
                'display_order' => $index + 1,
            ]);
        }
    }
}
