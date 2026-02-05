<section id="services" class="services-section">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Our Services</h2>
      <p>Comprehensive Event Planning Solutions</p>
    </div>

    <div class="row">
      <!-- Counseling/Coaching Service Card -->
      <div
        class="col-md-6 col-lg-3 mb-4"
        data-aos="fade-up"
        data-aos-delay="0"
      >
        <div class="service-card" onclick="window.location.href='{{ route('counseling') }}'">
          <div class="service-image">
            <img
              src="{{ $counselingSettings->hero_image ? asset('storage/' . $counselingSettings->hero_image) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
              alt="Coaching Session"
            />
          </div>
          <div class="service-overlay">
            <div class="service-content-overlay">
                <h3>Coaching Session</h3>
                <p>Expert advice and personalized coaching for DIY planners.</p>
                <span class="service-link-btn">Learn More <i class="fas fa-arrow-right"></i></span>
            </div>
          </div>
        </div>
      </div>

       <!-- Management Session Card -->
      <div
        class="col-md-6 col-lg-3 mb-4"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div class="service-card" onclick="window.location.href='{{ route('management-session') }}'">
          <div class="service-image">
            <img
              src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Management Session"
            />
          </div>
          <div class="service-overlay">
             <div class="service-content-overlay">
                <h3>Management Session</h3>
                <p>Strategic consultation for high-level event coordination.</p>
                <span class="service-link-btn">Learn More <i class="fas fa-arrow-right"></i></span>
             </div>
          </div>
        </div>
      </div>

      @foreach($eventTypes->where('show_on_home', true)->take(6) as $type)
      <div
        class="col-md-6 col-lg-3 mb-4"
        data-aos="fade-up"
        data-aos-delay="{{ ($loop->index + 2) * 50 }}"
      >
        <div class="service-card" onclick="window.location.href='{{ route('services.show', $type->slug) }}'">
          <div class="service-image">
            <img
              src="{{ $type->featured_image ? asset($type->featured_image) : 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
              alt="{{ $type->name }}"
            />
          </div>
          <div class="service-overlay">
             <div class="service-content-overlay">
                <h3>{{ $type->name }}</h3>
                <p>{{ \Illuminate\Support\Str::limit($type->description ?? 'Premium ' . $type->name . ' services tailored to your vision.', 80) }}</p>
                <span class="service-link-btn">View Details <i class="fas fa-arrow-right"></i></span>
             </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="text-center mt-5" data-aos="fade-up">
        <a href="{{ route('services.index') }}" class="btn-view-all">
            View All Services <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
  </div>
</section>
