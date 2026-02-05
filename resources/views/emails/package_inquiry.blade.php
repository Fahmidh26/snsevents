@extends('emails.layout')

@section('content')
    <div style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; margin-bottom: 30px; border-left: 4px solid #c9a227;">
        <h2 style="margin: 0; color: #0f0f0f;">New Package Inquiry</h2>
        <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">Reference ID: <strong style="color: #c9a227;">#PI-{{ str_pad($inquiry->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
    </div>
    <p>You have received a new inquiry for one of your event packages. Here are the customer's details:</p>

    <table class="details-table">
        <tr>
            <td class="label">Event Type:</td>
            <td class="value">{{ $inquiry->eventType ? $inquiry->eventType->name : ($inquiry->pricingTier ? $inquiry->pricingTier->eventType->name : 'N/A') }}</td>
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
            <td class="value">{{ $inquiry->event_date ? $inquiry->event_date->format('F j, Y') : 'Not specified' }}</td>
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
