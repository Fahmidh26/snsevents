<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type_id',
        'image_path',
        'caption',
        'is_featured',
        'display_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }
}
