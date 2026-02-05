<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ServiceAreaPageSetting;
use Illuminate\Support\Facades\Storage;

class ServiceAreaController extends Controller
{
    public function settings()
    {
        $settings = ServiceAreaPageSetting::firstOrCreate([], [
            'heading' => 'Areas We Serve',
            'subheading' => 'Bringing The Magic To Your Neighborhood',
        ]);
        return view('admin.service-areas.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_hero_image' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string|max:255',
        ]);

        $settings = ServiceAreaPageSetting::firstOrCreate([]);

        if ($request->hasFile('hero_image')) {
            if ($settings->hero_image_path) {
                Storage::disk('public')->delete($settings->hero_image_path);
            }
            $path = $request->file('hero_image')->store('service-areas', 'public');
            $settings->hero_image_path = $path;
        } elseif ($request->filled('remove_hero_image') && $request->remove_hero_image) {
            if ($settings->hero_image_path) {
                Storage::disk('public')->delete($settings->hero_image_path);
            }
            $settings->hero_image_path = null;
        }

        $settings->seo_title = $validated['seo_title'];
        $settings->seo_description = $validated['seo_description'];
        $settings->seo_keywords = $validated['seo_keywords'];
        $settings->heading = $validated['heading'];
        $settings->subheading = $validated['subheading'];
        $settings->save();

        return back()->with('success', 'Page settings updated successfully.');
    }
    public function index()
    {
        $serviceAreas = ServiceArea::orderBy('display_order')->get();
        return view('admin.service-areas.index', compact('serviceAreas'));
    }

    public function create()
    {
        return view('admin.service-areas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'map_url' => 'nullable|url',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        ServiceArea::create($validated);

        return redirect()->route('admin.service-areas.index')
            ->with('success', 'Service area created successfully.');
    }

    public function edit($id)
    {
        $serviceArea = ServiceArea::findOrFail($id);
        return view('admin.service-areas.edit', compact('serviceArea'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'map_url' => 'nullable|url',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);

        $serviceArea = ServiceArea::findOrFail($id);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        $serviceArea->update($validated);

        return back()->with('success', 'Service area updated successfully.');
    }

    public function destroy($id)
    {
        $serviceArea = ServiceArea::findOrFail($id);
        $serviceArea->delete();

        return redirect()->route('admin.service-areas.index')
            ->with('success', 'Service area deleted successfully.');
    }
}
