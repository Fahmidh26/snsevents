@extends('layouts.frontend')

@section('title', $seo->title)

@section('meta')
    <meta name="description" content="{{ $seo->meta_description }}" />
    <meta name="keywords" content="{{ $seo->meta_keywords }}" />
    
    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $seo->og_title }}" />
    <meta property="og:description" content="{{ $seo->og_description }}" />
    @if($seo->og_image)
        <meta property="og:image" content="{{ asset($seo->og_image) }}" />
    @endif
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $seo->og_title }}" />
    <meta name="twitter:description" content="{{ $seo->og_description }}" />
    @if($seo->og_image)
        <meta name="twitter:image" content="{{ asset($seo->og_image) }}" />
    @endif
    
    <!-- Schema.org markup for Google+ -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "name": "{{ $eventType->name }}",
      "description": "{{ $eventType->description }}",
      "provider": {
        "@type": "LocalBusiness",
        "name": "SNS Events",
        "url": "{{ url('/') }}"
      }
      @if($seo->og_image)
      ,
      "image": "{{ asset($seo->og_image) }}"
      @endif
    }
    </script>
@endsection

@section('content')
<section class="inner-page-hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset($eventType->featured_image ?: 'https://images.unsplash.com/photo-1472653431158-6364773b2a56?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') }}'); background-size: cover; background-position: center;">
    <div class="container">
        <h1 data-aos="fade-down">{{ $eventType->name }}</h1>
        <p data-aos="fade-up" data-aos-delay="200">{{ Str::limit($eventType->description, 150) }}</p>
    </div>
</section>

<!-- About & Gallery -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="mb-4">Elegance in Every Detail</h2>
                <div class="text-muted lead mb-4">
                    {{ $eventType->description }}
                </div>
                <div class="d-flex gap-3 mt-4">
                    <div class="flex-shrink-0 text-primary fs-3"><i class="fas fa-check-circle"></i></div>
                    <div><h5 class="mb-1">Professional Management</h5><p class="small text-muted">We handle everything from concept to cleanup.</p></div>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-left">
                <!-- Gallery Grid -->
                <div class="row g-2">
                    @foreach($eventType->galleries->take(4) as $gallery)
                        <div class="col-6">
                            <div class="gallery-img-wrapper" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                <img src="{{ asset($gallery->image_path) }}" class="img-fluid rounded-3" alt="{{ $gallery->caption }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if($eventType->galleries->count() > 4)
            <div class="row g-2 mt-2">
                @foreach($eventType->galleries->skip(4) as $gallery)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="gallery-img-wrapper" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">
                            <img src="{{ asset($gallery->image_path) }}" class="img-fluid rounded-3" alt="{{ $gallery->caption }}">
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Pricing Tiers -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title-line">Choose Your Package</h2>
            <p class="text-muted">Tailored pricing for your perfect event</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($eventType->pricingTiers as $tier)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <div class="pricing-card {{ $loop->index == 1 ? 'featured' : '' }}">
                        @if($loop->index == 1)
                            <div class="pricing-badge">MOST POPULAR</div>
                        @endif
                        
                        @if($tier->image)
                            <img src="{{ asset($tier->image) }}" alt="{{ $tier->tier_name }}" class="w-100 rounded-3 mb-4 tier-img">
                        @endif

                        <h3>{{ $tier->tier_name }}</h3>
                        <div class="pricing-price">${{ number_format($tier->price, 0) }}<span>/event</span></div>
                        <p class="text-muted small mt-2">{{ $tier->description }}</p>
                        
                        <ul class="pricing-features">
                            @foreach($tier->features as $feature)
                                <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>

                        <button class="btn btn-pricing w-100" data-bs-toggle="modal" data-bs-target="#inquiryModal{{ $tier->id }}">Inquire Now</button>
                    </div>
                </div>

                <!-- Inquiry Modal -->
                <div class="modal fade" id="inquiryModal{{ $tier->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 rounded-4 shadow-lg">
                            <div class="modal-header border-0 pb-0">
                                <h4 class="modal-title font-serif">Inquiry: {{ $tier->tier_name }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form action="{{ route('inquire.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="pricing_tier_id" value="{{ $tier->id }}">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Full Name *</label>
                                        <input type="text" name="name" required class="form-control rounded-pill border-gray">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label small fw-bold">Email *</label>
                                            <input type="email" name="email" required class="form-control rounded-pill border-gray">
                                        </div>
                                        <div class="col">
                                            <label class="form-label small fw-bold">Phone *</label>
                                            <input type="text" name="phone" required class="form-control rounded-pill border-gray">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Expected Event Date</label>
                                        <input type="date" name="event_date" class="form-control rounded-pill border-gray">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Any specific message?</label>
                                        <textarea name="message" rows="3" class="form-control rounded-4 border-gray"></textarea>
                                    </div>
                                    <button type="submit" class="btn-primary-custom w-100 mt-2">Send Inquiry</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Pricing packages for this event type will be added soon.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
            <p class="text-muted">Don't see what you're looking for?</p>
            <a href="{{ route('custom-package') }}" class="text-primary fw-bold text-decoration-none hover-underline">Request a Custom Package <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .gallery-img-wrapper { overflow: hidden; height: 180px; }
    .gallery-img-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; cursor: pointer; }
    .gallery-img-wrapper:hover img { transform: scale(1.1); }
    
    .section-title-line { position: relative; display: inline-block; padding-bottom: 15px; }
    .section-title-line::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background: var(--primary-color); }
    
    .pricing-card { background: #fff; border-radius: 20px; padding: 40px 30px; border: 1px solid #eee; transition: all 0.3s ease; text-align: center; }
    .pricing-card:hover { transform: translateY(-10px); box-shadow: 0 15px 50px rgba(0,0,0,0.1); }
    .pricing-card.featured { border: 2px solid var(--primary-color); position: relative; box-shadow: 0 10px 40px rgba(0,0,0,0.05); }
    .pricing-badge { position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: var(--primary-color); color: #fff; padding: 5px 20px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; letter-spacing: 1px; }
    
    .tier-img { height: 200px; object-fit: cover; margin-top: -10px; }
    .pricing-price { font-size: 2.5rem; font-weight: 700; color: var(--primary-color); }
    .pricing-price span { font-size: 1rem; color: #999; font-weight: 400; }
    
    .pricing-features { list-style: none; padding: 0; margin: 30px 0; text-align: left; }
    .pricing-features li { padding: 10px 0; border-bottom: 1px solid #f8f8f8; font-size: 0.95rem; color: #555; }
    .pricing-features li i { color: var(--primary-color); margin-right: 10px; }
    
    .btn-pricing { background: #f8f9fa; border: 2px solid var(--primary-color); color: var(--secondary-color); font-weight: 700; border-radius: 50px; padding: 12px; transition: all 0.3s ease; }
    .pricing-card:hover .btn-pricing, .pricing-card.featured .btn-pricing { background: var(--primary-color); color: #fff; }
    
    .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); border-color: var(--primary-color); }
    .hover-underline:hover { text-decoration: underline !important; }
</style>
@endsection
