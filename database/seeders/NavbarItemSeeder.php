<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavbarItem;

class NavbarItemSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing items
        NavbarItem::truncate();

        $items = [
            [
                'label' => 'Home',
                'type' => 'url',
                'url' => '/',
                'order' => 1,
            ],
            [
                'label' => 'About',
                'type' => 'route',
                'route_name' => 'about-us',
                'order' => 2,
            ],
            [
                'label' => 'Services',
                'type' => 'route',
                'route_name' => 'services.index',
                'order' => 3,
            ],
            [
                'label' => 'Custom Package',
                'type' => 'route',
                'route_name' => 'custom-package',
                'order' => 4,
            ],
            [
                'label' => 'Book a Coaching Session',
                'type' => 'route',
                'route_name' => 'counseling',
                'order' => 5,
            ],
            [
                'label' => 'Book a Session with Management',
                'type' => 'route',
                'route_name' => 'management-session',
                'order' => 6,
            ],
            [
                'label' => 'Explore',
                'type' => 'url', // Dropdown parent, url #
                'url' => '#',
                'order' => 7,
                'children' => [
                    [
                        'label' => 'Gallery',
                        'type' => 'url', // Section hash
                        'url' => '/#gallery',
                        'order' => 1,
                    ],
                    [
                        'label' => 'Testimonials',
                        'type' => 'url',
                        'url' => '/#testimonials',
                        'order' => 2,
                    ],
                    [
                        'label' => 'FAQ',
                        'type' => 'url',
                        'url' => '/#faq',
                        'order' => 3,
                    ],
                ]
            ],
            [
                'label' => 'Contact',
                'type' => 'url',
                'url' => '/#contact',
                'order' => 8,
            ],
        ];

        foreach ($items as $itemData) {
            $children = $itemData['children'] ?? [];
            unset($itemData['children']);

            $parent = NavbarItem::create($itemData);

            if (!empty($children)) {
                foreach ($children as $childData) {
                    $childData['parent_id'] = $parent->id;
                    NavbarItem::create($childData);
                }
            }
        }
    }
}
