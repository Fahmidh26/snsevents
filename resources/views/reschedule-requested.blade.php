@extends('layouts.frontend')

@php
    $sessionLabel = $type === 'counseling' ? 'Coaching Session' : 'Management Session';
    $confirmationRoute = $type === 'counseling'
        ? route('counseling.confirmation', ['code' => $booking->confirmation_code])
        : route('management-session.confirmation', ['code' => $booking->confirmation_code]);
@endphp

@section('title', 'Reschedule Requested — ' . $sessionLabel)

@section('styles')
<style>
    .navbar { background: rgba(26, 26, 26, 0.95) !important; backdrop-filter: blur(10px) !important; }

    .rr-hero {
        padding: 160px 0 80px;
        background: linear-gradient(135deg, rgba(15,5,40,0.88) 0%, rgba(79,70,229,0.7) 100%),
                    url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #fff;
        text-align: center;
    }
    .rr-hero h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #fff 0%, #a78bfa 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .rr-hero p { font-size: 1.1rem; color: rgba(255,255,255,0.8); margin: 0; }

    .rr-section { padding: 80px 0 100px; background: var(--light-bg); }

    .rr-card {
        background: white;
        border-radius: 28px;
        padding: 60px 50px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.1);
        max-width: 700px;
        margin: -60px auto 0;
        position: relative;
        z-index: 10;
        text-align: center;
    }

    /* Animated icon */
    .pending-icon {
        width: 110px;
        height: 110px;
        background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: scaleIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        box-shadow: 0 15px 40px rgba(124, 58, 237, 0.35);
    }
    @keyframes scaleIn {
        0%   { transform: scale(0) rotate(-180deg); opacity: 0; }
        50%  { transform: scale(1.1) rotate(0deg); }
        100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }
    .pending-icon i { font-size: 3rem; color: #fff; }

    .rr-card h2 { font-size: 2rem; color: var(--secondary-color); margin-bottom: 12px; }
    .rr-card p.subtitle { color: var(--text-light); font-size: 1.1rem; margin-bottom: 35px; line-height: 1.7; }

    /* Status badge */
    .status-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ede9fe;
        color: #6d28d9;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 35px;
    }

    /* Booking ref box */
    .ref-box {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #2d2d2d 100%);
        color: #fff;
        padding: 22px 40px;
        border-radius: 16px;
        display: inline-block;
        margin-bottom: 35px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    .ref-box span { font-size: 0.8rem; color: rgba(255,255,255,0.65); display: block; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 2px; }
    .ref-box strong { font-size: 1.8rem; font-family: 'Monaco', 'Courier New', monospace; color: var(--primary-color); letter-spacing: 4px; }

    /* Details grid */
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; text-align: left; margin-bottom: 28px; }
    .detail-section { background: var(--light-bg); border-radius: 16px; padding: 28px; margin-bottom: 28px; text-align: left; }
    .detail-section h4 { font-size: 1rem; color: var(--secondary-color); margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid var(--primary-color); display: flex; align-items: center; gap: 8px; }
    .d-item { background: white; padding: 14px; border-radius: 10px; }
    .d-item .label { font-size: 0.72rem; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
    .d-item .value { font-size: 0.95rem; color: var(--secondary-color); font-weight: 600; }

    /* Requested slot highlight */
    .requested-slot-box {
        background: linear-gradient(135deg, rgba(124,58,237,0.07) 0%, rgba(79,70,229,0.07) 100%);
        border: 2px solid rgba(124,58,237,0.25);
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 28px;
        text-align: left;
    }
    .requested-slot-box h4 { color: #6d28d9; font-size: 1rem; margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }

    /* Timeline / what's next */
    .timeline { text-align: left; margin-bottom: 28px; }
    .timeline h4 { font-size: 1rem; color: var(--secondary-color); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    .timeline ul { list-style: none; margin: 0; padding: 0; }
    .timeline li { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 12px; color: var(--text-light); font-size: 0.92rem; line-height: 1.6; }
    .timeline li i { color: #7c3aed; margin-top: 3px; min-width: 16px; }

    .btn-view-booking {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
        color: #fff;
        padding: 15px 38px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 8px;
        margin-right: 12px;
        font-size: 0.95rem;
    }
    .btn-view-booking:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(124,58,237,0.4); color: #fff; }

    .btn-home-outline {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--secondary-color);
        padding: 13px 36px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 8px;
        font-size: 0.95rem;
    }
    .btn-home-outline:hover { background: var(--primary-color); color: var(--secondary-color); transform: translateY(-2px); }

    @media (max-width: 768px) {
        .rr-card { padding: 40px 22px; margin-top: -40px; border-radius: 20px; }
        .rr-hero h1 { font-size: 2rem; }
        .ref-box strong { font-size: 1.4rem; letter-spacing: 2px; }
        .detail-grid { grid-template-columns: 1fr 1fr; }
        .btn-view-booking, .btn-home-outline { width: 100%; justify-content: center; margin-right: 0; }
    }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="rr-hero">
    <div class="container">
        <h1 data-aos="fade-up"><i class="fas fa-calendar-alt" style="margin-right:12px;"></i>Reschedule Requested!</h1>
        <p>Your request has been received and is under review.</p>
    </div>
</section>

{{-- Main Card --}}
<section class="rr-section">
    <div class="container">
        <div class="rr-card" data-aos="fade-up">

            {{-- Icon --}}
            <div class="pending-icon">
                <i class="fas fa-clock"></i>
            </div>

            <h2>Request Submitted, {{ explode(' ', $booking->name)[0] }}!</h2>
            <p class="subtitle">
                Your reschedule request for your <strong>{{ $sessionLabel }}</strong> has been submitted.<br>
                Our team will review it and get back to you as soon as possible.
            </p>

            {{-- Status chip --}}
            <div class="status-chip">
                <i class="fas fa-hourglass-half"></i> Pending Admin Review
            </div>

            {{-- Booking ref --}}
            <div class="ref-box">
                <span>Booking Reference</span>
                <strong>{{ $booking->confirmation_code }}</strong>
            </div>

            {{-- Current booking details --}}
            <div class="detail-section">
                <h4><i class="fas fa-bookmark" style="color:var(--primary-color);"></i> Current Booking</h4>
                <div class="detail-grid">
                    <div class="d-item">
                        <div class="label">Name</div>
                        <div class="value">{{ $booking->name }}</div>
                    </div>
                    <div class="d-item">
                        <div class="label">Email</div>
                        <div class="value" style="word-break:break-all;">{{ $booking->email }}</div>
                    </div>
                    <div class="d-item">
                        <div class="label">Current Date</div>
                        <div class="value">{{ $booking->slot->date->format('M j, Y') }}</div>
                    </div>
                    <div class="d-item">
                        <div class="label">Current Time (CST)</div>
                        <div class="value">{{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }}</div>
                    </div>
                    <div class="d-item">
                        <div class="label">Duration</div>
                        <div class="value">{{ $booking->slot->duration }} mins</div>
                    </div>
                    <div class="d-item">
                        <div class="label">Session Type</div>
                        <div class="value">{{ $sessionLabel }}</div>
                    </div>
                </div>
            </div>

            {{-- Requested new slot --}}
            <div class="requested-slot-box">
                <h4><i class="fas fa-calendar-check"></i> Requested New Slot</h4>
                <div class="detail-grid">
                    <div class="d-item">
                        <div class="label">Requested Date</div>
                        <div class="value">{{ $requestedSlot->date->format('M j, Y') }}</div>
                    </div>
                    <div class="d-item">
                        <div class="label">Requested Time (CST)</div>
                        <div class="value">{{ \Carbon\Carbon::parse($requestedSlot->start_time)->format('g:i A') }}</div>
                    </div>
                </div>
                @if($reason)
                    <div class="d-item" style="margin-top:12px;">
                        <div class="label">Your Reason</div>
                        <div class="value" style="font-weight:400; color: var(--text-light);">{{ $reason }}</div>
                    </div>
                @endif
            </div>

            {{-- What happens next --}}
            <div class="timeline">
                <h4><i class="fas fa-lightbulb" style="color:var(--primary-color);"></i> What Happens Next?</h4>
                <ul>
                    <li><i class="fas fa-envelope"></i> You'll receive a confirmation email at <strong>{{ $booking->email }}</strong> with your request details.</li>
                    <li><i class="fas fa-user-check"></i> Our admin will review your request and check availability of the new slot.</li>
                    <li><i class="fas fa-bell"></i> You'll be notified by email once your request is approved or declined.</li>
                    <li><i class="fas fa-calendar-alt"></i> If approved, your booking will be updated and a new confirmation will be sent.</li>
                </ul>
            </div>

            {{-- Actions --}}
            <div>
                <a href="{{ $confirmationRoute }}" class="btn-view-booking">
                    <i class="fas fa-receipt"></i> View My Booking
                </a>
                <a href="{{ url('/') }}" class="btn-home-outline">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>

        </div>
    </div>
</section>

@endsection
