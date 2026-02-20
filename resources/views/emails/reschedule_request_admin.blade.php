@extends('emails.layout')

@section('content')
    <h2>Reschedule Request Received</h2>
    <p>A client has requested to reschedule their session. Please review and take action in the admin panel.</p>

    <table class="details-table">
        <tr>
            <td class="label">Client Name:</td>
            <td class="value">{{ $booking->name }}</td>
        </tr>
        <tr>
            <td class="label">Email:</td>
            <td class="value">{{ $booking->email }}</td>
        </tr>
        <tr>
            <td class="label">Booking Code:</td>
            <td class="value"><code>{{ $booking->confirmation_code }}</code></td>
        </tr>
        <tr>
            <td class="label">Session Type:</td>
            <td class="value">{{ $rescheduleRequest->booking_type === 'counseling' ? 'Coaching Session' : 'Management Session' }}</td>
        </tr>
        <tr>
            <td class="label">Current Slot:</td>
            <td class="value">
                {{ \Carbon\Carbon::parse($currentSlot->date)->format('l, F j, Y') }}
                at {{ \Carbon\Carbon::parse($currentSlot->start_time)->format('g:i A') }}
            </td>
        </tr>
        <tr>
            <td class="label">Requested New Slot:</td>
            <td class="value highlight">
                {{ \Carbon\Carbon::parse($requestedSlot->date)->format('l, F j, Y') }}
                at {{ \Carbon\Carbon::parse($requestedSlot->start_time)->format('g:i A') }}
            </td>
        </tr>
        @if($rescheduleRequest->reason)
        <tr>
            <td class="label">Reason:</td>
            <td class="value">{{ $rescheduleRequest->reason }}</td>
        </tr>
        @endif
    </table>

    <div class="button-container">
        <a href="{{ route('admin.reschedule-requests.index') }}" class="button">Review Request</a>
    </div>
@endsection
