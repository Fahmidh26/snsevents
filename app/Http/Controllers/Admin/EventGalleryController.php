<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventGallery;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventGalleryController extends Controller
{
    public function index(Request $request)
    {
        $eventTypes = EventType::all();
        $query = EventGallery::with('eventType');
        
        if ($request->has('event_type_id')) {
            $query->where('event_type_id', $request->event_type_id);
        }
        
        $galleries = $query->orderBy('event_type_id')->orderBy('display_order')->get();
        return view('admin.galleries.index', compact('galleries', 'eventTypes'));
    }

    public function create()
    {
        $eventTypes = EventType::all();
        return view('admin.galleries.create', compact('eventTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type_id' => 'required|exists:event_types,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('uploads/gallery'), $imageName);
            
            EventGallery::create([
                'event_type_id' => $request->event_type_id,
                'image_path' => 'uploads/gallery/' . $imageName,
                'is_featured' => false,
                'display_order' => 0
            ]);
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery images uploaded successfully.');
    }

    public function update(Request $request, EventGallery $gallery)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'display_order' => 'integer',
        ]);

        $gallery->update([
            'caption' => $request->caption,
            'display_order' => $request->display_order,
            'is_featured' => $request->has('is_featured')
        ]);

        if ($request->has('is_featured')) {
            // Unset other featured images for this event type
            EventGallery::where('event_type_id', $gallery->event_type_id)
                ->where('id', '!=', $gallery->id)
                ->update(['is_featured' => false]);
        }

        return back()->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(EventGallery $gallery)
    {
        if (file_exists(public_path($gallery->image_path))) {
            unlink(public_path($gallery->image_path));
        }

        $gallery->delete();

        return back()->with('success', 'Gallery image deleted successfully.');
    }
}
