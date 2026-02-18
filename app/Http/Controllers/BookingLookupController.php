<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CounselingBooking;
use App\Models\ManagementSessionBooking;
use App\Models\SiteSetting;

class BookingLookupController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::first();
        // Just empty object for SEO if not set in a specific way, or basic SEO
        $seo = new \stdClass();
        $seo->title = 'Track Your Booking - SNS Events';
        $seo->meta_description = 'Check the status and details of your booking with SNS Events.';
        $seo->meta_keywords = 'track booking, check status, sns events booking';
        $seo->og_image = $siteSettings->logo_path ? asset('storage/'.$siteSettings->logo_path) : null;

        return view('bookings.track', compact('siteSettings', 'seo'));
    }

    public function lookup(Request $request)
    {
        $request->validate([
            'confirmation_code' => 'required|string|min:5',
        ]);

        $code = trim($request->confirmation_code);

        // Check for Counseling Booking (SNS- prefix)
        if (str_starts_with($code, 'SNS-')) {
            $booking = CounselingBooking::where('confirmation_code', $code)->first();
            if ($booking) {
                return redirect()->route('counseling.confirmation', ['code' => $code]);
            }
        } 
        // Check for Management Session Booking (MGT- prefix)
        elseif (str_starts_with($code, 'MGT-')) {
            $booking = ManagementSessionBooking::where('confirmation_code', $code)->first();
            if ($booking) {
                return redirect()->route('management-session.confirmation', ['code' => $code]);
            }
        }
        // Fallback: Check both if prefix is missing or user just typed the random part (though we should encourage full code)
        // Or specific logic if they didn't include prefix. 
        // For now, let's assume they might miss the prefix or type it case-insensitively.
        
        // Case insensitive search and handling missing prefix if applicable?
        // Let's stick to the generated codes. If they type just the random part, we could try to find it.
        
        // Detailed search if prefix logic didn't match (e.g. user typed lowercase or partial)
        $booking = CounselingBooking::where('confirmation_code', $code)->first();
        if ($booking) {
             return redirect()->route('counseling.confirmation', ['code' => $booking->confirmation_code]);
        }
        
        $booking = ManagementSessionBooking::where('confirmation_code', $code)->first();
        if ($booking) {
             return redirect()->route('management-session.confirmation', ['code' => $booking->confirmation_code]);
        }

        return back()->withErrors(['confirmation_code' => 'Booking not found. Please check your confirmation code and try again.']);
    }
}
