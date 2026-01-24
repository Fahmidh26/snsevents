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
        'favicon_path',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
    ];

    public static function current()
    {
        return self::firstOrCreate([], [
            'site_title' => 'SNS Events',
        ]);
    }
}
