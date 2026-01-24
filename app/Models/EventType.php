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
        'description',
        'featured_image',
        'status',
        'display_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image'
    ];

    protected $casts = [
        'status' => 'boolean',
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
}
