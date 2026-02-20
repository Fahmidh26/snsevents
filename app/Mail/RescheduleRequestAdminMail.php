<?php

namespace App\Mail;

use App\Models\RescheduleRequest;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RescheduleRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rescheduleRequest;
    public $booking;
    public $currentSlot;
    public $requestedSlot;

    public function __construct(RescheduleRequest $rescheduleRequest)
    {
        $this->rescheduleRequest = $rescheduleRequest;
        $this->booking = $rescheduleRequest->booking()->first();
        $this->currentSlot = $this->booking->slot;
        $this->requestedSlot = $rescheduleRequest->requestedSlot()->first();
    }

    public function envelope(): Envelope
    {
        $siteTitle = SiteSetting::current()->site_title ?? 'SNS Events';
        return new Envelope(
            subject: "[{$siteTitle}] Reschedule Request — {$this->booking->name}",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.reschedule_request_admin');
    }

    public function attachments(): array { return []; }
}
