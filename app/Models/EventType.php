<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'featured_image',
        'status',
        'display_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'show_on_home'
    ];

    protected $casts = [
        'status' => 'boolean',
        'show_on_home' => 'boolean',
    ];

    public function galleries()
    {
        return $this->hasMany(EventGallery::class);
    }

    public function pricingTiers()
    {
        return $this->hasMany(PricingTier::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(EventGallery::class)->where('is_featured', true);
    }

    public function packageInquiries()
    {
        return $this->hasManyThrough(
            PackageInquiry::class,
            PricingTier::class,
            'event_type_id', // Foreign key on pricing_tiers table
            'pricing_tier_id', // Foreign key on package_inquiries table
            'id', // Local key on event_types table
            'id' // Local key on pricing_tiers table
        );
    }

}
