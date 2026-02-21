@extends('layouts.frontend')

@section('title', 'Booking Confirmed - SNS Events')

@section('styles')
<style>
    /* Override navbar for this page to be always visible */
    .navbar { background: rgba(26, 26, 26, 0.95) !important; backdrop-filter: blur(10px) !important; }
    .confirmation-hero { padding: 160px 0 80px; background: linear-gradient(135deg, rgba(26, 26, 26, 0.92) 0%, rgba(45, 45, 45, 0.88) 100%), url('{{ $settings->hero_image ? Storage::url($settings->hero_image) : "https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" }}'); background-size: cover; background-position: center; color: #fff; text-align: center; }
    .confirmation-hero h1 { font-size: 3rem; font-weight: 700; margin-bottom: 15px; background: linear-gradient(135deg, #fff 0%, #48bb78 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .confirmation-section { padding: 80px 0 100px; background: var(--light-bg); }
    .confirmation-card { background: white; border-radius: 28px; padding: 60px; box-shadow: 0 30px 80px rgba(0, 0, 0, 0.1); max-width: 700px; margin: -60px auto 0; position: relative; z-index: 10; text-align: center; }
    .success-icon { width: 110px; height: 110px; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; animation: scaleIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55); box-shadow: 0 15px 40px rgba(72, 187, 120, 0.35); }
    @keyframes scaleIn { 0% { transform: scale(0) rotate(-180deg); opacity: 0; } 50% { transform: scale(1.1) rotate(0deg); } 100% { transform: scale(1) rotate(0deg); opacity: 1; } }
    .success-icon i { font-size: 3.5rem; color: #fff; }
    .confirmation-card h2 { font-size: 2.2rem; color: var(--secondary-color); margin-bottom: 15px; }
    .confirmation-card p.subtitle { color: var(--text-light); font-size: 1.15rem; margin-bottom: 35px; }
    .confirmation-code { background: linear-gradient(135deg, var(--secondary-color) 0%, #2d2d2d 100%); color: #fff; padding: 25px 45px; border-radius: 16px; display: inline-block; margin-bottom: 40px; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); }
    .confirmation-code span { font-size: 0.85rem; color: rgba(255, 255, 255, 0.7); display: block; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 2px; }
    .confirmation-code strong { font-size: 2rem; font-family: 'Monaco', 'Courier New', monospace; color: var(--primary-color); letter-spacing: 4px; }
    .booking-details { background: var(--light-bg); border-radius: 16px; padding: 30px; margin-bottom: 30px; text-align: left; }
    .booking-details h4 { font-size: 1.1rem; color: var(--secondary-color); margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid var(--primary-color); display: flex; align-items: center; gap: 10px; }
    .booking-details h4 i { color: var(--primary-color); }
    .details-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
    .detail-item { background: white; padding: 15px; border-radius: 10px; text-align: center; }
    .detail-item .label { font-size: 0.75rem; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
    .detail-item .value { font-size: 1rem; color: var(--secondary-color); font-weight: 600; }
    .detail-item .value.price { color: var(--primary-color); }
    .status-badge { display: inline-block; padding: 8px 20px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
    .status-pending { background: #fef3c7; color: #d97706; }
    .status-confirmed { background: #d1fae5; color: #059669; }
    .next-steps { background: linear-gradient(135deg, rgba(212, 175, 55, 0.08) 0%, rgba(201, 169, 97, 0.08) 100%); border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 16px; padding: 28px; margin-bottom: 30px; text-align: left; }
    .next-steps h4 { color: var(--secondary-color); font-size: 1.1rem; margin-bottom: 18px; display: flex; align-items: center; gap: 10px; }
    .next-steps h4 i { color: var(--primary-color); font-size: 1.2rem; }
    .next-steps ul { margin: 0; padding: 0; list-style: none; }
    .next-steps li { margin-bottom: 12px; line-height: 1.7; color: var(--text-light); display: flex; align-items: flex-start; gap: 12px; }
    .next-steps li i { color: #48bb78; margin-top: 5px; }
    .contact-info { padding: 25px; background: var(--secondary-color); border-radius: 16px; color: #fff; }
    .contact-info h4 { color: #fff; margin-bottom: 15px; font-size: 1rem; display: flex; align-items: center; gap: 10px; }
    .contact-info p { margin: 10px 0; color: rgba(255, 255, 255, 0.8); }
    .contact-info a { color: var(--primary-color); text-decoration: none; transition: all 0.3s ease; }
    .contact-info a:hover { color: #fff; }
    .btn-home { display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); color: #fff; padding: 16px 40px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; margin-top: 25px; font-size: 1rem; }
    .btn-home:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(212, 175, 55, 0.4); color: #fff; }
    @media (max-width: 768px) { .confirmation-card { padding: 40px 25px; margin-top: -40px; border-radius: 20px; } .confirmation-hero h1 { font-size: 2rem; } .confirmation-code strong { font-size: 1.5rem; letter-spacing: 2px; } .details-grid { grid-template-columns: 1fr 1fr; } }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="confirmation-hero">
    <div class="container">
        <h1 data-aos="fade-up">Booking Confirmed!</h1>
    </div>
</section>

<!-- Confirmation Section -->
<section class="confirmation-section">
    <div class="container">
        <div class="confirmation-card" data-aos="fade-up">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            
            <h2>Thank You, {{ $booking->name }}!</h2>
            <p class="subtitle">Your payment was successful. Your management session has been confirmed.</p>

            {{-- Payment Badge --}}
            @if($booking->payment_status === 'paid')
            <div style="display:inline-flex;align-items:center;gap:8px;background:#d1fae5;color:#059669;padding:10px 24px;border-radius:50px;margin-bottom:20px;font-weight:600;font-size:0.9rem;">
                <i class="fas fa-credit-card"></i>
                Payment Received &mdash; ${{ number_format($booking->amount_paid, 2) }}
            </div>
            @endif

            <div class="confirmation-code">
                <span>Booking Reference</span>
                <strong>{{ $booking->confirmation_code }}</strong>
            </div>

            @if($booking->meet_link)
            <div style="background: rgba(72, 187, 120, 0.1); border: 2px solid #48bb78; padding: 25px; border-radius: 16px; margin-bottom: 40px; text-align: left;">
                <h4 style="margin-top: 0; color: #38a169; font-size: 1.1rem; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-video"></i> Google Meet Link
                </h4>
                <p style="margin: 0 0 15px; color: var(--secondary-color);">Your meeting link is ready. Please save this link or add it to your calendar to join the session.</p>
                <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                    <a href="{{ $booking->meet_link }}" target="_blank" style="background: #48bb78; color: #fff; padding: 12px 25px; border-radius: 50px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-external-link-alt"></i> Join Meeting
                    </a>
                    <span style="font-family: monospace; background: white; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0; color: #4a5568;">
                        {{ $booking->meet_link }}
                    </span>
                </div>
            </div>
            @endif

            <div class="booking-details">
                <h4><i class="fas fa-calendar-check"></i> Session Details</h4>
                
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="label">Date</div>
                        <div class="value">{{ $booking->slot->date->format('M j, Y') }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Time (CST, UTC-6)</div>
                        <div class="value">{{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Event Type</div>
                        <div class="value">{{ $booking->event_type }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Event Date</div>
                        <div class="value">{{ $booking->event_date ? $booking->event_date->format('M j, Y') : 'N/A' }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Duration</div>
                        <div class="value">{{ $booking->slot->duration }} mins</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Status</div>
                        <div class="value">
                            <span class="status-badge status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="next-steps">
                <h4><i class="fas fa-lightbulb"></i> What Happens Next?</h4>
                <ul>
                    <li><i class="fas fa-check-circle"></i> A confirmation email will be sent to <strong>{{ $booking->email }}</strong></li>
                    <li><i class="fas fa-check-circle"></i> We will review your event details before the session</li>
                    <li><i class="fas fa-check-circle"></i> You'll receive a meeting link if this is an online session</li>
                    <li><i class="fas fa-check-circle"></i> Please be ready 5 minutes before your scheduled time</li>
                </ul>
            </div>


            {{-- Reschedule Button --}}
            @php
                $sessionStart = \Carbon\Carbon::parse($booking->slot->date->format('Y-m-d') . ' ' . $booking->slot->start_time);
                $canReschedule = $booking->status === 'confirmed'
                    && $booking->payment_status === 'paid'
                    && $sessionStart->diffInHours(now(), false) < -24
                    && !$booking->rescheduleRequests()->where('status', 'pending')->exists();

                $hasPending = $booking->rescheduleRequests()->where('status', 'pending')->exists();
            @endphp

            @if($booking->status === 'confirmed' && $booking->payment_status === 'paid')
            <div style="margin-bottom: 24px; padding: 18px 20px; background: #f8f4ff; border-radius: 12px; border: 1.5px solid #ede9fe;">
                <h4 style="margin: 0 0 10px; font-size: 1rem; color: #7c3aed;"><i class="fas fa-calendar-alt"></i> Need to Reschedule?</h4>
                @if($hasPending)
                    <p style="margin: 0; font-size: 0.88rem; color: #7c3aed; font-weight: 600;">
                        <i class="fas fa-clock"></i> Your reschedule request is currently <strong>pending review</strong>. We'll notify you once it's processed.
                    </p>
                @elseif($canReschedule)
                    <p style="margin: 0 0 12px; font-size: 0.88rem; color: #64748b;">You can request a new slot up to 24 hours before your session. Admin will confirm the change.</p>
                    <a href="{{ route('management-session.reschedule', ['code' => $booking->confirmation_code]) }}"
                       style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#7c3aed,#4f46e5);color:#fff;padding:10px 24px;border-radius:50px;font-weight:600;font-size:0.9rem;text-decoration:none;">
                        <i class="fas fa-calendar-alt"></i> Request Reschedule
                    </a>
                @else
                    <p style="margin: 0; font-size: 0.88rem; color: #94a3b8;">
                        <i class="fas fa-lock"></i> Reschedule requests must be made at least 24 hours before the session time.
                    </p>
                @endif
            </div>
            @endif

            <a href="{{ url('/') }}" class="btn-home">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>
    </div>
</section>
@endsection
