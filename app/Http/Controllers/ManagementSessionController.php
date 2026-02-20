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
                    'id'              => $slot->id,
                    'start_time'      => Carbon::parse($slot->start_time)->format('g:i A'),
                    'raw_start_time'  => Carbon::parse($slot->start_time)->format('H:i'),
                    'end_time'        => Carbon::parse($slot->end_time)->format('g:i A'),
                    'formatted_time'  => $slot->formatted_time,
                    'duration'        => $slot->duration,
                    'price'           => $slot->price,
                    'formatted_price' => $slot->price ? '$' . number_format($slot->price, 2) : 'Free',
                ];
            });

        return response()->json([
            'success' => true,
            'date'    => $date->format('l, F j, Y'),
            'slots'   => $slots,
        ]);
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
