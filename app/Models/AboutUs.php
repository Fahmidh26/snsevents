<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'main_heading',
        'description',
        'events_count',
        'events_label',
        'clients_count',
        'clients_label',
        'experience_years',
        'experience_label',
    ];
}
