<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function edit()
    {
        $aboutUs = AboutUs::first();
        if (!$aboutUs) {
            $aboutUs = new AboutUs(); // Return empty model instance to avoid null errors in view
        }
        return view('admin.about-us.edit', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aboutUs = AboutUs::first();
        if (!$aboutUs) {
            $aboutUs = new AboutUs();
        }

        $data = $request->except(['image_path', '_token']);

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($aboutUs->image_path) {
                Storage::delete('public/' . $aboutUs->image_path);
            }
            $path = $request->file('image_path')->store('about-us', 'public');
            $data['image_path'] = $path;
        }

        $aboutUs->fill($data);
        $aboutUs->save();

        return redirect()->route('about-us.edit')->with('success', 'About Us section updated successfully!');
    }
}
