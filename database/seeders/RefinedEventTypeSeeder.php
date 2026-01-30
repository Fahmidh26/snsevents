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
        // 5 Main Categories from services.md + "Other" if needed
        $services = [
            // ==========================================
            // Event Planning & Management
            // ==========================================
            'Event Planning & Management' => [
                'Corporate and Conference' => 'Full-service planning for corporate meetings, conferences, galas, and brand activations.',
                'Conference Planning' => 'Specialized logistics, scheduling, and management for professional conferences.',
                'Corporate Events' => 'Tailored event solutions for company milestones, product launches, and team building.',
                'Anniversary Party Planning' => 'Expert planning to celebrate personal or business anniversaries with style.',
                'Anniversary Celebration' => 'Coordination of memorable anniversary events, handling all details from start to finish.',
                'Birthday Party Planning' => 'Creative planning for unforgettable birthday bashes for all ages.',
                'Baby Shower Planning' => 'Adorable and stress-free planning for welcoming the new bundle of joy.',
                'Bar & Bat Mitzvah Planning' => 'Traditional yet modern planning for this significant coming-of-age celebration.',
                'Children\'s Party Planning' => 'Fun-filled planning for kids parties with themes, entertainment, and safety in mind.',
                'Outdoor Event Planning' => 'Logistics and design for picnics, garden parties, and open-air festivals.',
                'Party Planning' => 'General party planning services for any occasion, ensuring smooth execution.',
                'Private Event Planning' => 'Discreet and exclusive planning for intimate private gatherings.',
                'Religious Event Planning' => 'Respectful coordination of religious ceremonies and community events.',
                'Religious Event' => 'Support for various religious functions, ensuring cultural and spiritual adherence.',
                'Retirement Party Planning' => 'Celebrating a lifetime of work with a memorable send-off event.',
                'School Event' => 'Planning for proms, homecomings, fundraisers, and other school functions.',
                'Graduation Parties' => 'Celebrating academic achievements with friends and family.',
                'Theme Parties' => 'Immersive event experiences centered around your chosen theme.',
                'Wedding and Engagement' => 'Comprehensive planning services for the journey from "Yes" to "I Do".',
                'Weddings' => 'Full-service wedding production, design, and day-of coordination.',
                'Catering' => 'Coordination with top-tier caterers to provide exquisite culinary experiences.',
                'Event Set Up and Teardown' => 'Professional crew to handle the heavy lifting before and after your event.',
                'Handyman' => 'On-site technical and general support for event installations and quick fixes.',
            ],

            // ==========================================
            // General Decoration & Design
            // ==========================================
            'General Decoration & Design' => [
                'Event Decor Design' => 'Conceptualizing and creating unique design blueprints for your event space.',
                'Event Decor Rental' => 'Rentals of vases, linens, centerpieces, and structure items.',
                'Decoration' => 'General decoration services to beautify any venue.',
                'Custom Event Design' => 'Bespoke design elements tailored specifically to your vision.',
                'Party Decoration' => 'Festive and fun decorations for standard parties.',
                'Home Decor' => 'Seasonal or event-specific styling for private residences.',
                'Table Decorations' => 'Exquisite tablescapes including centerpieces, runners, and place settings.',
                'Backdrop Setup' => 'Installation of photo-worthy backdrops for stages or photo booths.',
                'Floral Stage Backdrop' => 'Stunning backdrop walls created with fresh or high-quality silk flowers.',
                'Balloon Arch & Decor' => 'Organic balloon garlands, arches, and sculptures for a pop of fun.',
                'Marquee Letter' => 'Giant light-up letters to spell out names, numbers, or words.',
                'Party Equipment Rental' => 'Rentals of tables, chairs, tents, and other essential party gear.',
                'Event Stage Set Up' => 'Building and staging platforms for performances or head tables.',
                'Stage Decoration' => 'Draping, florals, and lighting to make the stage the focal point.',
            ],

            // ==========================================
            // Holiday & Seasonal Lighting
            // ==========================================
            'Holiday & Seasonal Lighting' => [
                'Christmas Light Installation' => 'Professional installation of holiday lights for homes and businesses.',
                'Outdoor Christmas Lights' => 'Weather-resistant lighting displays for lawns, trees, and exteriors.',
                'Holiday Decor Installation' => 'Complete setup of wreaths, garlands, and other holiday decor.',
                'Roofline Christmas Lighting' => 'Classic string lights outlining your roofline for a clean, festive look.',
                'Tree Wrapping Lights' => 'Spiraling lights around tree trunks and branches for a magical effect.',
                'Outdoor Holiday Lights' => 'Lighting solutions for holidays beyond just Christmas (Halloween, Diwali, etc.).',
                'Commercial Christmas Lighting' => 'Large-scale lighting displays for shopping centers and office buildings.',
            ],

            // ==========================================
            // Special Occasions & Celebrations
            // ==========================================
            'Special Occasions & Celebrations' => [
                'Birthday Decoration' => 'Themed decor setups for birthday parties of all scales.',
                'Baby Shower Decoration' => 'Cute and cozy decor themes for baby showers.',
                'Gender Reveal Decoration' => 'Exciting pink and blue setups for the big reveal.',
                'Bridal Shower Decoration' => 'Elegant and chic decor for the bride-to-be.',
                'Anniversary Decoration' => 'Romantic and timeless decor to celebrate lasting love.',
                'Graduation Decoration' => 'School-color themed decor to honor the graduate.',
                'Housewarming Party Decoration' => 'Warm and inviting decor for new home celebrations.',
                'Quinceañera Decoration' => 'Grand and colorful decor for this traditional 15th birthday celebration.',
                'Sweet 16 Decoration' => 'Trendy and fun decorations for a sweet sixteen bash.',
                'Cinco de Mayo' => 'Vibrant and festive decor for Cinco de Mayo celebrations.',
                'Las Posadas Decoration' => 'Traditional decor for Las Posadas gatherings.',
                'Baptisms Decoration' => 'Angelic and pure decor themes for baptism celebrations.',
            ],

            // ==========================================
            // Wedding & Engagement Specials
            // ==========================================
            'Wedding & Engagement Specials' => [
                'Wedding Decoration' => 'Comprehensive floral and design services for ceremonies and receptions.',
                'Engagement Decoration' => 'Intimate settings for engagement parties.',
                'Proposal Setup Decoration' => 'One-of-a-kind romantic setups to pop the question.',
                'Marry Me Setup Decoration' => 'Signature "Marry Me" letters and romantic ambiance creation.',
                'Wedding Stage Decoration' => 'Luxurious stage designs for the couple\'s seating area.',
            ],

            // ==========================================
            // Cultural & Religious Events
            // ==========================================
            'Cultural & Religious Events' => [
                'Islamic Wedding Decoration' => 'Modest and majestic decor suitable for Islamic wedding traditions.',
                'Nikkah Ceremony Decoration' => 'Elegant setups for the Nikkah contract signing ceremony.',
                'Nikkah Stage Decoration' => 'Focal point staging for the bride and groom during the Nikkah.',
                'Walima Reception Decoration' => 'Grand decor for the Walima post-wedding feast.',
                'Mehndi Decoration' => 'Colorful and vibrant decor for the Mehndi (henna) night.',
                'Sangeet Night Decoration' => 'Musical and festive decor for the Sangeet night celebrations.',
                'Haldi Ceremony' => 'Yellow-themed floral and fabric decor for the Haldi ceremony.',
                'Eid Decoration' => 'Festive decor for Eid al-Fitr and Eid al-Adha celebrations.',
                'Diwali Decoration' => 'Bright and illuminated decor for the Festival of Lights.',
                'Mosque Decoration' => 'Respectful and beautiful enhancement of mosque spaces for events.',
                'Church Decoration' => 'Floral and pew decor for church weddings and services.',
                'Cultural Parties' => 'Custom decoration services for any specific cultural celebration.',
            ],
        ];

        foreach ($services as $category => $items) {
            foreach ($items as $name => $description) {
                // Update or Create the Event Type
                $eventType = EventType::updateOrCreate(
                    ['name' => $name], // Check if exists by name
                    [
                        'slug' => Str::slug($name),
                        'category' => $category, // Assign the correct category
                        'description' => $description,
                        'category' => $category, // Assign the correct category
                        'description' => $description,
                        // We do not overwrite image if it exists, to keep user uploads safe
                        'featured_image' => 'uploads/events/' . $this->getImageForService($name, $category) . '.png',
                        'status' => true,
                    ]
                );

                // Add 3 Pricing Tiers for each Event Type (Basic, Premium, Platinum)
                $this->seedPricingTiers($eventType);
            }
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

    private function getImageForService($name, $category)
    {
        $slug = Str::slug($name);
        // Map specific services to available images
        $mapping = [
            // Event Planning
            'corporate-and-conference' => 'corporate_and_conference_1769774557603',
            'conference-planning' => 'conference_planning_1769774576174',
            'corporate-events' => 'corporate_events_1769774593506',
            'anniversary-party-planning' => 'anniversary_party_planning_1769774613566',
            'anniversary-celebration' => 'anniversary_celebration_1769774630984',
            'birthday-party-planning' => 'birthday_party_planning_1769774651518',
            'baby-shower-planning' => 'baby_shower_planning_1769774668784',
            'bar-bat-mitzvah-planning' => 'bar_bat_mitzvah_planning_1769774687976',
            'childrens-party-planning' => 'childrens_party_planning_1769774706172',
            'outdoor-event-planning' => 'outdoor_event_planning_1769774720689',
            'party-planning' => 'party_planning_1769774751612',
            'private-event-planning' => 'private_event_planning_1769774768208',
            'religious-event-planning' => 'religious_event_planning_1769774789302',
            'religious-event' => 'religious_event_1769774807532',
            'retirement-party-planning' => 'retirement_party_planning_1769774827513',
            'school-event' => 'school_event_1769774846057',
            'graduation-parties' => 'graduation_parties_1769774866832',
            'theme-parties' => 'party_planning_1769774751612', // Re-use Party Planning
            'wedding-and-engagement' => 'anniversary_celebration_1769774630984', // Re-use Anniversary Celebration
            'weddings' => 'anniversary_celebration_1769774630984', // Re-use Anniversary Celebration
            'catering' => 'private_event_planning_1769774768208', // Re-use Private Event (dining)
            'event-set-up-and-teardown' => 'conference_planning_1769774576174', // Re-use Conference Planning (logistics)
            'handyman' => 'conference_planning_1769774576174', // Re-use Conference Planning (logistics)

            // General Decoration & Design
            'event-decor-design' => 'anniversary_party_planning_1769774613566', // Re-use Anniversary Planning (mood board)
            'event-decor-rental' => 'outdoor_event_planning_1769774720689', // Re-use Outdoor Event (tents/rentals)
            'decoration' => 'private_event_planning_1769774768208',
            'custom-event-design' => 'anniversary_party_planning_1769774613566',
            'party-decoration' => 'childrens_party_planning_1769774706172',
            'home-decor' => 'private_event_planning_1769774768208',
            'table-decorations' => 'private_event_planning_1769774768208',
            'backdrop-setup' => 'childrens_party_planning_1769774706172', // Balloons
            'floral-stage-backdrop' => 'anniversary_celebration_1769774630984', // Flowers
            'balloon-arch-decor' => 'childrens_party_planning_1769774706172', // Balloons
            'marquee-letter' => 'birthday_party_planning_1769774651518',
            'party-equipment-rental' => 'outdoor_event_planning_1769774720689',
            'event-stage-set-up' => 'conference_planning_1769774576174',
            'stage-decoration' => 'corporate_events_1769774593506',
            
            // Holiday & Seasonal Lighting - Reuse Outdoor Event (tents/lights) or Corporate (lights)
            'christmas-light-installation' => 'outdoor_event_planning_1769774720689',
            'outdoor-christmas-lights' => 'outdoor_event_planning_1769774720689',
            'holiday-decor-installation' => 'outdoor_event_planning_1769774720689',
            'roofline-christmas-lighting' => 'outdoor_event_planning_1769774720689',
            'tree-wrapping-lights' => 'outdoor_event_planning_1769774720689',
            'outdoor-holiday-lights' => 'outdoor_event_planning_1769774720689',
            'commercial-christmas-lighting' => 'corporate_events_1769774593506',

            // Special Occasions & Celebrations
            'birthday-decoration' => 'childrens_party_planning_1769774706172',
            'baby-shower-decoration' => 'baby_shower_planning_1769774668784',
            'gender-reveal-decoration' => 'baby_shower_planning_1769774668784',
            'bridal-shower-decoration' => 'anniversary_celebration_1769774630984',
            'anniversary-decoration' => 'anniversary_celebration_1769774630984',
            'graduation-decoration' => 'graduation_parties_1769774866832',
            'housewarming-party-decoration' => 'private_event_planning_1769774768208',
            'quinceanera-decoration' => 'birthday_party_planning_1769774651518',
            'sweet-16-decoration' => 'birthday_party_planning_1769774651518',
            'cinco-de-mayo' => 'party_planning_1769774751612',
            'las-posadas-decoration' => 'religious_event_1769774807532',
            'baptisms-decoration' => 'religious_event_1769774807532',

            // Wedding & Engagement Specials
            'wedding-decoration' => 'anniversary_celebration_1769774630984',
            'engagement-decoration' => 'anniversary_celebration_1769774630984',
            'proposal-setup-decoration' => 'anniversary_celebration_1769774630984',
            'marry-me-setup-decoration' => 'anniversary_celebration_1769774630984',
            'wedding-stage-decoration' => 'anniversary_celebration_1769774630984',

            // Cultural & Religious Events
            'islamic-wedding-decoration' => 'religious_event_1769774807532',
            'nikkah-ceremony-decoration' => 'religious_event_1769774807532',
            'nikkah-stage-decoration' => 'religious_event_1769774807532',
            'walima-reception-decoration' => 'religious_event_1769774807532',
            'mehndi-decoration' => 'party_planning_1769774751612',
            'sangeet-night-decoration' => 'party_planning_1769774751612',
            'haldi-ceremony' => 'party_planning_1769774751612',
            'eid-decoration' => 'religious_event_1769774807532',
            'diwali-decoration' => 'religious_event_planning_1769774789302', // Candles
            'mosque-decoration' => 'religious_event_1769774807532',
            'church-decoration' => 'religious_event_planning_1769774789302',
            'cultural-parties' => 'religious_event_1769774807532',
        ];

        return $mapping[$slug] ?? 'party_planning_1769774751612'; // Default fallback
    }
}
