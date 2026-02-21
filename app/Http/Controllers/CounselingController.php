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
        // Check if the user returned from an abandoned checkout
        if (session()->has('pending_counseling_booking_id')) {
            $bookingId = session()->pull('pending_counseling_booking_id');
            $pendingBooking = CounselingBooking::with('slot')->where('id', $bookingId)->where('payment_status', 'unpaid')->first();
            
            if ($pendingBooking) {
                // Optionally expire the Stripe Checkout Session
                if ($pendingBooking->stripe_session_id) {
                    try {
                        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
                        $stripe->checkout->sessions->expire($pendingBooking->stripe_session_id, []);
                    } catch (\Exception $e) {
                        // It may already be expired or paid
                    }
                }
                
                // Free the slot
                if ($pendingBooking->slot) {
                    $pendingBooking->slot->update(['is_booked' => false]);
                }
                
                $pendingBooking->delete();
            }
        }

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
                    'id'              => $slot->id,
                    'start_time'      => Carbon::parse($slot->start_time)->format('g:i A'),
                    'raw_start_time'  => Carbon::parse($slot->start_time)->format('H:i'),
                    'end_time'        => Carbon::parse($slot->end_time)->format('g:i A'),
                    'formatted_time'  => $slot->formatted_time,
                    'duration'        => $slot->duration,
                    'price'           => $slot->price,
                    'formatted_price' => '$' . number_format($slot->price, 2),
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
        $booking = CounselingBooking::with('slot')
            ->where('confirmation_code', $code)
            ->firstOrFail();

        $settings = CounselingSettings::getSettings();

        return view('counseling-confirmation', compact('booking', 'settings'));
    }
}
