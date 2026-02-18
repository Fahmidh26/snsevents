@extends('layouts.frontend')

@section('title', 'Track Your Booking - SNS Events')

@section('styles')
<style>
    .navbar {
        background: rgba(26, 26, 26, 0.95) !important;
        backdrop-filter: blur(10px) !important;
    }

    .track-hero {
        padding: 160px 0 100px;
        background: linear-gradient(135deg, rgba(26, 26, 26, 0.92) 0%, rgba(45, 45, 45, 0.88) 100%), 
                    url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #fff;
        text-align: center;
    }

    .track-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #fff 0%, var(--primary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .track-section {
        padding: 80px 0;
        background: var(--light-bg);
        min-height: 50vh;
    }

    .track-card {
        background: white;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        max-width: 600px;
        margin: -80px auto 0;
        position: relative;
        z-index: 10;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        color: var(--secondary-color);
        margin-bottom: 10px;
    }

    .form-control {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-align: center;
        letter-spacing: 2px;
        font-family: 'Monaco', 'Courier New', monospace;
        text-transform: uppercase;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
    }

    .btn-track {
        display: block;
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
        margin-top: 20px;
    }

    .btn-track:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(212, 175, 55, 0.4);
    }

    .help-text {
        text-align: center;
        margin-top: 20px;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .help-text a {
        color: var(--primary-color);
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<section class="track-hero">
    <div class="container">
        <h1>Track Your Booking</h1>
        <p>Enter your confirmation code to view booking details</p>
    </div>
</section>

<section class="track-section">
    <div class="container">
        <div class="track-card">
            <form action="{{ route('bookings.lookup') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="confirmation_code">Confirmation Code</label>
                    <input type="text" class="form-control" id="confirmation_code" name="confirmation_code" placeholder="e.g. SNS-ABC12345" required>
                    @error('confirmation_code')
                        <div class="text-danger mt-2 small">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-track">
                    <i class="fas fa-search me-2"></i> Find Booking
                </button>
            </form>

            <div class="help-text">
                <p>Lost your code? Please check the email sent to you upon booking, or <a href="{{ route('contact-info.edit') }}">contact us</a> for assistance.</p>
            </div>
        </div>
    </div>
</section>
@endsection
