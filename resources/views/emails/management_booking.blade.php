@extends('emails.layout')

@section('content')
    <h2>New Management Session Booking</h2>
    <p>A new session with management has been booked. Here are the details:</p>

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
            <td class="label">Event Type:</td>
            <td class="value">{{ $booking->event_type }}</td>
        </tr>
        @if($booking->event_date)
        <tr>
            <td class="label">Requested Event Date:</td>
            <td class="value">{{ \Carbon\Carbon::parse($booking->event_date)->format('F j, Y') }}</td>
        </tr>
        @endif
        <tr>
            <td class="label">Session Date:</td>
            <td class="value">{{ \Carbon\Carbon::parse($booking->slot->date)->format('l, F j, Y') }}</td>
        </tr>
        <tr>
            <td class="label">Session Time:</td>
            <td class="value">{{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('g:i A') }} ({{ $booking->slot->duration }} mins)</td>
        </tr>
        <tr>
            <td class="label">Price:</td>
            <td class="value highlight">{{ $booking->slot->price ? '$' . number_format($booking->slot->price, 2) : 'Free' }}</td>
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
        <a href="{{ route('admin.management-session.bookings') }}" class="button">Manage Bookings</a>
    </div>

    <p style="margin-top: 30px; font-size: 14px; color: #666;">
        Please review the booking in the admin panel and take necessary actions.
    </p>
@endsection
