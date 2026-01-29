<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounselingTerm extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'image_path', 'meta_title', 'meta_description', 'meta_keywords'];
}
