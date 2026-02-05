@extends('emails.layout')

@section('content')
<h2 style="color: #333; margin-bottom: 20px;">New Contact Form Submission</h2>

<p style="color: #666; margin-bottom: 20px;">You have received a new contact form submission from your website.</p>

<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <tr>
        <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #333; width: 150px;">Name:</td>
        <td style="padding: 10px; border-bottom: 1px solid #eee; color: #666;">{{ $submission->name }}</td>
    </tr>
    <tr>
        <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #333;">Email:</td>
        <td style="padding: 10px; border-bottom: 1px solid #eee; color: #666;">
            <a href="mailto:{{ $submission->email }}" style="color: #d4af37; text-decoration: none;">{{ $submission->email }}</a>
        </td>
    </tr>
    <tr>
        <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #333;">Phone:</td>
        <td style="padding: 10px; border-bottom: 1px solid #eee; color: #666;">
            <a href="tel:{{ $submission->phone }}" style="color: #d4af37; text-decoration: none;">{{ $submission->phone }}</a>
        </td>
    </tr>
    <tr>
        <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #333;">Event Type:</td>
        <td style="padding: 10px; border-bottom: 1px solid #eee; color: #666;">{{ ucfirst($submission->event_type) }}</td>
    </tr>
    @if($submission->preferred_date)
    <tr>
        <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #333;">Preferred Date:</td>
        <td style="padding: 10px; border-bottom: 1px solid #eee; color: #666;">{{ $submission->preferred_date->format('F d, Y') }}</td>
    </tr>
    @endif
    <tr>
        <td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color: #333; vertical-align: top;">Message:</td>
        <td style="padding: 10px; border-bottom: 1px solid #eee; color: #666;">{{ $submission->message }}</td>
    </tr>
    <tr>
        <td style="padding: 10px; font-weight: bold; color: #333;">Submitted At:</td>
        <td style="padding: 10px; color: #666;">{{ $submission->created_at->format('F d, Y h:i A') }}</td>
    </tr>
</table>

<div style="text-align: center; margin-top: 30px;">
    <a href="{{ route('admin.contact-submissions.index') }}" 
       style="display: inline-block; padding: 12px 30px; background-color: #d4af37; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
        View in Dashboard
    </a>
</div>

<p style="color: #999; font-size: 12px; margin-top: 30px; text-align: center;">
    This is an automated notification from your website's contact form.
</p>
@endsection
