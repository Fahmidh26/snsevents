<?php

namespace App\Http\Controllers;

use App\Mail\RescheduleRequestAdminMail;
use App\Models\CounselingBooking;
use App\Models\CounselingSlot;
use App\Models\ManagementSessionBooking;
use App\Models\ManagementSessionSlot;
use App\Models\RescheduleRequest;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RescheduleController extends Controller
{
    // ---------------------------------------------------------------
    // COUNSELING
    // ---------------------------------------------------------------

    public function showCounseling($code)
    {
        $booking = CounselingBooking::with('slot')
            ->where('confirmation_code', $code)
            ->where('status', 'confirmed')
            ->where('payment_status', 'paid')
            ->firstOrFail();

        // Must be more than 24h before the session
        $sessionStart = Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->start_time);
        if ($sessionStart->diffInHours(now(), false) >= -24) {
            return redirect()->route('counseling.confirmation', ['code' => $code])
                ->with('error', 'Reschedule requests must be made at least 24 hours before the session.');
        }

        // Block if a pending request already exists
        $pending = $booking->rescheduleRequests()->where('status', 'pending')->exists();
        if ($pending) {
            return redirect()->route('counseling.confirmation', ['code' => $code])
                ->with('error', 'You already have a pending reschedule request. Please wait for admin review.');
        }

        $availableSlots = CounselingSlot::where('is_available', true)
            ->where('is_booked', false)
            ->where('date', '>=', Carbon::today())
            ->where('id', '!=', $booking->slot_id)
            ->where('duration', $booking->slot->duration)  // only same-duration slots
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('reschedule-request', [
            'booking'          => $booking,
            'availableSlots'   => $availableSlots,
            'type'             => 'counseling',
            'originalDuration' => $booking->slot->duration,
            'submitRoute'      => route('counseling.reschedule.submit', ['code' => $code]),
        ]);
    }

    public function submitCounseling(Request $request, $code)
    {
        $booking = CounselingBooking::with('slot')
            ->where('confirmation_code', $code)
            ->where('status', 'confirmed')
            ->where('payment_status', 'paid')
            ->firstOrFail();

        // Re-check 24h rule
        $sessionStart = Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->start_time);
        if ($sessionStart->diffInHours(now(), false) >= -24) {
            return back()->with('error', 'Reschedule requests must be made at least 24 hours before the session.');
        }

        // Block duplicate pending
        if ($booking->rescheduleRequests()->where('status', 'pending')->exists()) {
            return back()->with('error', 'You already have a pending reschedule request.');
        }

        $validated = $request->validate([
            'requested_slot_id' => 'required|exists:counseling_slots,id',
            'reason'            => 'nullable|string|max:1000',
        ]);

        // Make sure the requested slot is still available
        $slot = CounselingSlot::find($validated['requested_slot_id']);
        if (!$slot || !$slot->canBeBooked()) {
            return back()->with('error', 'The selected slot is no longer available. Please choose another.');
        }

        $rescheduleRequest = RescheduleRequest::create([
            'booking_type'       => 'counseling',
            'booking_id'         => $booking->id,
            'requested_slot_id'  => $slot->id,
            'reason'             => $validated['reason'] ?? null,
            'status'             => 'pending',
        ]);

        try {
            $adminEmail = SiteSetting::current()->admin_email;
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new RescheduleRequestAdminMail($rescheduleRequest));
            }
        } catch (\Exception $e) {
            Log::error('Reschedule request admin email error: ' . $e->getMessage());
        }

        return redirect()->route('counseling.confirmation', ['code' => $code])
            ->with('success', 'Your reschedule request has been submitted! We\'ll review it and get back to you soon.');
    }

    // ---------------------------------------------------------------
    // MANAGEMENT SESSION
    // ---------------------------------------------------------------

    public function showManagement($code)
    {
        $booking = ManagementSessionBooking::with('slot')
            ->where('confirmation_code', $code)
            ->where('status', 'confirmed')
            ->where('payment_status', 'paid')
            ->firstOrFail();

        $sessionStart = Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->start_time);
        if ($sessionStart->diffInHours(now(), false) >= -24) {
            return redirect()->route('management-session.confirmation', ['code' => $code])
                ->with('error', 'Reschedule requests must be made at least 24 hours before the session.');
        }

        $pending = $booking->rescheduleRequests()->where('status', 'pending')->exists();
        if ($pending) {
            return redirect()->route('management-session.confirmation', ['code' => $code])
                ->with('error', 'You already have a pending reschedule request. Please wait for admin review.');
        }

        $availableSlots = ManagementSessionSlot::where('is_available', true)
            ->where('is_booked', false)
            ->where('date', '>=', Carbon::today())
            ->where('id', '!=', $booking->slot_id)
            ->where('duration', $booking->slot->duration)  // only same-duration slots
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('reschedule-request', [
            'booking'          => $booking,
            'availableSlots'   => $availableSlots,
            'type'             => 'management',
            'originalDuration' => $booking->slot->duration,
            'submitRoute'      => route('management-session.reschedule.submit', ['code' => $code]),
        ]);
    }

    public function submitManagement(Request $request, $code)
    {
        $booking = ManagementSessionBooking::with('slot')
            ->where('confirmation_code', $code)
            ->where('status', 'confirmed')
            ->where('payment_status', 'paid')
            ->firstOrFail();

        $sessionStart = Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->start_time);
        if ($sessionStart->diffInHours(now(), false) >= -24) {
            return back()->with('error', 'Reschedule requests must be made at least 24 hours before the session.');
        }

        if ($booking->rescheduleRequests()->where('status', 'pending')->exists()) {
            return back()->with('error', 'You already have a pending reschedule request.');
        }

        $validated = $request->validate([
            'requested_slot_id' => 'required|exists:management_session_slots,id',
            'reason'            => 'nullable|string|max:1000',
        ]);

        $slot = ManagementSessionSlot::find($validated['requested_slot_id']);
        if (!$slot || !$slot->canBeBooked()) {
            return back()->with('error', 'The selected slot is no longer available. Please choose another.');
        }

        $rescheduleRequest = RescheduleRequest::create([
            'booking_type'      => 'management',
            'booking_id'        => $booking->id,
            'requested_slot_id' => $slot->id,
            'reason'            => $validated['reason'] ?? null,
            'status'            => 'pending',
        ]);

        try {
            $adminEmail = SiteSetting::current()->admin_email;
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new RescheduleRequestAdminMail($rescheduleRequest));
            }
        } catch (\Exception $e) {
            Log::error('Reschedule request admin email error: ' . $e->getMessage());
        }

        return redirect()->route('management-session.confirmation', ['code' => $code])
            ->with('success', 'Your reschedule request has been submitted! We\'ll review it and get back to you soon.');
    }
}
