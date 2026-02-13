<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounselingSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'intro_text',
        'intro_title',
        'page_title',
        'page_subtitle',
        'card_name',
        'card_category',
        'card_description',
        'session_duration',
        'price',
        'price_label',
        'is_active',
        'show_on_homepage',
        'show_on_services_page',
        'contact_email',
        'contact_phone',
        'hero_image',
        'intro_image',
        'booking_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_homepage' => 'boolean',
        'show_on_services_page' => 'boolean',
        'session_duration' => 'integer',
        'price' => 'decimal:2',
    ];

    /**
     * Get the singleton instance of counseling settings
     */
    public static function getSettings()
    {
        $settings = self::first();
        
        if (!$settings) {
            $settings = self::create([
                'intro_text' => "Life gets tough, and there are moments when we find ourselves dealing with situations we never wanted to face. Unfortunately, events can unfold in ways that are beyond our control.\n\nWhether it's relationship problems, marriage struggles, infidelity, family issues, career confusion, emotional stress, anxiety, or simply feeling lost as a person, I understand that space.\n\nI'm here to listen, to understand where you're coming from, and to help you see things clearly when everything feels confusing.\n\nIn our one on one sessions, you'll have a private space to speak openly. I will listen to your specific situation, help you break it down, identify the core issues, and give you practical steps and direction so you can move forward with confidence.\n\nWhether you're trying to fix a relationship, decide whether to walk away, rebuild yourself after betrayal, regain control of your mindset, or step into your responsibilities, you don't have to figure it out alone.\nI'm here to guide you every step of the way.",
                'page_title' => 'Relationship Counseling',
                'page_subtitle' => 'One-on-One Personal Sessions',
                'session_duration' => 60,
                'is_active' => true,
            ]);
        }
        
        return $settings;
    }
}
