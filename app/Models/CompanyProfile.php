<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_path',
        'ceo_name',
        'ceo_bio',
        'ceo_background',
        'ceo_why_business',
        'mission',
        'vision',
        'team_description',
        'ceo_section_title',
        'ceo_section_subtitle',
        'ceo_image_path',
    ];
}
