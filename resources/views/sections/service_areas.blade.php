<section id="service-areas" class="service-areas-section">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Areas We Serve</h2>
      <p>Premier Event Decoration Across Texas</p>
    </div>

    <div class="row g-4 justify-content-center">
        @forelse($serviceAreas as $area)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="area-card">
                <div class="area-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>{{ $area->name }}</h3>
                <p>{{ $area->description ?? "Expert event decoration services in {$area->name} and surrounding neighborhoods. We bring your vision to life with style and elegance." }}</p>
                
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted text-sm"><i class="fas fa-map-pin me-1"></i> {{ $area->city }}, {{ $area->state }} {{ $area->zip_code }}</span>
                    @if($area->map_url)
                    <a href="{{ $area->map_url }}" target="_blank" class="area-link">
                        View Map <i class="fas fa-arrow-right"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>We serve all major cities in Texas. Contact us for availability in your area.</p>
        </div>
        @endforelse
    </div>
    
    <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="200">
        <a href="{{ route('service-areas') }}" class="btn-view-all">
            View All Serving Locations <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
  </div>
</section>
