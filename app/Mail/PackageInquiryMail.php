<?php

namespace App\Mail;

use App\Models\PackageInquiry;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PackageInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;

    /**
     * Create a new message instance.
     */
    public function __construct(PackageInquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $siteTitle = SiteSetting::current()->site_title ?? 'SNS Events';
        $eventName = $this->inquiry->eventType ? $this->inquiry->eventType->name : ($this->inquiry->pricingTier ? $this->inquiry->pricingTier->tier_name : 'Unknown');
        return new Envelope(
            subject: "[{$siteTitle}] New Package Inquiry - {$eventName}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.package_inquiry',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
