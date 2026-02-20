@extends('layouts.frontend')

@php
    $sessionLabel = $type === 'counseling' ? 'Coaching Session' : 'Management Session';
@endphp

@section('title', 'Request Reschedule — ' . $sessionLabel)

@section('styles')
<style>
        /* Navbar: transparent over hero, dark on scroll */
        .navbar {
            background: transparent !important;
            backdrop-filter: none !important;
            position: fixed !important;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar.scrolled {
            background: rgba(10,10,10,0.9) !important;
            backdrop-filter: blur(12px) !important;
        }

        /* Hero */
        .reschedule-hero {
            padding: 160px 0 90px;
            background: linear-gradient(135deg, rgba(15,15,15,0.75) 0%, rgba(0,0,0,0.6) 100%),
                        url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            text-align: center;
            position: relative;
        }
        .reschedule-hero h1 { font-size: 2.8rem; font-weight: 700; margin: 0 0 12px; }
        .reschedule-hero p  { font-size: 1.1rem; color: rgba(255,255,255,0.8); margin: 0; }

        :root {
            --rp-primary: #7c3aed;
            --rp-primary-light: #ede9fe;
            --rp-success: #059669;
            --rp-text: #1e293b;
            --rp-muted: #64748b;
            --rp-border: #e2e8f0;
            --rp-radius: 16px;
        }
        .rs-container { max-width: 860px; margin: 0 auto; padding: 0 20px; }
        .rs-card { background: #fff; border-radius: var(--rp-radius); box-shadow: 0 4px 20px rgba(0,0,0,.07); padding: 32px; margin-top: 32px; margin-bottom: 16px; }
        .rs-card h3 { font-size: 1.1rem; font-weight: 700; margin: 0 0 16px; color: var(--rp-primary); display: flex; align-items: center; gap: 8px; }
        .current-booking { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; }
        .meta-item { background: var(--rp-primary-light); border-radius: 10px; padding: 12px 16px; }
        .meta-item .label { font-size: .75rem; font-weight: 600; text-transform: uppercase; color: var(--rp-primary); letter-spacing: .05em; }
        .meta-item .val   { font-size: .95rem; font-weight: 600; color: var(--rp-text); margin-top: 4px; }
        .slots-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 14px; margin-top: 8px; }
        .slot-card { border: 2px solid var(--rp-border); border-radius: 12px; padding: 16px; cursor: pointer; transition: all .2s; position: relative; }
        .slot-card:hover, .slot-card.selected { border-color: var(--rp-primary); background: var(--rp-primary-light); }
        .slot-card input[type="radio"] { position: absolute; opacity: 0; }
        .slot-card .slot-date  { font-weight: 700; font-size: .95rem; color: var(--rp-text); }
        .slot-card .slot-time  { font-size: .85rem; color: var(--rp-muted); margin-top: 4px; }
        .slot-card .slot-price { font-size: .85rem; font-weight: 700; color: var(--rp-success); margin-top: 6px; }
        .slot-card .check { position: absolute; top: 10px; right: 10px; width: 20px; height: 20px; border-radius: 50%; border: 2px solid var(--rp-border); display: flex; align-items: center; justify-content: center; font-size: .7rem; color: #fff; }
        .slot-card.selected .check { background: var(--rp-primary); border-color: var(--rp-primary); }
        .no-slots { text-align: center; padding: 40px; color: var(--rp-muted); background: #f1f5f9; border-radius: 12px; }
        .rs-form-group { margin-top: 20px; }
        .rs-form-group label { display: block; font-weight: 600; font-size: .9rem; margin-bottom: 8px; }
        .rs-form-group textarea { width: 100%; border: 1.5px solid var(--rp-border); border-radius: 10px; padding: 12px 16px; font-size: .9rem; resize: vertical; min-height: 100px; outline: none; transition: border .2s; box-sizing: border-box; }
        .rs-form-group textarea:focus { border-color: var(--rp-primary); }
        .notice { display: flex; align-items: flex-start; gap: 10px; background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 8px; padding: 14px 16px; margin-bottom: 20px; font-size: .88rem; color: #92400e; }
        .btn-rs-submit { background: linear-gradient(135deg,#7c3aed,#4f46e5); color:#fff; border:none; border-radius:50px; padding:14px 36px; font-size:1rem; font-weight:700; cursor:pointer; transition:opacity .2s; display:inline-flex; align-items:center; gap:8px; }
        .btn-rs-submit:hover { opacity:.9; }
        .btn-rs-submit:disabled { opacity:.5; cursor:not-allowed; }
        .btn-rs-back { display:inline-flex; align-items:center; gap:6px; color:var(--rp-muted); font-size:.9rem; text-decoration:none; margin-top:16px; }
        .btn-rs-back:hover { color:var(--rp-primary); }
        .rs-alert-success { background:#d1fae5; color:#065f46; border-radius:10px; padding:14px 18px; margin-bottom:20px; display:flex; align-items:center; gap:10px; font-weight:600; }
        .rs-alert-error   { background:#fee2e2; color:#991b1b; border-radius:10px; padding:14px 18px; margin-bottom:20px; display:flex; align-items:center; gap:10px; font-weight:600; }
@endsection

@section('content')

    <!-- Hero -->
    <section class="reschedule-hero">
        <div class="container">
            <h1><i class="fas fa-calendar-alt" style="margin-right:12px;"></i>Request Reschedule</h1>
            <p>Select a new {{ $originalDuration }}-minute slot for your {{ $sessionLabel }}</p>
        </div>
    </section>

    <div class="rs-container" style="padding-bottom: 60px;">

        @if(session('success'))
            <div class="rs-alert-success" style="margin-top:24px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="rs-alert-error" style="margin-top:24px;"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="rs-alert-error" style="margin-top:24px;"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
        @endif

        {{-- Current Booking --}}
        <div class="rs-card">
            <h3><i class="fas fa-bookmark"></i> Your Current Booking</h3>
            <div class="current-booking">
                <div class="meta-item">
                    <div class="label">Booking Ref</div>
                    <div class="val">{{ $booking->confirmation_code }}</div>
                </div>
                <div class="meta-item">
                    <div class="label">Date</div>
                    <div class="val">{{ $booking->slot->date->format('M j, Y') }}</div>
                </div>
                <div class="meta-item">
                    <div class="label">Time</div>
                    <div class="val">{{ \Carbon\Carbon::parse($booking->slot->start_time)->format('g:i A') }}</div>
                </div>
                <div class="meta-item">
                    <div class="label">Duration</div>
                    <div class="val">{{ $booking->slot->duration }} mins</div>
                </div>
            </div>
        </div>

        {{-- Slot Picker --}}
        <div class="rs-card">
            <h3><i class="fas fa-calendar-check"></i> Choose a New Slot</h3>

            <div class="notice">
                <i class="fas fa-clock" style="margin-top:2px;"></i>
                <span>Reschedule requests must be submitted at least <strong>24 hours</strong> before your current session. Only <strong>{{ $originalDuration }}-minute</strong> slots (same duration as your original booking) are shown. The admin will review and confirm.</span>
            </div>

            @if($availableSlots->isEmpty())
                <div class="no-slots">
                    <i class="fas fa-calendar-times" style="font-size:2.5rem;margin-bottom:12px;display:block;"></i>
                    <strong>No Matching Slots Available</strong>
                    <p style="margin:8px 0 0;">There are currently no other available {{ $originalDuration }}-minute slots. Please contact us directly to arrange a reschedule.</p>
                </div>
            @else
                <form method="POST" action="{{ $submitRoute }}" id="reschedule-form">
                    @csrf
                    <div class="slots-grid" id="slots-grid">
                        @foreach($availableSlots as $slot)
                        <label class="slot-card {{ old('requested_slot_id') == $slot->id ? 'selected' : '' }}" for="slot_{{ $slot->id }}">
                            <input type="radio" name="requested_slot_id" id="slot_{{ $slot->id }}" value="{{ $slot->id }}"
                                {{ old('requested_slot_id') == $slot->id ? 'checked' : '' }}
                                required>
                            <div class="check"><i class="fas fa-check"></i></div>
                            <div class="slot-date">{{ $slot->date->format('l, M j, Y') }}</div>
                            <div class="slot-time"><i class="fas fa-clock" style="margin-right:4px;color:#7c3aed;"></i>
                                {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} –
                                {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                            </div>
                            <div class="slot-price"><i class="fas fa-tag" style="margin-right:4px;"></i>${{ number_format($slot->price, 2) }}</div>
                        </label>
                        @endforeach
                    </div>

                    <div class="rs-form-group">
                        <label for="reason">Reason for Rescheduling <span style="color:#64748b;font-weight:400;">(optional)</span></label>
                        <textarea name="reason" id="reason" placeholder="Let us know why you'd like to reschedule…">{{ old('reason') }}</textarea>
                    </div>

                    <div style="margin-top:28px; display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
                        <button type="submit" class="btn-rs-submit" id="submit-btn" disabled>
                            <i class="fas fa-paper-plane"></i> Submit Reschedule Request
                        </button>
                        <a href="{{ url()->previous() }}" class="btn-rs-back">
                            <i class="fas fa-arrow-left"></i> Back to Confirmation
                        </a>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Navbar scroll effect — same as about.blade.php
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Enable submit button only when a slot is selected
    const radios    = document.querySelectorAll('input[type="radio"][name="requested_slot_id"]');
    const submitBtn = document.getElementById('submit-btn');
    const cards     = document.querySelectorAll('.slot-card');

    if (radios.length) {
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                cards.forEach(c => c.classList.remove('selected'));
                radio.closest('.slot-card').classList.add('selected');
                submitBtn.disabled = false;
            });
        });
        if (document.querySelector('input[type="radio"]:checked')) {
            submitBtn.disabled = false;
        }
    }
</script>
@endsection
