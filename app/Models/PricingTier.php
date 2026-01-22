<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type_id',
        'tier_name',
        'description',
        'price',
        'features',
        'image',
        'status',
        'display_order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'features' => 'array',
        'price' => 'decimal:2',
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function inquiries()
    {
        return $this->hasMany(PackageInquiry::class);
    }
}
