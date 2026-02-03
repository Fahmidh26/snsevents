<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'site_description',
        'admin_email',
        'footer_text',
        'footer_description',
        'logo_path',
        'favicon_path',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'primary_color',
        'secondary_color',
        'accent_color',
        'text_color',
        'background_color',
    ];

    public static function current()
    {
        return self::firstOrCreate([], [
            'site_title' => 'SNS Events',
        ]);
    }
}
