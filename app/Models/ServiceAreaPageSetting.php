<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAreaPageSetting extends Model
{
    protected $fillable = [
        'hero_image_path',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'heading',
        'subheading',
    ];
}
