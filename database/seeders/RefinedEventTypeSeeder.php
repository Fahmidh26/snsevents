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
                'Graduation party' => [
                    'description' => 'Mark this major achievement with an epic graduation party. We handle the decor, layouts, and thematic concepts to honor the new graduate.',
                    'meta_title' => 'Graduation Party Planners & Decorators in Texas | SNS Events',
                    'meta_description' => "Honor your graduate's hard work with an incredible celebration. SNS Events offers premium graduation party planning and stylish decor packages.",
                    'meta_keywords' => 'graduation party planner, high school grad party decor, college graduation celebration, custom graduation themes',
                    'og_title' => 'Graduation Party Planners & Decorators in Texas | SNS Events',
                    'og_description' => "Honor your graduate's hard work with an incredible celebration. SNS Events offers premium graduation party planning and stylish decor packages.",
                    'show_on_home' => false,
                ],
                'Corporate events' => [
                    'description' => 'Elevate your brand with sophisticated corporate event planning. We organize seamless galas, holiday parties, conferences, and impressive brand activations.',
                    'meta_title' => 'Corporate Event Planners & Brand Activations in Texas | SNS Events',
                    'meta_description' => 'Professional corporate event planning by SNS Events. From company galas and holiday parties to conferences and professional brand activations.',
                    'meta_keywords' => 'corporate event planner, business conference decor, company holiday party, brand activation events, texas corporate events',
                    'og_title' => 'Corporate Event Planners & Brand Activations in Texas | SNS Events',
                    'og_description' => 'Professional corporate event planning by SNS Events. From company galas and holiday parties to conferences and professional brand activations.',
                    'show_on_home' => true,
                ],
            ],
            'Cultural & Religious' => [
                'Nikkah' => [
                    'description' => 'Embrace tradition and elegance with our specialized Nikkah decor and planning services. We create beautiful, modest, and spectacular wedding settings.',
                    'meta_title' => 'Elegant Nikkah Decorators & Muslim Wedding Planners | SNS Events',
                    'meta_description' => "Ensure a beautiful start to your marriage with SNS Events' premium Nikkah planning and decor services, specializing in elegant and traditional Muslim wedding setups.",
                    'meta_keywords' => 'Nikkah decor, Muslim wedding planner, Islamic wedding decorator, traditional marriage setup, elegant Nikkah stage texas',
                    'og_title' => 'Elegant Nikkah Decorators & Muslim Wedding Planners | SNS Events',
                    'og_description' => "Ensure a beautiful start to your marriage with SNS Events' premium Nikkah planning and decor services, specializing in elegant and traditional Muslim wedding setups.",
                    'show_on_home' => false,
                ],
                'Christmas/holiday decoration' => [
                    'description' => 'Transform your home or business with our professional holiday styling services. We provide exquisite tree decorating, seasonal installations, and magical festive touches.',
                    'meta_title' => 'Professional Christmas & Holiday Decorators | SNS Events',
                    'meta_description' => 'Transform your space this season! SNS Events provides professional Christmas and holiday decoration services for homes and businesses across Texas.',
                    'meta_keywords' => 'holiday decorator, professional christmas tree decorating, seasonal event styling, corporate holiday decor, festive home setups',
                    'og_title' => 'Professional Christmas & Holiday Decorators | SNS Events',
                    'og_description' => 'Transform your space this season! SNS Events provides professional Christmas and holiday decoration services for homes and businesses across Texas.',
                    'show_on_home' => true,
                ],
            ],
            'Weddings & Milestones' => [
                'Wedding & engagement' => [
                    'description' => 'Comprehensive, full-scale planning from "Yes" to "I Do". We bring your dream wedding to life with extraordinary bridal showers, engagements, and breathtaking wedding day decor.',
                    'meta_title' => 'Luxury Wedding & Engagement Planners in Texas | SNS Events',
                    'meta_description' => 'Your dream wedding, perfectly executed. Let SNS Events handle your engagement party, bridal shower, and luxury wedding planning with premium designs and decor.',
                    'meta_keywords' => 'luxury wedding planner, engagement party decorator, bridal shower setup, wedding decor texas, full service wedding coordinator',
                    'og_title' => 'Luxury Wedding & Engagement Planners in Texas | SNS Events',
                    'og_description' => 'Your dream wedding, perfectly executed. Let SNS Events handle your engagement party, bridal shower, and luxury wedding planning with premium designs and decor.',
                    'show_on_home' => true,
                ],
                'Baby shower' => [
                    'description' => 'Welcome your little one beautifully with our bespoke baby shower styling. We design breathtaking backdrops, sweet tables, and elegant decor for parents-to-be.',
                    'meta_title' => 'Baby Shower Decorators & Event Planners in Texas | SNS Events',
                    'meta_description' => 'Celebrate the arrival of your new baby with stunning decor by SNS Events. Specializing in elegant baby showers, gender reveals, and beautiful photo backdrops.',
                    'meta_keywords' => 'baby shower planner, gender reveal decorator, baby shower backdrops, elegant baby shower setups, baby shower themes texas',
                    'og_title' => 'Baby Shower Decorators & Event Planners in Texas | SNS Events',
                    'og_description' => 'Celebrate the arrival of your new baby with stunning decor by SNS Events. Specializing in elegant baby showers, gender reveals, and beautiful photo backdrops.',
                    'show_on_home' => true,
                ],
                'Anniversary' => [
                    'description' => 'Reconnect and celebrate your lasting love. From romantic anniversary dinners for two to grand vow renewal ceremonies, we design unforgettable milestones.',
                    'meta_title' => 'Anniversary Celebration & Vow Renewal Planners | SNS Events',
                    'meta_description' => 'Celebrate your love story with SNS Events. We design romantic anniversary parties, intimate dinners, and spectacular vow renewal ceremonies in Texas.',
                    'meta_keywords' => 'anniversary planner, vow renewal decorator, romantic dinner setup, anniversary party decor, texas anniversary venues',
                    'og_title' => 'Anniversary Celebration & Vow Renewal Planners | SNS Events',
                    'og_description' => 'Celebrate your love story with SNS Events. We design romantic anniversary parties, intimate dinners, and spectacular vow renewal ceremonies in Texas.',
                    'show_on_home' => true,
                ],
            ],
            'Parties & Social' => [
                'Proposal' => [
                    'description' => 'Expert proposal planning services to create the perfect setting for your "Yes!" moment. From intimate private dinners to elaborate surprise setups, we handle all the details.',
                    'meta_title' => 'Proposal Planners & Surprise Engagement Decorators in Texas | SNS Events',
                    'meta_description' => 'Ready to pop the question? Let SNS Events design the perfect marriage proposal with customized decor, romantic settings, and flawless execution.',
                    'meta_keywords' => 'proposal planner, romantic proposal setup, marriage proposal decorator, engagement surprise, pop the question decor texas',
                    'og_title' => 'Proposal Planners & Surprise Engagement Decorators in Texas | SNS Events',
                    'og_description' => 'Ready to pop the question? Let SNS Events design the perfect marriage proposal with customized decor, romantic settings, and flawless execution.',
                    'show_on_home' => false,
                ],
                'Birthday' => [
                    'description' => 'Celebrate in style with our customized birthday party planning. Whether it\'s a sweet 16, a milestone 50th, or a fun kids\' party, we bring your vision to life.',
                    'meta_title' => 'Birthday Party Planners & Decorators in Texas | SNS Events',
                    'meta_description' => 'Make your next birthday unforgettable with SNS Events. We provide custom party themes, beautiful balloon decor, and complete birthday planning services.',
                    'meta_keywords' => 'birthday party planner, birthday decorator texas, custom party themes, milestone birthday decor, sweet 16 planner',
                    'og_title' => 'Birthday Party Planners & Decorators in Texas | SNS Events',
                    'og_description' => 'Make your next birthday unforgettable with SNS Events. We provide custom party themes, beautiful balloon decor, and complete birthday planning services.',
                    'show_on_home' => true,
                ],
            ],
        ];

        $validNames = [];

        foreach ($services as $category => $items) {
            foreach ($items as $name => $data) {
                $validNames[] = $name;

                // Update or Create the Event Type
                $eventType = EventType::updateOrCreate(
                    ['name' => $name], // Check if exists by name
                    [
                        'slug' => Str::slug($name),
                        'category' => $category, // Assign the correct category
                        'description' => $data['description'],
                        'meta_title' => $data['meta_title'],
                        'meta_description' => $data['meta_description'],
                        'meta_keywords' => $data['meta_keywords'],
                        'og_title' => $data['og_title'],
                        'og_description' => $data['og_description'],
                        'show_on_home' => $data['show_on_home'],
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
