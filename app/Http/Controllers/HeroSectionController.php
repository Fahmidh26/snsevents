<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $slides = HeroSection::orderBy('sort_order')->get();
        return view('admin.hero.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'background_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('background_image_path')) {
            $path = $request->file('background_image_path')->store('hero-slides', 'public');
            $data['background_image_path'] = $path;
        }

        HeroSection::create($data);

        return redirect()->route('hero.index')->with('success', 'Slide created successfully!');
    }

    public function edit(HeroSection $heroSection)
    {
        return view('admin.hero.edit', compact('heroSection'));
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $request->validate([
            'background_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('background_image_path')) {
            // Delete old image
            if ($heroSection->background_image_path) {
                Storage::delete('public/' . $heroSection->background_image_path);
            }
            $path = $request->file('background_image_path')->store('hero-slides', 'public');
            $data['background_image_path'] = $path;
        }

        $heroSection->update($data);

        return redirect()->route('hero.index')->with('success', 'Slide updated successfully!');
    }

    public function destroy(HeroSection $heroSection)
    {
        if ($heroSection->background_image_path) {
            Storage::delete('public/' . $heroSection->background_image_path);
        }
        $heroSection->delete();
        return redirect()->route('hero.index')->with('success', 'Slide deleted successfully!');
    }
}
