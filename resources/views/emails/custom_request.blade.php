@extends('emails.layout')

@section('content')
    <h2>New Custom Package Request</h2>
    <p>You have received a new custom package request from the website:</p>

    <table class="details-table">
        <tr>
            <td class="label">Event Type:</td>
            <td class="value">{{ ucfirst($request->event_type) }}</td>
        </tr>
        <tr>
            <td class="label">Customer Name:</td>
            <td class="value">{{ $request->name }}</td>
        </tr>
        <tr>
            <td class="label">Email Address:</td>
            <td class="value">{{ $request->email }}</td>
        </tr>
        <tr>
            <td class="label">Phone Number:</td>
            <td class="value">{{ $request->phone }}</td>
        </tr>
        <tr>
            <td class="label">Event Date:</td>
            <td class="value">{{ $request->event_date ? (is_string($request->event_date) ? $request->event_date : $request->event_date->format('Y-m-d')) : 'Not specified' }}</td>
        </tr>
        <tr>
            <td class="label">Guest Count:</td>
            <td class="value">{{ $request->guest_count ?? 'Not specified' }}</td>
        </tr>
        <tr>
            <td class="label">Budget:</td>
            <td class="value highlight">{{ $request->budget ? '$'.number_format($request->budget, 2) : 'Not specified' }}</td>
        </tr>
        <tr>
            <td class="label">Venue:</td>
            <td class="value">{{ $request->venue ?? 'Not specified' }}</td>
        </tr>
        @if($request->requirements)
        <tr>
            <td class="label">Requirements:</td>
            <td class="value">{{ $request->requirements }}</td>
        </tr>
        @endif
    </table>

    <div class="button-container">
        <a href="{{ route('admin.custom-requests.index') }}" class="button">View Requests</a>
    </div>

    <p style="margin-top: 30px; font-size: 14px; color: #666;">
        Please login to the admin panel to manage this request.
    </p>
@endsection
