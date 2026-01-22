<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Birthday Celebration',
                'slug' => 'birthday-celebration',
                'description' => 'Make your birthday unforgettable with our vibrant and creative decorations. From simple setups to grand ballroom transformations, we bring your vision to life.',
                'featured_image' => null,
                'status' => true,
                'display_order' => 1,
                'tiers' => [
                    ['tier_name' => 'Basic', 'price' => 299, 'description' => 'Simple and elegant setup for small gatherings.', 'features' => ['Backdrop decoration', 'Balloon arch', 'Table centerpieces']],
                    ['tier_name' => 'Standard', 'price' => 599, 'description' => 'Perfect for medium-sized parties with more flair.', 'features' => ['Themed backdrop', 'Entrance decor', 'Cake table setup', 'Lighting']],
                    ['tier_name' => 'Premium', 'price' => 999, 'description' => 'Full venue transformation with luxury elements.', 'features' => ['Custom 3D backdrop', 'Floral arrangements', 'Photo booth setup', 'Full venue lighting', 'Personalized items']]
                ]
            ],
            [
                'name' => 'Wedding Decoration',
                'slug' => 'wedding-decoration',
                'description' => 'Your dream wedding deserves the most exquisite setting. Our luxury wedding decor services combine timeless elegance with modern sophistication.',
                'featured_image' => null,
                'status' => true,
                'display_order' => 2,
                'tiers' => [
                    ['tier_name' => 'Essentials', 'price' => 1999, 'description' => 'Beautiful essentials for your special day.', 'features' => ['Stage decoration', 'Aisle runners', 'Simple centerpieces', 'Lighting']],
                    ['tier_name' => 'Elegance', 'price' => 3999, 'description' => 'A more detailed and sophisticated wedding theme.', 'features' => ['Themed stage', 'Floral aisle decor', 'Premium centerpieces', 'Entrance grand decor', 'Mood lighting']],
                    ['tier_name' => 'Royalty', 'price' => 7999, 'description' => 'The ultimate luxury experience for a grand wedding.', 'features' => ['Luxury stage setup', 'Fresh floral ceiling', 'Table linens & chairs', 'Full production lighting', 'Lounge area decor']]
                ]
            ],
            [
                'name' => 'Proposal Setup',
                'slug' => 'proposal-setup',
                'description' => 'Create a magical atmosphere for the moment they say "Yes". We specialize in romantic and intimate proposal setups at any location.',
                'featured_image' => null,
                'status' => true,
                'display_order' => 3,
                'tiers' => [
                    ['tier_name' => 'Classic', 'price' => 350, 'description' => 'Intimate and romantic setup.', 'features' => ['"Marry Me" lights', 'Rose petal path', 'Candlelit setup']],
                    ['tier_name' => 'Luxury', 'price' => 750, 'description' => 'A grander gesture of love.', 'features' => ['Heart-shaped arch', 'Fresh floral arrangement', 'Live musician setup', 'Premium lighting']],
                    ['tier_name' => 'Grand Finale', 'price' => 1200, 'description' => 'An unforgettable cinematic proposal.', 'features' => ['Full custom setup', 'Cold sparklers', 'Professional photography', 'Private dinner decor']]
                ]
            ]
        ];

        foreach ($events as $eventData) {
            $tiers = $eventData['tiers'];
            unset($eventData['tiers']);
            
            $eventType = \App\Models\EventType::create($eventData);
            
            foreach ($tiers as $tierData) {
                $tierData['event_type_id'] = $eventType->id;
                $tierData['status'] = true;
                \App\Models\PricingTier::create($tierData);
            }
        }

        // Default setting
        \App\Models\Setting::set('admin_email', 'admin@snsevents.com');
    }
}
