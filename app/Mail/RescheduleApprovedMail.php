<?php

namespace App\Mail;

use App\Models\RescheduleRequest;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RescheduleApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rescheduleRequest;
    public $booking;
    public $newSlot;

    public function __construct(RescheduleRequest $rescheduleRequest)
    {
        $this->rescheduleRequest = $rescheduleRequest;
        $this->booking = $rescheduleRequest->booking()->first();
        $this->newSlot = $rescheduleRequest->requestedSlot()->first();
    }

    public function envelope(): Envelope
    {
        $siteTitle = SiteSetting::current()->site_title ?? 'SNS Events';
        return new Envelope(
            subject: "[{$siteTitle}] Your Session Has Been Rescheduled",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.reschedule_approved');
    }

    public function attachments(): array { return []; }
}
