@extends('layouts.frontend')

@section('title', 'Events - SNS Events')

@section('content')
<section class="inner-page-hero">
    <div class="container">
        <h1 data-aos="fade-down">Our Events</h1>
        <p data-aos="fade-up" data-aos-delay="200">Exquisite decorations for every special occasion</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row g-4">
            @forelse($eventTypes as $type)
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="service-card h-100 shadow-sm border-0" onclick="window.location.href='{{ route('events.show', $type->slug) }}'">
                        <div class="service-image position-relative">
                            <img src="{{ asset($type->featured_image ?: 'https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?q=80&w=800') }}" alt="{{ $type->name }}" class="w-100">
                            <div class="service-overlay">
                                <h3>{{ $type->name }}</h3>
                            </div>
                        </div>
                        <div class="service-content p-4 text-center">
                            <p class="text-muted small mb-4">{{ Str::limit(strip_tags($type->description), 100) }}</p>
                            
                            <ul class="service-features text-start mb-4">
                              @if($type->pricingTiers->isNotEmpty() && !empty($type->pricingTiers->first()->features))
                                @foreach(array_slice($type->pricingTiers->first()->features, 0, 4) as $feature)
                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                @endforeach
                              @else
                                <li><i class="fas fa-check"></i> Custom Planning</li>
                                <li><i class="fas fa-check"></i> Venue Selection</li>
                                <li><i class="fas fa-check"></i> Decoration</li>
                                <li><i class="fas fa-check"></i> Coordination</li>
                              @endif
                            </ul>

                            <a href="{{ route('events.show', $type->slug) }}" class="btn-primary-custom py-2 px-4 fs-6">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h3>No events found.</h3>
                </div>
            @endforelse
        </div>
        
        <div class="mt-5 text-center" data-aos="fade-up">
            <div class="p-5 bg-light rounded-4 border-dashed border-2">
                <h3 class="mb-3">Needs something more specific?</h3>
                <p class="text-muted mb-4">We can create a completely custom package tailored to your unique vision.</p>
                <a href="{{ route('custom-package') }}" class="btn-primary-custom">Request Custom Package</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .service-card { transition: all 0.3s ease; border-radius: 15px; overflow: hidden; background: #fff; cursor: pointer; }
    .service-card:hover { transform: translateY(-10px); box-shadow: 0 15px 45px rgba(0,0,0,0.1) !important; }
    .service-image { height: 280px; overflow: hidden; }
    .service-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .service-card:hover .service-image img { transform: scale(1.1); }
    .service-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.7)); display: flex; align-items: flex-end; padding: 25px; }
    .service-overlay h3 { color: #fff; font-size: 1.8rem; margin: 0; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); }
    .border-dashed { border-style: dashed !important; border-color: var(--primary-color) !important; border-width: 2px !important; }

    /* Service Features Styles */
    .service-features {
        list-style: none;
        padding: 0;
        margin: 0 auto;
        display: inline-block;
        width: 100%;
    }
    .service-features li {
        padding: 8px 0;
        color: #666;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        text-align: left;
    }
    .service-features li:last-child {
        border-bottom: none;
    }
    .service-features li i {
        color: var(--primary-color);
        font-size: 0.8rem;
        min-width: 20px;
        height: 20px;
        background: rgba(201, 162, 39, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection
