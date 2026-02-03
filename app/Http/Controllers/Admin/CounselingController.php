<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounselingSettings;
use App\Models\CounselingSlot;
use App\Models\CounselingBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CounselingController extends Controller
{
    /**
     * Display counseling settings form
     */
    public function settings()
    {
        $settings = CounselingSettings::getSettings();
        return view('admin.counseling.settings', compact('settings'));
    }

    /**
     * Update counseling settings
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'intro_text' => 'required|string',
            'intro_title' => 'nullable|string|max:255',
            'page_title' => 'required|string|max:255',
            'page_subtitle' => 'nullable|string|max:255',
            'session_duration' => 'required|integer|min:15|max:480',
            'price' => 'nullable|numeric|min:0',
            'price_label' => 'nullable|string|max:100',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'intro_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'booking_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:255',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $settings = CounselingSettings::getSettings();

        // Handle File Uploads
        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('counseling', 'public');
            $validated['hero_image'] = $path;
        }

        if ($request->hasFile('intro_image')) {
            $path = $request->file('intro_image')->store('counseling', 'public');
            $validated['intro_image'] = $path;
        }

        if ($request->hasFile('booking_image')) {
            $path = $request->file('booking_image')->store('counseling', 'public');
            $validated['booking_image'] = $path;
        }

        $settings->update($validated);

        return back()->with('success', 'Counseling settings updated successfully.');
    }

    /**
     * Display list of all slots
     */
    public function slots()
    {
        $slots = CounselingSlot::with('booking')
            ->orderBy('date', 'desc')
            ->orderBy('start_time')
            ->paginate(20);
            
        return view('admin.counseling.slots.index', compact('slots'));
    }

    /**
     * Show form to create new slot
     */
    public function createSlot()
    {
        return view('admin.counseling.slots.create');
    }

    /**
     * Store new slot(s)
     */
    public function storeSlot(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
            'create_recurring' => 'nullable|boolean',
            'recurring_weeks' => 'nullable|integer|min:1|max:12',
        ]);

        // Calculate end time from start time + duration
        $startTime = Carbon::createFromFormat('H:i', $validated['start_time']);
        $endTime = $startTime->copy()->addMinutes($validated['duration'])->format('H:i');

        $slotsCreated = 0;
        $dates = [Carbon::parse($validated['date'])];

        // If recurring, create slots for multiple weeks
        if ($request->has('create_recurring') && $request->recurring_weeks > 0) {
            for ($i = 1; $i <= $request->recurring_weeks; $i++) {
                $dates[] = Carbon::parse($validated['date'])->addWeeks($i);
            }
        }

        foreach ($dates as $date) {
            // Check for overlaps
            // New Start < Existing End AND New End > Existing Start
            $overlap = CounselingSlot::where('date', $date->format('Y-m-d'))
                ->where(function ($query) use ($validated, $endTime) {
                    $query->where('start_time', '<', $endTime)
                          ->where('end_time', '>', $validated['start_time']);
                })
                ->exists();

            if (!$overlap) {
                CounselingSlot::create([
                    'date' => $date->format('Y-m-d'),
                    'start_time' => $validated['start_time'],
                    'end_time' => $endTime,
                    'duration' => $validated['duration'],
                    'price' => $validated['price'],
                    'notes' => $validated['notes'] ?? null,
                    'is_available' => true,
                    'is_booked' => false,
                ]);
                $slotsCreated++;
            } else {
                 return back()->with('error', "Slot overlaps with an existing slot on " . $date->format('Y-m-d') . ".");
            }
        }

        return redirect()->route('admin.counseling.slots')
            ->with('success', $slotsCreated . ' slot(s) created successfully.');
    }

    /**
     * Show form to edit slot
     */
    public function editSlot($id)
    {
        $slot = CounselingSlot::with('booking')->findOrFail($id);
        return view('admin.counseling.slots.edit', compact('slot'));
    }

    /**
     * Update slot
     */
    public function updateSlot(Request $request, $id)
    {
        $slot = CounselingSlot::findOrFail($id);

        $validated = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        // Calculate end time from start time + duration
        $startTime = Carbon::createFromFormat('H:i', $validated['start_time']);
        $validated['end_time'] = $startTime->copy()->addMinutes($validated['duration'])->format('H:i');
        $validated['is_available'] = $request->has('is_available');

        $slot->update($validated);

        return back()->with('success', 'Slot updated successfully.');
    }

    /**
     * Delete slot
     */
    public function deleteSlot($id)
    {
        $slot = CounselingSlot::findOrFail($id);
        
        if ($slot->is_booked) {
            return back()->with('error', 'Cannot delete a booked slot. Cancel the booking first.');
        }
        
        $slot->delete();

        return redirect()->route('admin.counseling.slots')
            ->with('success', 'Slot deleted successfully.');
    }

    /**
     * Display all bookings
     */
    public function bookings(Request $request)
    {
        $query = CounselingBooking::with('slot')
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(20);
        
        return view('admin.counseling.bookings.index', compact('bookings'));
    }

    /**
     * Update booking status
     */
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = CounselingBooking::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking->update($validated);

        return back()->with('success', 'Booking status updated successfully.');
    }

    /**
     * Delete booking
     */
    public function deleteBooking($id)
    {
        $booking = CounselingBooking::findOrFail($id);
        
        // Free up the slot
        if ($booking->slot) {
            $booking->slot->update(['is_booked' => false]);
        }
        
        $booking->delete();

        return redirect()->route('admin.counseling.bookings')
            ->with('success', 'Booking deleted successfully.');
    }
    /**
     * Check slot availability for admin
     */
    public function checkSlotAvailability(Request $request)
    {
        $date = $request->query('date');
        
        if (!$date) {
            return response()->json([]);
        }

        $slots = CounselingSlot::where('date', $date)
            ->orderBy('start_time')
            ->get(['start_time', 'end_time', 'duration']);
            
        return response()->json($slots);
    }
}
