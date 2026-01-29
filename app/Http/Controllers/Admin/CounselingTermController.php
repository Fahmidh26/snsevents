<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounselingTerm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CounselingTermController extends Controller
{
    public function edit()
    {
        $terms = CounselingTerm::firstOrCreate([], [
            'content' => '<h2>Counseling Terms and Conditions</h2><p>Please read these terms carefully before booking a session.</p>',
            'meta_title' => 'Counseling Terms',
            'meta_description' => 'Terms and conditions for counseling sessions.'
        ]);
        return view('admin.counseling-terms.edit', compact('terms'));
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

        $terms = CounselingTerm::first(); // We just ensured it exists in edit() // better use firstOrFail or Create
        if (!$terms) {
             $terms = CounselingTerm::create(['content' => 'Initial Content']);
        }
        
        $data = [
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($terms->image_path && Storage::exists('public/' . $terms->image_path)) {
                Storage::delete('public/' . $terms->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('legal-pages', 'public');
        }

        $terms->update($data);

        return back()->with('success', 'Counseling Terms & Conditions updated successfully.');
    }
}
