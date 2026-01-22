<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoDetail;
use Illuminate\Http\Request;

class SeoDetailController extends Controller
{
    public function index()
    {
        $seoDetails = SeoDetail::all();
        return view('admin.seo.index', compact('seoDetails'));
    }

    public function edit($id)
    {
        $seoDetail = SeoDetail::findOrFail($id);
        return view('admin.seo.edit', compact('seoDetail'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $seoDetail = SeoDetail::findOrFail($id);
        $seoDetail->update($validated);

        return back()->with('success', 'SEO details updated successfully.');
    }
}
