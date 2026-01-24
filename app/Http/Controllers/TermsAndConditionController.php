<?php

namespace App\Http\Controllers;

use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        $terms = TermsAndCondition::firstOrFail();
        return view('terms-and-condition', compact('terms'));
    }
}
