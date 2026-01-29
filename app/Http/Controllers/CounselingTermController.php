<?php

namespace App\Http\Controllers;

use App\Models\CounselingTerm;
use Illuminate\Http\Request;

class CounselingTermController extends Controller
{
    public function index()
    {
        $terms = CounselingTerm::firstOrFail();
        
        // SEO
        $seo = new \stdClass();
        $seo->title = $terms->meta_title ?? 'Counseling Terms and Conditions';
        $seo->meta_description = $terms->meta_description ?? 'Terms and conditions for counseling sessions.';
        $seo->meta_keywords = $terms->meta_keywords;
        $seo->og_image = $terms->image_path ? asset('storage/' . $terms->image_path) : null;

        return view('counseling-terms', compact('terms', 'seo'));
    }
}
