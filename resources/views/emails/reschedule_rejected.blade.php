@extends('emails.layout')

@section('content')
    <h2>Reschedule Request Update</h2>
    <p>Hi {{ $booking->name }}, unfortunately your reschedule request could not be approved at this time.</p>

    <table class="details-table">
        <tr>
            <td class="label">Booking Code:</td>
            <td class="value"><code>{{ $booking->confirmation_code }}</code></td>
        </tr>
        <tr>
            <td class="label">Your Original Session:</td>
            <td class="value">
                {{ \Carbon\Carbon::parse($booking->slot->date)->format('l, F j, Y') }}
                at {{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }}
            </td>
        </tr>
        @if($rescheduleRequest->admin_note)
        <tr>
            <td class="label">Reason:</td>
            <td class="value">{{ $rescheduleRequest->admin_note }}</td>
        </tr>
        @endif
    </table>

    <p style="margin-top: 20px; font-size: 14px; color: #666;">
        Your original booking remains confirmed. If you need further assistance, please contact us directly.
    </p>
@endsection
