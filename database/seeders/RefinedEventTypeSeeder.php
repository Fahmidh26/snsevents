<?php

namespace Database\Seeders;

use App\Models\EventType;
use App\Models\PricingTier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RefinedEventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // The 9 specific services
        $services = [
            'Corporate & Public Events' => [
                'Graduation party' => 'Mark this major achievement with an epic graduation party. We handle the decor, layouts, and thematic concepts to honor the new graduate.',
                'Corporate events' => 'Elevate your brand with sophisticated corporate event planning. We organize seamless galas, holiday parties, conferences, and impressive brand activations.',
            ],
            'Cultural & Religious' => [
                'Nikkah' => 'Embrace tradition and elegance with our specialized Nikkah decor and planning services. We create beautiful, modest, and spectacular wedding settings.',
                'Christmas/holiday decoration' => 'Transform your home or business with our professional holiday styling services. We provide exquisite tree decorating, seasonal installations, and magical festive touches.',
            ],
            'Weddings & Milestones' => [
                'Wedding & engagement' => 'Comprehensive, full-scale planning from "Yes" to "I Do". We bring your dream wedding to life with extraordinary bridal showers, engagements, and breathtaking wedding day decor.',
                'Baby shower' => 'Welcome your little one beautifully with our bespoke baby shower styling. We design breathtaking backdrops, sweet tables, and elegant decor for parents-to-be.',
                'Anniversary' => 'Reconnect and celebrate your lasting love. From romantic anniversary dinners for two to grand vow renewal ceremonies, we design unforgettable milestones.',
            ],
            'Parties & Social' => [
                'Proposal' => 'Expert proposal planning services to create the perfect setting for your "Yes!" moment. From intimate private dinners to elaborate surprise setups, we handle all the details.',
                'Birthday' => 'Celebrate in style with our customized birthday party planning. Whether it\'s a sweet 16, a milestone 50th, or a fun kids\' party, we bring your vision to life.',
            ],
        ];

        $validNames = [];

        foreach ($services as $category => $items) {
            foreach ($items as $name => $description) {
                $validNames[] = $name;

                // Update or Create the Event Type
                $eventType = EventType::updateOrCreate(
                    ['name' => $name], // Check if exists by name
                    [
                        'slug' => Str::slug($name),
                        'category' => $category, // Assign the correct category
                        'description' => $description,
                        // We do not overwrite image if it exists, to keep user uploads safe
                        'featured_image' => 'uploads/events/' . $this->getImageForService($name) . '.png',
                        'status' => true,
                    ]
                );

                // Add 3 Pricing Tiers for each Event Type (Basic, Premium, Platinum)
                $this->seedPricingTiers($eventType);
            }
        }

        // Cleanup old services not in the new 9 list
        $oldEventTypes = EventType::whereNotIn('name', $validNames)->get();
        foreach ($oldEventTypes as $oldType) {
            // Delete associated pricing tiers first
            $oldType->pricingTiers()->delete();
            $oldType->delete();
        }
    }

    private function seedPricingTiers(EventType $eventType)
    {
        // Define standard tiers
        $tiers = [
            [
                'name' => 'Essential Package',
                'description' => 'Perfect for intimate gatherings and small setups.',
                'price' => 500.00,
                'features' => ['Consultation', 'Basic Setup', 'Standard Decor Items', '2 Hours on-site support'],
            ],
            [
                'name' => 'Premium Package',
                'description' => 'Our most popular choice for a complete experience.',
                'price' => 1200.00,
                'features' => ['Planning & Coordination', 'Premium Decor Upgrade', 'Lighting Package', 'Full Setup & Teardown', '4 Hours support'],
            ],
            [
                'name' => 'Luxury Experience',
                'description' => 'The ultimate package for a flawless, grand event.',
                'price' => 2500.00,
                'features' => ['Full-Service Planning', 'Luxury Floral Arrangements', 'Custom Backdrop Design', 'All-day Coordination', 'Premium Lighting & Sound'],
            ],
        ];

        foreach ($tiers as $index => $tier) {
            PricingTier::updateOrCreate(
                [
                    'event_type_id' => $eventType->id,
                    'tier_name' => $tier['name']
                ],
                [
                    'description' => $tier['description'],
                    'price' => $tier['price'],
                    'features' => $tier['features'], // Cast to JSON by model
                    'display_order' => $index + 1,
                    'status' => true,
                ]
            );
        }
    }

    private function getImageForService($name)
    {
        $slug = Str::slug($name);
        // Map specific services to available images
        $mapping = [
            'graduation-party' => 'school_event_1769774846057',
            'corporate-events' => 'corporate_and_conference_1769774557603',
            'nikkah' => 'religious_event_1769774807532',
            'wedding-engagement' => 'anniversary_celebration_1769774630984',
            'proposal' => 'private_event_planning_1769774768208',
            'birthday' => 'birthday_party_planning_1769774651518',
            'baby-shower' => 'baby_shower_planning_1769774668784',
            'anniversary' => 'anniversary_party_planning_1769774613566',
            'christmasholiday-decoration' => 'party_planning_1769774751612',
            // Sometimes it has a dash instead of no dash depending on sluggification logic
            'christmas-holiday-decoration' => 'party_planning_1769774751612',
        ];

        return $mapping[$slug] ?? 'party_planning_1769774751612'; // Default fallback
    }
}
