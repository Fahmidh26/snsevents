<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CounselingBooking;
use App\Models\ManagementSessionBooking;

class CalendarController extends Controller
{
    /**
     * Display the calendar view.
     */
    public function index()
    {
        return view('admin.calendar.index');
    }

    /**
     * Fetch all bookings formatted for FullCalendar.
     */
    public function events(Request $request)
    {
        $events = [];

        // 1. Fetch Counseling Bookings
        // We want bookings that have a slot and are not cancelled (e.g., pending or confirmed)
        $counselingBookings = CounselingBooking::with('slot')
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        foreach ($counselingBookings as $booking) {
            if ($booking->slot) {
                // Combine date and time
                $start = $booking->slot->date->format('Y-m-d') . 'T' . $booking->slot->start_time;
                $end = $booking->slot->date->format('Y-m-d') . 'T' . $booking->slot->end_time;
                
                $color = $booking->status === 'confirmed' ? '#10b981' : '#f59e0b'; // Green or Amber

                $events[] = [
                    'id' => 'c_' . $booking->id,
                    'title' => 'Counseling: ' . $booking->name,
                    'start' => $start,
                    'end' => $end,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'extendedProps' => [
                        'type' => 'Counseling',
                        'name' => $booking->name,
                        'email' => $booking->email,
                        'phone' => $booking->phone,
                        'status' => $booking->status,
                        'amount_paid' => $booking->amount_paid ? '$' . number_format($booking->amount_paid, 2) : 'N/A',
                        'meet_link' => $booking->meet_link ?? 'Not Generated',
                    ]
                ];
            }
        }

        // 2. Fetch Management Session Bookings
        $managementBookings = ManagementSessionBooking::with('slot')
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        foreach ($managementBookings as $booking) {
             if ($booking->slot) {
                $start = $booking->slot->date->format('Y-m-d') . 'T' . $booking->slot->start_time;
                $end = $booking->slot->date->format('Y-m-d') . 'T' . $booking->slot->end_time;
                
                // Use a slightly different color scheme for management to distinguish
                $color = $booking->status === 'confirmed' ? '#3b82f6' : '#8b5cf6'; // Blue or Purple

                $events[] = [
                    'id' => 'm_' . $booking->id,
                    'title' => 'Management: ' . $booking->name,
                    'start' => $start,
                    'end' => $end,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'extendedProps' => [
                        'type' => 'Management Session',
                        'name' => $booking->name,
                        'email' => $booking->email,
                        'phone' => $booking->phone,
                        'status' => $booking->status,
                        'amount_paid' => $booking->amount_paid ? '$' . number_format($booking->amount_paid, 2) : 'N/A',
                        'meet_link' => $booking->meet_link ?? 'Not Generated',
                    ]
                ];
            }
        }

        return response()->json($events);
    }
}
