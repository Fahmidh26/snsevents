<?php

namespace App\Mail;

use App\Models\RescheduleRequest;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RescheduleRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rescheduleRequest;
    public $booking;

    public function __construct(RescheduleRequest $rescheduleRequest)
    {
        $this->rescheduleRequest = $rescheduleRequest;
        $this->booking = $rescheduleRequest->booking()->first();
    }

    public function envelope(): Envelope
    {
        $siteTitle = SiteSetting::current()->site_title ?? 'SNS Events';
        return new Envelope(
            subject: "[{$siteTitle}] Reschedule Request Update",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.reschedule_rejected');
    }

    public function attachments(): array { return []; }
}
