@extends('layouts.frontend')

@section('title', 'Custom Planning - SNS Events')

@section('content')
<section class="inner-page-hero">
    <div class="container">
        <h1 data-aos="fade-down">Custom Package</h1>
        <p data-aos="fade-up" data-aos-delay="200">Your vision, our expertise. Let's create something unique.</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white rounded-4 shadow-lg p-5 border-top border-primary border-5" data-aos="fade-up">
                    <h2 class="font-serif mb-4 text-center">Tell Us About Your Vision</h2>
                    <p class="text-muted text-center mb-5">Fill out the form below and our lead designer will get back to you within 24 hours with a personalized proposal.</p>

                    @if(session('success'))
                        <div class="alert alert-success p-3 mb-4 rounded-3 d-flex align-items-center gap-3">
                            <i class="fas fa-check-circle fs-4"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('custom-package.submit') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name *</label>
                                <input type="text" name="name" required class="form-control rounded-pill p-3 border-gray" placeholder="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address *</label>
                                <input type="email" name="email" required class="form-control rounded-pill p-3 border-gray" placeholder="john@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number *</label>
                                <input type="text" name="phone" required class="form-control rounded-pill p-3 border-gray" placeholder="+1 234 567 890">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Event Type *</label>
                                <select name="event_type" required class="form-select rounded-pill p-3 border-gray">
                                    <option value="">Select Event Type</option>
                                    <option>Birthday Party</option>
                                    <option>Wedding Decoration</option>
                                    <option>Proposal Setup</option>
                                    <option>Anniversary Celebration</option>
                                    <option>Graduation Party</option>
                                    <option>Engagement Ceremony</option>
                                    <option>Corporate Event</option>
                                    <option value="Other">Other (Please specify in requirements)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Event Date</label>
                                <input type="date" name="event_date" class="form-control rounded-pill p-3 border-gray">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Estimated Budget ($)</label>
                                <input type="number" name="budget" class="form-control rounded-pill p-3 border-gray" placeholder="e.g. 5000">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Guest Count</label>
                                <input type="number" name="guest_count" class="form-control rounded-pill p-3 border-gray" placeholder="e.g. 150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Venue Location</label>
                                <input type="text" name="venue" class="form-control rounded-pill p-3 border-gray" placeholder="City or Specific Venue">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Share Your Vision & Specific Requirements</label>
                                <textarea name="requirements" rows="5" class="form-control rounded-4 p-4 border-gray" placeholder="Describe your dream decoration, colors, themes, or any specific details you'd like us to know..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-primary-custom w-100 py-3 fs-5">Submit Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .form-control:focus, .form-select:focus { box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); border-color: var(--primary-color); }
    .border-gray { border-color: #e9ecef; }
</style>
@endsection
