<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceAreaController extends Controller
{
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
