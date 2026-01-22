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
}
