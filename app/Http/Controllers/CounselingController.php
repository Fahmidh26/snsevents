<?php

namespace App\Http\Controllers;

use App\Models\CounselingSettings;
use App\Models\CounselingSlot;
use App\Models\CounselingBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CounselingController extends Controller
{
    /**
     * Display the counseling booking page
     */
    public function index()
    {
        $settings = CounselingSettings::getSettings();
        
        if (!$settings->is_active) {
            abort(404);
        }

        // Get available dates for the next 60 days
        $availableDates = CounselingSlot::available()
            ->upcoming()
            ->where('date', '<=', Carbon::today()->addDays(60))
            ->selectRaw('date, COUNT(*) as slot_count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('slot_count', 'date')
            ->mapWithKeys(function ($count, $date) {
                return [Carbon::parse($date)->format('Y-m-d') => $count];
            })
            ->toArray();

        return view('counseling', compact('settings', 'availableDates'));
    }

    /**
     * Get available slots for a specific date (AJAX)
     */
    public function getSlots(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        $date = Carbon::parse($request->date);

        $slots = CounselingSlot::available()
            ->forDate($date)
            ->orderBy('start_time')
            ->get()
            ->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'start_time' => Carbon::parse($slot->start_time)->format('g:i A'),
                    'raw_start_time' => Carbon::parse($slot->start_time)->format('H:i'),
                    'end_time' => Carbon::parse($slot->end_time)->format('g:i A'),
                    'formatted_time' => $slot->formatted_time,
                    'duration' => $slot->duration,
                    'price' => $slot->price,
                    'formatted_price' => '$' . number_format($slot->price, 2),
                ];
            });

        return response()->json([
            'success' => true,
            'date' => $date->format('l, F j, Y'),
            'slots' => $slots,
        ]);
    }

    /**
     * Handle booking submission
     */
    public function book(Request $request)
    {
        $validated = $request->validate([
            'slot_id' => 'required|exists:counseling_slots,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'nullable|string|max:2000',
            'terms' => 'required|accepted',
        ]);

        // Check if slot is still available
        $slot = CounselingSlot::find($validated['slot_id']);
        
        if (!$slot || !$slot->canBeBooked()) {
            return back()->with('error', 'Sorry, this slot is no longer available. Please select another time.');
        }

        // Create the booking
        $booking = CounselingBooking::create([
            'slot_id' => $validated['slot_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('counseling.confirmation', ['code' => $booking->confirmation_code]);
    }

    /**
     * Display booking confirmation
     */
    public function confirmation($code)
    {
        $booking = CounselingBooking::with('slot')
            ->where('confirmation_code', $code)
            ->firstOrFail();

        $settings = CounselingSettings::getSettings();

        return view('counseling-confirmation', compact('booking', 'settings'));
    }
}
