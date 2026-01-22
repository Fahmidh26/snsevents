<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPackageRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'event_type',
        'event_date',
        'guest_count',
        'venue',
        'budget',
        'requirements',
        'status'
    ];

    protected $casts = [
        'event_date' => 'date',
        'budget' => 'decimal:2',
    ];
}
