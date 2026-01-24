<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function edit()
    {
        $privacyPolicy = PrivacyPolicy::firstOrFail();
        return view('admin.privacy-policy.edit', compact('privacyPolicy'));
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

        $privacyPolicy = PrivacyPolicy::firstOrFail();
        $data = [
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($privacyPolicy->image_path && \Illuminate\Support\Facades\Storage::exists('public/' . $privacyPolicy->image_path)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $privacyPolicy->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('legal-pages', 'public');
        }

        $privacyPolicy->update($data);

        return back()->with('success', 'Privacy Policy updated successfully.');
    }
}
