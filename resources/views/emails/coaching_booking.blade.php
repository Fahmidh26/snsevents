@extends('emails.layout')

@section('content')
    <h2>New Coaching Session Booking</h2>
    <p>A new coaching session has been booked through the website. Here are the details:</p>

    <table class="details-table">
        <tr>
            <td class="label">Customer Name:</td>
            <td class="value">{{ $booking->name }}</td>
        </tr>
        <tr>
            <td class="label">Email Address:</td>
            <td class="value">{{ $booking->email }}</td>
        </tr>
        <tr>
            <td class="label">Phone Number:</td>
            <td class="value">{{ $booking->phone }}</td>
        </tr>
        <tr>
            <td class="label">Session Date:</td>
            <td class="value">{{ \Carbon\Carbon::parse($booking->slot->date)->format('l, F j, Y') }}</td>
        </tr>
        <tr>
            <td class="label">Session Time/Timezone:</td>
            <td class="value">{{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('g:i A') }} (CST, UTC-6)</td>
        </tr>
        <tr>
            <td class="label">Google Meet Link:</td>
            <td class="value highlight">
                @if($booking->meet_link)
                    <a href="{{ $booking->meet_link }}">{{ $booking->meet_link }}</a>
                @else
                    <i>Not Generated</i>
                @endif
            </td>
        </tr>
        <tr>
            <td class="label">Amount Paid:</td>
            <td class="value highlight">${{ number_format($booking->amount_paid ?: $booking->slot->price, 2) }}</td>
        </tr>
        @if($booking->message)
        <tr>
            <td class="label">Message:</td>
            <td class="value">{{ $booking->message }}</td>
        </tr>
        @endif
        <tr>
            <td class="label">Booking Code:</td>
            <td class="value"><code>{{ $booking->confirmation_code }}</code></td>
        </tr>
    </table>

    <div class="button-container">
        <a href="{{ route('admin.counseling.bookings') }}" class="button">Manage Bookings</a>
    </div>

    <p style="margin-top: 30px; font-size: 14px; color: #666;">
        Please review the booking in the admin panel and take necessary actions.
    </p>
@endsection
