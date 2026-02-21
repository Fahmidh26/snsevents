<?php

namespace App\Http\Controllers\Admin;

use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Mail\RescheduleApprovedMail;
use App\Mail\RescheduleRejectedMail;
use App\Models\CounselingBooking;
use App\Models\CounselingSlot;
use App\Models\ManagementSessionBooking;
use App\Models\ManagementSessionSlot;
use App\Models\RescheduleRequest;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RescheduleRequestController extends Controller
{
    public function index()
    {
        $requests = RescheduleRequest::orderByRaw("CASE WHEN status='pending' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->get();

        // Attach booking and slot info eagerly (manual, since polymorphic)
        $requests->each(function ($r) {
            $r->bookingModel        = $r->booking()->first();
            $r->requestedSlotModel  = $r->requestedSlot()->first();
        });

        $pendingCount = $requests->where('status', 'pending')->count();

        return view('admin.reschedule-requests.index', compact('requests', 'pendingCount'));
    }

    public function approve(Request $request, $id)
    {
        $rescheduleRequest = RescheduleRequest::findOrFail($id);

        if ($rescheduleRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        $validated = $request->validate([
            'admin_note' => 'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($rescheduleRequest, $validated) {
            if ($rescheduleRequest->booking_type === 'counseling') {
                $booking     = CounselingBooking::with('slot')->findOrFail($rescheduleRequest->booking_id);
                $newSlot     = CounselingSlot::lockForUpdate()->findOrFail($rescheduleRequest->requested_slot_id);

                if (!$newSlot->canBeBooked()) {
                    throw new \Exception('The requested slot is no longer available.');
                }

                // Free the old slot, lock the new one
                $booking->slot->update(['is_booked' => false]);
                $newSlot->update(['is_booked' => true]);
                $booking->update(['slot_id' => $newSlot->id]);

                // Update Google Calendar
                $this->updateGoogleCalendarEvent($booking->fresh(), $newSlot, 'Coaching Session: ' . $booking->name,
                    "Client Name: {$booking->name}\nEmail: {$booking->email}\nPhone: {$booking->phone}\nNotes: {$booking->message}");

            } else {
                $booking = ManagementSessionBooking::with('slot')->findOrFail($rescheduleRequest->booking_id);
                $newSlot = ManagementSessionSlot::lockForUpdate()->findOrFail($rescheduleRequest->requested_slot_id);

                if (!$newSlot->canBeBooked()) {
                    throw new \Exception('The requested slot is no longer available.');
                }

                $booking->slot->update(['is_booked' => false]);
                $newSlot->update(['is_booked' => true]);
                $booking->update(['slot_id' => $newSlot->id]);

                // Update Google Calendar
                $this->updateGoogleCalendarEvent($booking->fresh(), $newSlot, 'Management Session: ' . $booking->name . ' - ' . $booking->event_type,
                    "Client Name: {$booking->name}\nEmail: {$booking->email}\nPhone: {$booking->phone}\nEvent Type: {$booking->event_type}\nNotes: {$booking->message}");
            }

            $rescheduleRequest->update([
                'status'     => 'approved',
                'admin_note' => $validated['admin_note'] ?? null,
            ]);

            try {
                Mail::to($booking->email)->send(new RescheduleApprovedMail($rescheduleRequest));
            } catch (\Exception $e) {
                Log::error('Reschedule approved email error: ' . $e->getMessage());
            }
        });

        return back()->with('success', 'Reschedule request approved and client notified.');
    }

    public function reject(Request $request, $id)
    {
        $rescheduleRequest = RescheduleRequest::findOrFail($id);

        if ($rescheduleRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        $validated = $request->validate([
            'admin_note' => 'nullable|string|max:500',
        ]);

        $rescheduleRequest->update([
            'status'     => 'rejected',
            'admin_note' => $validated['admin_note'] ?? null,
        ]);

        try {
            $booking = $rescheduleRequest->booking()->first();
            if ($booking?->email) {
                Mail::to($booking->email)->send(new RescheduleRejectedMail($rescheduleRequest));
            }
        } catch (\Exception $e) {
            Log::error('Reschedule rejected email error: ' . $e->getMessage());
        }

        return back()->with('success', 'Reschedule request rejected and client notified.');
    }

    /**
     * Delete the old Google Calendar event and create a fresh one with new time & Meet link.
     */
    private function updateGoogleCalendarEvent($booking, $newSlot, $summary, $description)
    {
        try {
            $calendarService = new GoogleCalendarService();

            // 1) Delete old event if one existed
            if (!empty($booking->google_event_id)) {
                $calendarService->deleteEvent($booking->google_event_id);
            }

            // 2) Create new event with the new slot time
            $startDateTime = Carbon::parse($newSlot->date->format('Y-m-d') . ' ' . $newSlot->start_time);
            $endDateTime   = Carbon::parse($newSlot->date->format('Y-m-d') . ' ' . $newSlot->end_time);

            $meeting = $calendarService->createEventWithMeetLink(
                $summary,
                $description,
                $startDateTime,
                $endDateTime,
                $booking->email
            );

            // 3) Save new meet link and event ID on the booking
            if (!empty($meeting['meet_link'])) {
                $booking->meet_link       = $meeting['meet_link'];
                $booking->google_event_id = $meeting['event_id'];
                $booking->save();
                Log::info('Google Calendar event rescheduled. New meet link: ' . $meeting['meet_link']);
            }
        } catch (\Exception $e) {
            Log::error('Google Calendar reschedule update error: ' . $e->getMessage());
        }
    }
}
