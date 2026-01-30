<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UpdateCulturalEventsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category: Cultural & Religious Events
        // Mapping of existing Event Type Names to NEW image filenames
        $imageMapping = [
            'Islamic Wedding Decoration' => 'islamic_wedding_decoration_1769796941445.png',
            'Nikkah Ceremony Decoration' => 'nikkah_ceremony_decoration_1769796957272.png',
            'Nikkah Stage Decoration' => 'nikkah_stage_decoration_1769796971780.png',
            'Walima Reception Decoration' => 'walima_reception_decoration_1769796988736.png',
            'Mehndi Decoration' => 'mehndi_decoration_1769797012960.png',
            'Sangeet Night Decoration' => 'sangeet_night_decoration_1769797027969.png',
            'Haldi Ceremony' => 'haldi_ceremony_1769797043412.png',
            'Eid Decoration' => 'eid_decoration_1769797070053.png',
            'Diwali Decoration' => 'diwali_decoration_1769797085167.png',
            'Mosque Decoration' => 'mosque_decoration_1769797101150.png',
            'Church Decoration' => 'church_decoration_1769797115076.png',
            'Cultural Parties' => 'cultural_parties_1769797131630.png',
        ];

        foreach ($imageMapping as $name => $filename) {
            $eventType = EventType::where('name', $name)->first();

            if ($eventType) {
                $eventType->featured_image = 'uploads/events/' . $filename;
                $eventType->save();
                $this->command->info("Updated image for: $name");
            } else {
                $this->command->warn("Event Type not found: $name");
            }
        }
    }
}
