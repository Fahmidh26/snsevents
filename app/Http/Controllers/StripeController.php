<?php

namespace App\Http\Controllers;

use App\Models\CounselingBooking;
use App\Models\CounselingSlot;
use App\Models\ManagementSessionBooking;
use App\Models\ManagementSessionSlot;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CoachingBookingMail;
use App\Mail\CoachingBookingUserConfirmation;
use App\Mail\ManagementSessionBookingMail;
use App\Mail\ManagementSessionBookingUserConfirmation;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    // ---------------------------------------------------------------
    // COUNSELING — show payment page via Stripe Checkout redirect
    // ---------------------------------------------------------------

    /**
     * Create Stripe Checkout Session for a counseling booking and redirect.
     */
    public function checkoutCounseling(Request $request)
    {
        $validated = $request->validate([
            'slot_id' => 'required|exists:counseling_slots,id',
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:50',
            'message' => 'nullable|string|max:2000',
            'terms'   => 'required|accepted',
        ]);

        // Use a DB transaction with a pessimistic lock to prevent double-booking
        return DB::transaction(function () use ($validated) {
            $slot = CounselingSlot::lockForUpdate()->find($validated['slot_id']);

            if (!$slot || !$slot->canBeBooked()) {
                return back()->with('error', 'Sorry, this slot is no longer available. Please select another time.');
            }

            // If the slot is free ($0), skip Stripe entirely and confirm immediately
            if (!$slot->price || $slot->price <= 0) {
                $slot->update(['is_booked' => true]);
                $booking = CounselingBooking::create([
                    'slot_id'        => $slot->id,
                    'name'           => $validated['name'],
                    'email'          => $validated['email'],
                    'phone'          => $validated['phone'],
                    'message'        => $validated['message'] ?? null,
                    'status'         => 'pending',
                    'payment_status' => 'paid', // Mark as paid since it's free
                    'amount_paid'    => 0,
                ]);

                // Call the confirmation helper (generates Meet link & emails)
                $this->confirmCounselingBooking($booking, 'free_session', 0);
                
                return redirect()->route('counseling.confirmation', ['code' => $booking->confirmation_code]);
            }

            // Lock the slot immediately
            $slot->update(['is_booked' => true]);

            // Create pending booking
            $booking = CounselingBooking::create([
                'slot_id'        => $slot->id,
                'name'           => $validated['name'],
                'email'          => $validated['email'],
                'phone'          => $validated['phone'],
                'message'        => $validated['message'] ?? null,
                'status'         => 'pending',
                'payment_status' => 'unpaid',
            ]);

            try {
                $sessionName = \App\Models\CounselingSettings::getSettings()->name ?? 'Coaching Session';

                // Omitting payment_method_types lets Stripe show ALL methods
                // enabled in your Dashboard (cards, Apple Pay, Google Pay, etc.)
                $checkoutSession = StripeSession::create([
                    'line_items' => [[
                        'price_data' => [
                            'currency'     => 'usd',
                            'unit_amount'  => (int) round($slot->price * 100),
                            'product_data' => [
                                'name'        => $sessionName . ' — ' . $slot->duration . ' min',
                                'description' => $slot->formatted_date . ' at ' . $slot->formatted_time,
                            ],
                        ],
                        'quantity' => 1,
                    ]],
                    'mode'             => 'payment',
                    'adaptive_pricing' => [
                        'enabled' => true,
                    ],
                    'customer_email'   => $booking->email,
                    'expires_at'       => time() + 1800, // Expire in 30 mins (minimum allowed by Stripe) if user abandons
                    'success_url'      => route('counseling.payment.success', ['code' => $booking->confirmation_code]) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url'       => route('counseling.payment.cancel', ['code' => $booking->confirmation_code]),
                    'metadata'         => [
                        'booking_type'      => 'counseling',
                        'booking_id'        => $booking->id,
                        'confirmation_code' => $booking->confirmation_code,
                    ],
                ]);

                $booking->update(['stripe_session_id' => $checkoutSession->id]);

                // Store in session so we can clean it up if they abandon it and go back
                session()->put('pending_counseling_booking_id', $booking->id);

                return redirect($checkoutSession->url);

            } catch (\Exception $e) {
                Log::error('Stripe Checkout (Counseling) error: ' . $e->getMessage());
                // Rollback slot lock and remove pending booking
                $slot->update(['is_booked' => false]);
                $booking->delete();
                return back()->with('error', 'Payment initialisation failed. Please try again.');
            }
        });
    }

    /**
     * Stripe redirects here after successful counseling payment.
     */
    public function successCounseling(Request $request, $code)
    {
        $booking = CounselingBooking::with('slot')
            ->where('confirmation_code', $code)
            ->firstOrFail();

        // Already confirmed (e.g. webhook arrived first)
        if ($booking->payment_status === 'paid') {
            return redirect()->route('counseling.confirmation', ['code' => $code]);
        }

        // Verify with Stripe
        try {
            $sessionId = $request->get('session_id');
            if ($sessionId && $booking->stripe_session_id === $sessionId) {
                $stripeSession = StripeSession::retrieve($sessionId);

                if ($stripeSession->payment_status === 'paid') {
                    $this->confirmCounselingBooking($booking, $stripeSession->payment_intent, $stripeSession->amount_total);
                }
            }
        } catch (\Exception $e) {
            Log::error('Stripe success (Counseling) verification error: ' . $e->getMessage());
        }

        return redirect()->route('counseling.confirmation', ['code' => $code]);
    }

    /**
     * User cancelled payment — free the slot.
     */
    public function cancelCounseling($code)
    {
        $booking = CounselingBooking::where('confirmation_code', $code)->first();

        if ($booking && $booking->payment_status === 'unpaid') {
            if ($booking->slot) {
                $booking->slot->update(['is_booked' => false]);
            }
            $booking->delete(); // Delete the booking completely so it's not kept pending
        }

        return redirect()->route('counseling')->with('error', 'Payment was cancelled. Please try again.');
    }

    // ---------------------------------------------------------------
    // MANAGEMENT SESSION — show payment page via Stripe Checkout
    // ---------------------------------------------------------------

    public function checkoutManagement(Request $request)
    {
        $validated = $request->validate([
            'slot_id'    => 'required|exists:management_session_slots,id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:50',
            'event_type' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'message'    => 'nullable|string|max:2000',
        ]);

        return DB::transaction(function () use ($validated) {
            $slot = ManagementSessionSlot::lockForUpdate()->find($validated['slot_id']);

            if (!$slot || !$slot->canBeBooked()) {
                return back()->with('error', 'Sorry, this slot is no longer available. Please select another time.');
            }

            // If the slot is free ($0), skip Stripe entirely and confirm immediately
            if (!$slot->price || $slot->price <= 0) {
                $slot->update(['is_booked' => true]);
                $booking = ManagementSessionBooking::create([
                    'slot_id'        => $slot->id,
                    'name'           => $validated['name'],
                    'email'          => $validated['email'],
                    'phone'          => $validated['phone'],
                    'event_type'     => $validated['event_type'],
                    'event_date'     => $validated['event_date'],
                    'message'        => $validated['message'] ?? null,
                    'status'         => 'pending',
                    'payment_status' => 'paid', // Mark as paid since it's free
                    'amount_paid'    => 0,
                ]);

                // Call the confirmation helper (generates Meet link & emails)
                $this->confirmManagementBooking($booking, 'free_session', 0);
                
                return redirect()->route('management-session.confirmation', ['code' => $booking->confirmation_code]);
            }

            // Lock the slot immediately
            $slot->update(['is_booked' => true]);

            $booking = ManagementSessionBooking::create([
                'slot_id'        => $slot->id,
                'name'           => $validated['name'],
                'email'          => $validated['email'],
                'phone'          => $validated['phone'],
                'event_type'     => $validated['event_type'],
                'event_date'     => $validated['event_date'],
                'message'        => $validated['message'] ?? null,
                'status'         => 'pending',
                'payment_status' => 'unpaid',
            ]);

            try {
                $sessionName = \App\Models\ManagementSessionSettings::getSettings()->name ?? 'Management Session';

                $checkoutSession = StripeSession::create([
                    'line_items' => [[
                        'price_data' => [
                            'currency'     => 'usd',
                            'unit_amount'  => (int) round($slot->price * 100),
                            'product_data' => [
                                'name'        => $sessionName . ' — ' . $slot->duration . ' min',
                                'description' => $slot->formatted_date . ' at ' . $slot->formatted_time,
                            ],
                        ],
                        'quantity' => 1,
                    ]],
                    'mode'             => 'payment',
                    'adaptive_pricing' => [
                        'enabled' => true,
                    ],
                    'customer_email'   => $booking->email,
                    'expires_at'       => time() + 1800, // Expire in 30 mins (minimum allowed by Stripe) if user abandons
                    'success_url'      => route('management-session.payment.success', ['code' => $booking->confirmation_code]) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url'       => route('management-session.payment.cancel', ['code' => $booking->confirmation_code]),
                    'metadata'         => [
                        'booking_type'      => 'management',
                        'booking_id'        => $booking->id,
                        'confirmation_code' => $booking->confirmation_code,
                    ],
                ]);

                $booking->update(['stripe_session_id' => $checkoutSession->id]);

                // Store in session so we can clean it up if they abandon it and go back
                session()->put('pending_management_booking_id', $booking->id);

                return redirect($checkoutSession->url);

            } catch (\Exception $e) {
                Log::error('Stripe Checkout (Management) error: ' . $e->getMessage());
                $slot->update(['is_booked' => false]);
                $booking->delete();
                return back()->with('error', 'Payment initialisation failed. Please try again.');
            }
        });
    }

    public function successManagement(Request $request, $code)
    {
        $booking = ManagementSessionBooking::with('slot')
            ->where('confirmation_code', $code)
            ->firstOrFail();

        if ($booking->payment_status === 'paid') {
            return redirect()->route('management-session.confirmation', ['code' => $code]);
        }

        try {
            $sessionId = $request->get('session_id');
            if ($sessionId && $booking->stripe_session_id === $sessionId) {
                $stripeSession = StripeSession::retrieve($sessionId);

                if ($stripeSession->payment_status === 'paid') {
                    $this->confirmManagementBooking($booking, $stripeSession->payment_intent, $stripeSession->amount_total);
                }
            }
        } catch (\Exception $e) {
            Log::error('Stripe success (Management) verification error: ' . $e->getMessage());
        }

        return redirect()->route('management-session.confirmation', ['code' => $code]);
    }

    public function cancelManagement($code)
    {
        $booking = ManagementSessionBooking::where('confirmation_code', $code)->first();

        if ($booking && $booking->payment_status === 'unpaid') {
            if ($booking->slot) {
                $booking->slot->update(['is_booked' => false]);
            }
            $booking->delete(); // Delete the booking completely
        }

        return redirect()->route('management-session')->with('error', 'Payment was cancelled. Please try again.');
    }

    // ---------------------------------------------------------------
    // WEBHOOK — safety net for both session types
    // ---------------------------------------------------------------

    public function webhook(Request $request)
    {
        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret    = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (SignatureVerificationException $e) {
            Log::warning('Stripe webhook signature verification failed.');
            return response('Invalid signature', 400);
        } catch (\Exception $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage());
            return response('Webhook error', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $stripeSession = $event->data->object;

            if ($stripeSession->payment_status !== 'paid') {
                return response('', 200);
            }

            $type = $stripeSession->metadata->booking_type ?? null;
            $code = $stripeSession->metadata->confirmation_code ?? null;

            if (!$code) {
                return response('', 200);
            }

            if ($type === 'counseling') {
                $booking = CounselingBooking::where('confirmation_code', $code)->first();
                if ($booking && $booking->payment_status !== 'paid') {
                    $this->confirmCounselingBooking($booking, $stripeSession->payment_intent, $stripeSession->amount_total);
                }
            } elseif ($type === 'management') {
                $booking = ManagementSessionBooking::where('confirmation_code', $code)->first();
                if ($booking && $booking->payment_status !== 'paid') {
                    $this->confirmManagementBooking($booking, $stripeSession->payment_intent, $stripeSession->amount_total);
                }
            }
        }

        if ($event->type === 'checkout.session.expired') {
            $stripeSession = $event->data->object;
            $type = $stripeSession->metadata->booking_type ?? null;
            $code = $stripeSession->metadata->confirmation_code ?? null;

            if (!$code) return response('', 200);

            if ($type === 'counseling') {
                $booking = CounselingBooking::where('confirmation_code', $code)->first();
                if ($booking && $booking->payment_status === 'unpaid') {
                    if ($booking->slot) {
                        $booking->slot->update(['is_booked' => false]);
                    }
                    $booking->delete();
                }
            } elseif ($type === 'management') {
                $booking = ManagementSessionBooking::where('confirmation_code', $code)->first();
                if ($booking && $booking->payment_status === 'unpaid') {
                    if ($booking->slot) {
                        $booking->slot->update(['is_booked' => false]);
                    }
                    $booking->delete();
                }
            }
        }

        return response('', 200);
    }

    // ---------------------------------------------------------------
    // PRIVATE HELPERS
    // ---------------------------------------------------------------

    private function confirmCounselingBooking(CounselingBooking $booking, $paymentIntentId, $amountTotal)
    {
        // 1) Generate Google Meet Link First
        try {
            if ($booking->slot) {
                $calendarService = new GoogleCalendarService();
                $startDateTime = Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->start_time);
                $endDateTime = Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->end_time);
                
                $meeting = $calendarService->createEventWithMeetLink(
                    'Coaching Session: ' . $booking->name,
                    "Client Name: {$booking->name}\nEmail: {$booking->email}\nPhone: {$booking->phone}\nNotes: {$booking->message}",
                    $startDateTime,
                    $endDateTime,
                    $booking->email
                );

                if (!empty($meeting['meet_link'])) {
                    $booking->meet_link = $meeting['meet_link'];
                    $booking->google_event_id = $meeting['event_id'];
                }
            }
        } catch (\Exception $e) {
            Log::error('Google Calendar Meet Link generation error (Counseling): ' . $e->getMessage());
        }

        // 2) Update Booking Record
        $booking->status = 'confirmed';
        $booking->payment_status = 'paid';
        $booking->stripe_payment_intent_id = $paymentIntentId;
        $booking->amount_paid = $amountTotal / 100;
        $booking->save();

        // 3) Send Emails
        try {
            $adminEmail = SiteSetting::current()->admin_email;
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new CoachingBookingMail($booking));
            }
            if ($booking->email) {
                Mail::to($booking->email)->send(new CoachingBookingUserConfirmation($booking));
            }
        } catch (\Exception $e) {
            Log::error('Counseling confirmation email error: ' . $e->getMessage());
        }
    }

    private function confirmManagementBooking(ManagementSessionBooking $booking, $paymentIntentId, $amountTotal)
    {
        // 1) Generate Google Meet Link First
        try {
            if ($booking->slot) {
                $calendarService = new GoogleCalendarService();
                $startDateTime = Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->start_time);
                $endDateTime = Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->end_time);
                
                $meeting = $calendarService->createEventWithMeetLink(
                    'Management Session: ' . $booking->name . ' - ' . $booking->event_type,
                    "Client Name: {$booking->name}\nEmail: {$booking->email}\nPhone: {$booking->phone}\nEvent Type: {$booking->event_type}\nEvent Date: {$booking->event_date}\nNotes: {$booking->message}",
                    $startDateTime,
                    $endDateTime,
                    $booking->email
                );

                if (!empty($meeting['meet_link'])) {
                    $booking->meet_link = $meeting['meet_link'];
                    $booking->google_event_id = $meeting['event_id'];
                }
            }
        } catch (\Exception $e) {
            Log::error('Google Calendar Meet Link generation error (Management): ' . $e->getMessage());
        }

        // 2) Update Booking Record
        $booking->status = 'confirmed';
        $booking->payment_status = 'paid';
        $booking->stripe_payment_intent_id = $paymentIntentId;
        $booking->amount_paid = $amountTotal / 100;
        $booking->save();

        // 3) Send Emails
        try {
            $adminEmail = SiteSetting::current()->admin_email;
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new ManagementSessionBookingMail($booking));
            }
            if ($booking->email) {
                Mail::to($booking->email)->send(new ManagementSessionBookingUserConfirmation($booking));
            }
        } catch (\Exception $e) {
            Log::error('Management confirmation email error: ' . $e->getMessage());
        }
    }
}
