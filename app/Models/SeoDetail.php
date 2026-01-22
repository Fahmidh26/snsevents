<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_identifier',
        'title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'json_ld_schema',
        'is_active',
    ];

    /**
     * Get SEO details for a specific page
     */
    public static function getByPage($pageIdentifier)
    {
        return self::where('page_identifier', $pageIdentifier)
            ->where('is_active', true)
            ->first();
    }
}
