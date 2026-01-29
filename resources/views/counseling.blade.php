@extends('layouts.frontend')

@section('title', $settings->seo_title ?? $settings->page_title . ' - SNS Events')

@section('meta')
    @if($settings->seo_description)
        <meta name="description" content="{{ $settings->seo_description }}">
    @endif
    @if($settings->seo_keywords)
        <meta name="keywords" content="{{ $settings->seo_keywords }}">
    @endif
@endsection

@section('styles')
<style>
    /* Override navbar for this page to be always visible */
    .navbar {
        background: rgba(26, 26, 26, 0.95) !important;
        backdrop-filter: blur(10px) !important;
    }

    /* Counseling Page Premium Styles */
    .counseling-hero {
        padding: 160px 0 100px;
        background: linear-gradient(135deg, rgba(26, 26, 26, 0.92) 0%, rgba(45, 45, 45, 0.88) 100%), 
                    url('{{ $settings->hero_image ? Storage::url($settings->hero_image) : "https://images.unsplash.com/photo-1573497620053-ea5300f94f21?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #fff;
        text-align: center;
        position: relative;
    }

    .counseling-hero::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 150px;
        background: linear-gradient(to top, var(--light-bg), transparent);
    }

    .counseling-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #fff 0%, var(--primary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .counseling-hero p.subtitle {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 600px;
        margin: 0 auto 25px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(212, 175, 55, 0.2);
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        padding: 12px 30px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 500;
    }

    /* Intro Section */
    .intro-section {
        padding: 100px 0;
        background: var(--light-bg);
    }

    .intro-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .intro-image {
        position: relative;
    }

    .intro-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    .intro-image::before {
        content: '';
        position: absolute;
        top: -20px;
        left: -20px;
        right: 20px;
        bottom: 20px;
        border: 3px solid var(--primary-color);
        border-radius: 20px;
        z-index: -1;
    }

    .intro-content h2 {
        font-size: 2.5rem;
        color: var(--secondary-color);
        margin-bottom: 25px;
        position: relative;
    }

    .intro-content h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--primary-color);
    }

    .intro-text {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #4a5568;
        white-space: pre-line;
        margin-top: 30px;
    }

    .features-list {
        margin-top: 30px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .feature-item i {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    .feature-item span {
        font-weight: 500;
        color: var(--secondary-color);
    }

    /* Booking Section */
    .booking-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        position: relative;
        overflow: hidden;
    }

    .booking-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 200px;
        background: linear-gradient(to bottom, var(--light-bg), transparent);
        opacity: 0.05;
    }

    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title h2 {
        font-size: 2.8rem;
        color: #fff;
        margin-bottom: 15px;
    }

    .section-title p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.15rem;
    }

    .booking-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Calendar Styles */
    .calendar-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 35px;
        backdrop-filter: blur(10px);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .calendar-header h3 {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .calendar-nav {
        display: flex;
        gap: 12px;
    }

    .calendar-nav button {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: #fff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .calendar-nav button:hover {
        background: var(--primary-color);
        transform: scale(1.1);
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .calendar-day-header {
        text-align: center;
        color: var(--primary-color);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        padding: 12px 0;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.4);
        cursor: default;
        transition: all 0.3s ease;
        position: relative;
        font-weight: 500;
    }

    .calendar-day.available {
        color: #fff;
        cursor: pointer;
        background: rgba(212, 175, 55, 0.15);
    }

    .calendar-day.available:hover {
        background: var(--primary-color);
        transform: scale(1.1);
        box-shadow: 0 5px 20px rgba(212, 175, 55, 0.4);
    }

    .calendar-day.selected {
        background: var(--primary-color);
        color: #fff;
        font-weight: 600;
        box-shadow: 0 0 25px rgba(212, 175, 55, 0.5);
    }

    .calendar-day.today {
        border: 2px solid var(--primary-color);
    }

    .calendar-day.past {
        opacity: 0.25;
    }

    .calendar-day .dot {
        position: absolute;
        bottom: 4px;
        width: 5px;
        height: 5px;
        background: var(--primary-color);
        border-radius: 50%;
    }

    /* Slots Display */
    .slots-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 35px;
        backdrop-filter: blur(10px);
    }

    .slots-header {
        margin-bottom: 30px;
    }

    .slots-header h3 {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .slots-header p {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.95rem;
    }

    .slots-grid {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-height: 380px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .slots-grid::-webkit-scrollbar {
        width: 6px;
    }

    .slots-grid::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .slots-grid::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 10px;
    }

    .slot-btn {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #fff;
        padding: 18px 20px;
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .slot-btn:hover {
        background: rgba(212, 175, 55, 0.15);
        border-color: var(--primary-color);
        transform: translateX(5px);
    }

    .slot-btn.selected {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-color: transparent;
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.35);
    }

    .slot-btn .slot-time {
        font-weight: 600;
        font-size: 1.05rem;
    }

    .slot-btn .slot-meta {
        display: flex;
        gap: 15px;
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .slot-btn .slot-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .slot-btn.selected .slot-meta {
        opacity: 1;
    }

    .no-slots-message {
        text-align: center;
        padding: 50px 20px;
        color: rgba(255, 255, 255, 0.5);
    }

    .no-slots-message i {
        font-size: 3.5rem;
        margin-bottom: 20px;
        display: block;
        opacity: 0.4;
    }

    /* Booking Form Section */
    .booking-form-section {
        padding: 100px 0;
        background: var(--light-bg);
        position: relative;
        margin-top: 60px;
    }

    .form-wrapper {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 60px;
        max-width: 1100px;
        margin: 0 auto;
        align-items: start;
    }

    .form-image {
        position: relative;
    }

    .form-image img {
        width: 100%;
        height: 500px; 
        object-fit: cover; 
        border-radius: 20px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
    }

    .info-card {
        position: relative;
        margin-top: -150px;
        margin-left: -30px;
        margin-right: 30px;
        z-index: 10;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .info-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .icon-box {
        min-width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2);
    }

    .info-header h4 {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin: 0 0 5px 0;
        font-weight: 700;
    }

    .info-header p {
        font-size: 0.9rem;
        color: var(--text-light);
        margin: 0;
    }

    .benefits-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .benefits-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        color: var(--secondary-color);
        font-weight: 500;
        font-size: 0.95rem;
    }

    .benefits-list li:last-child {
        margin-bottom: 0;
    }

    .benefits-list li i {
        color: var(--primary-color);
        font-size: 0.9rem;
    }

    .form-card {
        background: white;
        border-radius: 24px;
        padding: 45px;
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.08);
    }

    .form-card h3 {
        font-size: 2rem;
        color: var(--secondary-color);
        margin-bottom: 10px;
    }

    .form-card p.subtitle {
        color: var(--text-light);
        margin-bottom: 30px;
    }

    .selected-slot-display {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #2d2d2d 100%);
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        color: #fff;
    }

    .selected-slot-display .slot-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .selected-slot-display .slot-info-item {
        text-align: center;
        padding: 15px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    .selected-slot-display .slot-info-label {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .selected-slot-display .slot-info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        color: var(--secondary-color);
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .form-group label span.required {
        color: #e53e3e;
    }

    .form-control {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        color: #fff;
        padding: 18px;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(212, 175, 55, 0.4);
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* Hidden form */
    .form-hidden {
        display: none;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .booking-container,
        .intro-wrapper,
        .form-wrapper {
            grid-template-columns: 1fr;
        }
        
        .counseling-hero h1 {
            font-size: 2.5rem;
        }
        
        .intro-image {
            order: -1;
        }
        
        .form-image {
            display: none;
        }

        .features-list {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .counseling-hero {
            padding: 140px 0 80px;
        }
        
        .counseling-hero h1 {
            font-size: 2rem;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
        
        .calendar-card,
        .slots-card,
        .form-card {
            padding: 25px;
        }

        .selected-slot-display .slot-info-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    /* Loading State */
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.8s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="counseling-hero">
    <div class="container">
        <h1 data-aos="fade-up">{{ $settings->page_title }}</h1>
        @if($settings->page_subtitle)
            <p class="subtitle" data-aos="fade-up" data-aos-delay="100">{{ $settings->page_subtitle }}</p>
        @endif
        <div class="hero-badge" data-aos="fade-up" data-aos-delay="200">
            <i class="fas fa-heart"></i>
            One-on-One Sessions Available
        </div>
    </div>
</section>

<!-- Intro Section -->
<section class="intro-section">
    <div class="container">
        <div class="intro-wrapper">
            <div class="intro-image" data-aos="fade-right">
                <img src="{{ $settings->intro_image ? Storage::url($settings->intro_image) : "https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" }}" alt="Counseling Session">
            </div>
            <div class="intro-content" data-aos="fade-left">
                <h2>{{ $settings->intro_title ?? 'A Safe Space to Heal' }}</h2>
                <p class="intro-text">{{ $settings->intro_text }}</p>
                
                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-lock"></i>
                        <span>100% Confidential</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-video"></i>
                        <span>Online Sessions</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-clock"></i>
                        <span>Flexible Timing</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-heart"></i>
                        <span>Compassionate Care</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking Section -->
<section class="booking-section" id="book-session">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Book Your Session</h2>
            <p>Choose a date and time that works best for you</p>
        </div>

        <div class="booking-container">
            <!-- Calendar -->
            <div class="calendar-card" data-aos="fade-right">
                <div class="calendar-header">
                    <h3 id="calendar-month-year"></h3>
                    <div class="calendar-nav">
                        <button onclick="changeMonth(-1)"><i class="fas fa-chevron-left"></i></button>
                        <button onclick="changeMonth(1)"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="calendar-grid" id="calendar-grid">
                    <!-- Days will be generated by JS -->
                </div>
            </div>

            <!-- Time Slots -->
            <div class="slots-card" data-aos="fade-left">
                <div class="slots-header">
                    <h3>Available Times</h3>
                    <p id="selected-date-display">Select a date to see available times</p>
                </div>
                <div class="slots-grid" id="slots-container">
                    <div class="no-slots-message">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Click on a highlighted date to view available time slots</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking Form Section -->
<section class="booking-form-section form-hidden" id="booking-form-section">
    <div class="container">
        <div class="form-wrapper">
            <div class="form-image" data-aos="fade-right">
                <img src="{{ $settings->booking_image ? Storage::url($settings->booking_image) : "https://images.unsplash.com/photo-1516302752625-fcc3c50ae61f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" }}" alt="Peaceful Environment">
                <div class="info-card">
                    <div class="info-header">
                        <div class="icon-box">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <h4>Booking Summary</h4>
                            <p>Complete your reservation</p>
                        </div>
                    </div>
                    <div class="selected-slot-display" id="form-slot-display">
                        <div class="slot-info-grid">
                            <div class="slot-info-item">
                                <div class="slot-info-label">Date</div>
                                <div class="slot-info-value" id="form-date"></div>
                            </div>
                            <div class="slot-info-item">
                                <div class="slot-info-label">Time</div>
                                <div class="slot-info-value" id="form-time"></div>
                            </div>
                            <div class="slot-info-item">
                                <div class="slot-info-label">Duration</div>
                                <div class="slot-info-value" id="form-duration"></div>
                            </div>
                            <div class="slot-info-item">
                                <div class="slot-info-label">Price</div>
                                <div class="slot-info-value" id="form-price"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-card" id="booking-form-card" data-aos="fade-up">
                <h3>Finalize Booking</h3>
                <p class="subtitle">Enter your details to confirm your session</p>

                <form action="{{ route('counseling.book') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="slot_id" id="slot_id" value="">

                    <div class="form-group">
                        <label for="name">Your Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your full name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="your@email.com">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone" required placeholder="+1 234 567 890">
                    </div>

                    <div class="form-group">
                        <label for="message">What would you like to discuss? <span style="color: var(--text-light);">(optional)</span></label>
                        <textarea class="form-control" id="message" name="message" placeholder="Share what's on your mind... This is confidential and helps prepare for our session."></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 25px;">
                        <label style="display: flex; align-items: start; gap: 10px; cursor: pointer; font-weight: normal;">
                            <input type="checkbox" name="terms" required style="width: 18px; height: 18px; accent-color: var(--primary-color); margin-top: 4px;">
                            <span style="font-size: 0.9rem; color: var(--text-light);">
                                I acknowledge that I am booking a coaching session, not therapy or professional counseling. I understand that results are not guaranteed and I accept full responsibility for my decisions. Read the full <a href="{{ route('counseling-terms') }}" target="_blank" style="color: var(--primary-color); text-decoration: underline;">Terms & Disclaimer</a>.
                            </span>
                        </label>
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-check-circle me-2"></i> Confirm My Session
                    </button>
                    <p style="margin-top: 15px; font-size: 0.85rem; color: var(--text-muted); text-align: center;">Note: Coaching services are not a substitute for licensed therapy, medical, or legal advice.</p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Available dates with slot counts from backend
    const availableDates = @json($availableDates);
    
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let selectedDate = null;
    let selectedSlotId = null;
    let selectedSlotData = null;

    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    function renderCalendar() {
        const grid = document.getElementById('calendar-grid');
        const monthYear = document.getElementById('calendar-month-year');
        
        monthYear.textContent = `${monthNames[currentMonth]} ${currentYear}`;
        
        // Clear grid
        grid.innerHTML = '';
        
        // Add day headers
        dayNames.forEach(day => {
            grid.innerHTML += `<div class="calendar-day-header">${day}</div>`;
        });
        
        // Get first day of month and number of days
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        // Add empty cells for days before first day
        for (let i = 0; i < firstDay; i++) {
            grid.innerHTML += `<div class="calendar-day"></div>`;
        }
        
        // Add days
        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const thisDate = new Date(currentYear, currentMonth, day);
            thisDate.setHours(0, 0, 0, 0);
            
            let classes = 'calendar-day';
            let onclick = '';
            
            if (thisDate < today) {
                classes += ' past';
            } else if (thisDate.getTime() === today.getTime()) {
                classes += ' today';
            }
            
            if (availableDates[dateStr]) {
                classes += ' available';
                onclick = `onclick="selectDate('${dateStr}')"`;
            }
            
            if (selectedDate === dateStr) {
                classes += ' selected';
            }
            
            const dot = availableDates[dateStr] ? '<span class="dot"></span>' : '';
            grid.innerHTML += `<div class="${classes}" ${onclick}>${day}${dot}</div>`;
        }
    }

    function changeMonth(delta) {
        currentMonth += delta;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        } else if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar();
    }

    function selectDate(dateStr) {
        selectedDate = dateStr;
        selectedSlotId = null;
        selectedSlotData = null;
        document.getElementById('booking-form-section').classList.add('form-hidden');
        renderCalendar();
        loadSlots(dateStr);
    }

    function loadSlots(dateStr) {
        const container = document.getElementById('slots-container');
        const dateDisplay = document.getElementById('selected-date-display');
        
        container.innerHTML = '<div class="no-slots-message"><div class="loading-spinner"></div><p style="margin-top: 15px;">Loading available slots...</p></div>';
        
        fetch(`{{ route('counseling.slots') }}?date=${dateStr}`)
            .then(response => response.json())
            .then(data => {
                dateDisplay.textContent = data.date;
                
                if (data.slots.length === 0) {
                    container.innerHTML = '<div class="no-slots-message"><i class="fas fa-calendar-times"></i><p>No available slots for this date</p></div>';
                    return;
                }
                
                container.innerHTML = '';
                data.slots.forEach(slot => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'slot-btn';
                    btn.innerHTML = `
                        <span class="slot-time">${slot.formatted_time}</span>
                        <span class="slot-meta">
                            <span><i class="fas fa-clock"></i> ${slot.duration} min</span>
                            <span><i class="fas fa-tag"></i> ${slot.formatted_price}</span>
                        </span>
                    `;
                    btn.onclick = () => selectSlot(slot, data.date);
                    container.appendChild(btn);
                });
            })
            .catch(error => {
                container.innerHTML = '<div class="no-slots-message"><i class="fas fa-exclamation-circle"></i><p>Failed to load slots. Please try again.</p></div>';
            });
    }

    function selectSlot(slot, dateFormatted) {
        selectedSlotId = slot.id;
        selectedSlotData = { ...slot, dateFormatted };
        
        // Update slot buttons
        document.querySelectorAll('.slot-btn').forEach(btn => {
            btn.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        
        showBookingForm(slot, dateFormatted);
    }

    function showBookingForm(slot, dateFormatted) {
        const section = document.getElementById('booking-form-section');
        const slotIdInput = document.getElementById('slot_id');
        const formDate = document.getElementById('form-date');
        const formTime = document.getElementById('form-time');
        const formDuration = document.getElementById('form-duration');
        const formPrice = document.getElementById('form-price');
        
        slotIdInput.value = slot.id;
        formDate.textContent = dateFormatted;
        formTime.textContent = slot.formatted_time;
        formDuration.textContent = slot.duration + ' min';
        formPrice.textContent = slot.formatted_price;
        
        section.classList.remove('form-hidden');
        
        // Scroll to form
        setTimeout(() => {
            section.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 100);
    }



    // Form submission
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<div class="loading-spinner"></div> Processing...';
    });

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        renderCalendar();
    });
</script>
@endsection
