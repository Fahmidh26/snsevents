@extends('emails.layout')

@section('content')
    <h2>New Package Inquiry</h2>
    <p>You have received a new inquiry from the website:</p>

    <table class="details-table">
        <tr>
            <td class="label">Event Type:</td>
            <td class="value">{{ ucfirst($inquiry->event_type) }}</td>
        </tr>
        @if($inquiry->pricingTier)
        <tr>
            <td class="label">Package:</td>
            <td class="value">{{ $inquiry->pricingTier->tier_name }} Package</td>
        </tr>
        @endif
        <tr>
            <td class="label">Customer Name:</td>
            <td class="value">{{ $inquiry->name }}</td>
        </tr>
        <tr>
            <td class="label">Email Address:</td>
            <td class="value">{{ $inquiry->email }}</td>
        </tr>
        <tr>
            <td class="label">Phone Number:</td>
            <td class="value">{{ $inquiry->phone }}</td>
        </tr>
        <tr>
            <td class="label">Event Date:</td>
            <td class="value">{{ $inquiry->event_date }}</td>
        </tr>
        @if($inquiry->message)
        <tr>
            <td class="label">Message:</td>
            <td class="value">{{ $inquiry->message }}</td>
        </tr>
        @endif
    </table>

    <div class="button-container">
        <a href="{{ route('admin.inquiries.index') }}" class="button">View Inquiries</a>
    </div>

    <p style="margin-top: 30px; font-size: 14px; color: #666;">
        Please login to the admin panel to manage this inquiry.
    </p>
@endsection
