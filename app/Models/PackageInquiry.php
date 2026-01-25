<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_tier_id',
        'name',
        'email',
        'phone',
        'event_date',
        'message',
        'status'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function pricingTier()
    {
        return $this->belongsTo(PricingTier::class);
    }

    public function eventType()
    {
        return $this->hasOneThrough(
            EventType::class,
            PricingTier::class,
            'id', // Foreign key on pricing_tiers table
            'id', // Foreign key on event_types table
            'pricing_tier_id', // Local key on package_inquiries table
            'event_type_id' // Local key on pricing_tiers table
        );
    }

}
