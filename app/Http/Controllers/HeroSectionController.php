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
            'background_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_video_path' => 'nullable|mimes:mp4,mov,ogg,qt,webm|max:100000', // 100MB max
            'background_video_url' => 'nullable|url',
            'heading' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('background_image_path')) {
            $path = $request->file('background_image_path')->store('hero-slides', 'public');
            $data['background_image_path'] = $path;
        }

        if ($request->hasFile('background_video_path')) {
            $path = $request->file('background_video_path')->store('hero-videos', 'public');
            $data['background_video_path'] = $path;
        } elseif ($request->filled('background_video_url')) {
            $data['background_video_path'] = $request->background_video_url;
        }

        HeroSection::create($data);

        return redirect()->route('hero.index')->with('success', 'Slide created successfully!');
    }

    public function edit(HeroSection $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, HeroSection $hero)
    {
        $request->validate([
            'background_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_video_path' => 'nullable|mimes:mp4,mov,ogg,qt,webm|max:100000', // 100MB max
            'background_video_url' => 'nullable|url',
            'heading' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->has('remove_background_image')) {
            if ($hero->background_image_path) {
                Storage::delete('public/' . $hero->background_image_path);
            }
            $data['background_image_path'] = null;
        }

        if ($request->hasFile('background_image_path')) {
            // Delete old image
            if ($hero->background_image_path) {
                Storage::delete('public/' . $hero->background_image_path);
            }
            $path = $request->file('background_image_path')->store('hero-slides', 'public');
            $data['background_image_path'] = $path;
        }

        if ($request->hasFile('background_video_path')) {
            // Delete old video if it was a file (not a URL)
            if ($hero->background_video_path && !filter_var($hero->background_video_path, FILTER_VALIDATE_URL)) {
                Storage::delete('public/' . $hero->background_video_path);
            }
            $path = $request->file('background_video_path')->store('hero-videos', 'public');
            $data['background_video_path'] = $path;
        } elseif ($request->filled('background_video_url')) {
             // If switching to URL from a file, optionally delete the old file
            if ($hero->background_video_path && !filter_var($hero->background_video_path, FILTER_VALIDATE_URL)) {
                Storage::delete('public/' . $hero->background_video_path);
            }
            $data['background_video_path'] = $request->background_video_url;
        }

        $hero->update($data);

        return redirect()->route('hero.index')->with('success', 'Slide updated successfully!');
    }

    public function destroy(HeroSection $hero)
    {
        if ($hero->background_image_path) {
            Storage::delete('public/' . $hero->background_image_path);
        }
        // Only delete video file if it's NOT a URL
        if ($hero->background_video_path && !filter_var($hero->background_video_path, FILTER_VALIDATE_URL)) {
            Storage::delete('public/' . $hero->background_video_path);
        }
        $hero->delete();
        return redirect()->route('hero.index')->with('success', 'Slide deleted successfully!');
    }
}
