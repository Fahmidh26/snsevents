@extends('emails.layout')

@section('content')
    <h2>Your Session Has Been Rescheduled ✅</h2>
    <p>Great news, {{ $booking->name }}! Your reschedule request has been <strong>approved</strong>. Your session has been moved to the new time below.</p>

    <table class="details-table">
        <tr>
            <td class="label">Booking Code:</td>
            <td class="value"><code>{{ $booking->confirmation_code }}</code></td>
        </tr>
        <tr>
            <td class="label">New Session Date:</td>
            <td class="value highlight">{{ \Carbon\Carbon::parse($newSlot->date)->format('l, F j, Y') }}</td>
        </tr>
        <tr>
            <td class="label">New Session Time:</td>
            <td class="value highlight">
                {{ \Carbon\Carbon::parse($newSlot->start_time)->format('g:i A') }} –
                {{ \Carbon\Carbon::parse($newSlot->end_time)->format('g:i A') }}
                ({{ $newSlot->duration }} mins)
            </td>
        </tr>
        @if($rescheduleRequest->admin_note)
        <tr>
            <td class="label">Note from Admin:</td>
            <td class="value">{{ $rescheduleRequest->admin_note }}</td>
        </tr>
        @endif
    </table>

    <p style="margin-top: 20px; font-size: 14px; color: #666;">
        Please be ready 5 minutes before your scheduled time. If you have any questions, don't hesitate to contact us.
    </p>
@endsection
