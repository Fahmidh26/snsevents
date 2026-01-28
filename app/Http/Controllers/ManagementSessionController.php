<?php

namespace App\Http\Controllers;

use App\Models\ManagementSessionSettings;
use App\Models\ManagementSessionSlot;
use App\Models\ManagementSessionBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ManagementSessionController extends Controller
{
    /**
     * Display the management session booking page
     */
    public function index()
    {
        $settings = ManagementSessionSettings::getSettings();
        
        if (!$settings->is_active) {
            abort(404);
        }

        // Get available dates for the next 60 days
        $availableDates = ManagementSessionSlot::available()
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

        return view('management-session', compact('settings', 'availableDates'));
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

        $slots = ManagementSessionSlot::available()
            ->forDate($date)
            ->orderBy('start_time')
            ->get()
            ->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'start_time' => Carbon::parse($slot->start_time)->format('g:i A'),
                    'end_time' => Carbon::parse($slot->end_time)->format('g:i A'),
                    'formatted_time' => $slot->formatted_time,
                    'duration' => $slot->duration,
                    'price' => $slot->price,
                    'formatted_price' => $slot->price ? '$' . number_format($slot->price, 2) : 'Free',
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
            'slot_id' => 'required|exists:management_session_slots,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'event_type' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'message' => 'nullable|string|max:2000',
        ]);

        // Check if slot is still available
        $slot = ManagementSessionSlot::find($validated['slot_id']);
        
        if (!$slot || !$slot->canBeBooked()) {
            return back()->with('error', 'Sorry, this slot is no longer available. Please select another time.');
        }

        // Create the booking
        $booking = ManagementSessionBooking::create([
            'slot_id' => $validated['slot_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'event_type' => $validated['event_type'],
            'event_date' => $validated['event_date'],
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('management-session.confirmation', ['code' => $booking->confirmation_code]);
    }

    /**
     * Display booking confirmation
     */
    public function confirmation($code)
    {
        $booking = ManagementSessionBooking::with('slot')
            ->where('confirmation_code', $code)
            ->firstOrFail();

        $settings = ManagementSessionSettings::getSettings();

        return view('management-session-confirmation', compact('booking', 'settings'));
    }
}
