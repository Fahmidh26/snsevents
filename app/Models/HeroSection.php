<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'subheading',
        'button_text',
        'background_image_path',
        'background_video_path',
        'sort_order',
        'is_active',
    ];
}
