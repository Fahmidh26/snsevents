<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function edit()
    {
        $terms = TermsAndCondition::firstOrFail();
        return view('admin.terms-and-condition.edit', compact('terms'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $terms = TermsAndCondition::firstOrFail();
        $data = [
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($terms->image_path && \Illuminate\Support\Facades\Storage::exists('public/' . $terms->image_path)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $terms->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('legal-pages', 'public');
        }

        $terms->update($data);

        return back()->with('success', 'Terms & Conditions updated successfully.');
    }
}
