<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagementSessionSettings extends Model
{
    protected $fillable = [
        'page_title',
        'page_subtitle',
        'card_name',
        'card_category',
        'card_description',
        'intro_text',
        'intro_title',
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
        'price' => 'decimal:2',
        'session_duration' => 'integer',
    ];

    public static function getSettings()
    {
        return self::firstOrCreate([], [
            'page_title' => 'Management Consultation',
            'page_subtitle' => 'Book a session with our management team',
            'session_duration' => 60,
            'is_active' => true,
        ]);
    }
}
