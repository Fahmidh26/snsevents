<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventTypeController extends Controller
{
    public function index()
    {
        $eventTypes = EventType::orderBy('display_order')->get();
        return view('admin.event_types.index', compact('eventTypes'));
    }

    public function create()
    {
        return view('admin.event_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'display_order' => 'integer',
        ]);

        $data = $request->except('featured_image');
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status');

        if ($request->hasFile('featured_image')) {
            $imageName = time() . '.' . $request->featured_image->extension();
            $request->featured_image->move(public_path('uploads/events'), $imageName);
            $data['featured_image'] = 'uploads/events/' . $imageName;
        }

        EventType::create($data);

        return redirect()->route('admin.event-types.index')->with('success', 'Event type created successfully.');
    }

    public function edit(EventType $eventType)
    {
        return view('admin.event_types.edit', compact('eventType'));
    }

    public function update(Request $request, EventType $eventType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'display_order' => 'integer',
        ]);

        $data = $request->except('featured_image');
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status');

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($eventType->featured_image && file_exists(public_path($eventType->featured_image))) {
                unlink(public_path($eventType->featured_image));
            }

            $imageName = time() . '.' . $request->featured_image->extension();
            $request->featured_image->move(public_path('uploads/events'), $imageName);
            $data['featured_image'] = 'uploads/events/' . $imageName;
        }

        $eventType->update($data);

        return redirect()->route('admin.event-types.index')->with('success', 'Event type updated successfully.');
    }

    public function destroy(EventType $eventType)
    {
        if ($eventType->featured_image && file_exists(public_path($eventType->featured_image))) {
            unlink(public_path($eventType->featured_image));
        }

        $eventType->delete();

        return redirect()->route('admin.event-types.index')->with('success', 'Event type deleted successfully.');
    }
}
