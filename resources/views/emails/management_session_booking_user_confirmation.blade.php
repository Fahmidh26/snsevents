@extends('emails.layout')

@section('content')
    <h2>Booking Confirmation</h2>
    <p>Dear {{ $booking->name }},</p>
    <p>Thank you for booking a session with our management. We have received your request and look forward to speaking with you. Here are the details of your session:</p>

    <table class="details-table" style="width: 100%; margin: 20px 0; border-collapse: collapse;">
        <tr>
            <td class="label" style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Session Date:</td>
            <td class="value" style="padding: 10px; border-bottom: 1px solid #eee;">{{ \Carbon\Carbon::parse($booking->slot->date)->format('l, F j, Y') }}</td>
        </tr>
        <tr>
            <td class="label" style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Session Time:</td>
            <td class="value" style="padding: 10px; border-bottom: 1px solid #eee;">{{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('g:i A') }} ({{ $booking->slot->duration }} mins)</td>
        </tr>
        <tr>
            <td class="label" style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Event Type:</td>
            <td class="value" style="padding: 10px; border-bottom: 1px solid #eee;">{{ $booking->event_type }}</td>
        </tr>
        @if($booking->event_date)
        <tr>
            <td class="label" style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Requested Event Date:</td>
            <td class="value" style="padding: 10px; border-bottom: 1px solid #eee;">{{ \Carbon\Carbon::parse($booking->event_date)->format('F j, Y') }}</td>
        </tr>
        @endif
        <tr>
            <td class="label" style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Price:</td>
            <td class="value highlight" style="padding: 10px; border-bottom: 1px solid #eee;">{{ $booking->slot->price ? '$' . number_format($booking->slot->price, 2) : 'Free' }}</td>
        </tr>
        <tr>
            <td class="label" style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Booking Code:</td>
            <td class="value" style="padding: 10px; border-bottom: 1px solid #eee;"><code>{{ $booking->confirmation_code }}</code></td>
        </tr>
    </table>

    <p>If you have any questions or need to reschedule, please contact us at <a href="mailto:{{ \App\Models\SiteSetting::current()->admin_email }}">{{ \App\Models\SiteSetting::current()->admin_email }}</a> quoting your booking code.</p>

    <p style="margin-top: 30px; font-size: 14px; color: #666;">
        Best regards,<br>
        The SNS Events Team
    </p>
@endsection
