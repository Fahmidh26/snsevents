<section id="testimonials" class="testimonials-section">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>What Our Clients Say</h2>
      <p>Real Stories from Real People</p>
    </div>

    <div class="testimonial-slider" data-aos="fade-up" data-aos-delay="100">
      @if($testimonials && $testimonials->count() > 0)
        @foreach($testimonials as $index => $testimonial)
          <div
            class="testimonial-card"
            id="testimonial-{{ $index + 1 }}"
            style="{{ $index === 0 ? '' : 'display: none' }}"
          >
            <div class="testimonial-image">
              @if($testimonial->image_path)
                <img src="{{ asset('storage/' . $testimonial->image_path) }}" alt="{{ $testimonial->name }}" />
              @else
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Client" />
              @endif
            </div>
            <div class="testimonial-text">
              "{{ $testimonial->text }}"
            </div>
            <div class="testimonial-author">{{ $testimonial->name }}</div>
            @if($testimonial->role)
              <div class="testimonial-role">{{ $testimonial->role }}</div>
            @endif
            <div class="testimonial-rating">
              @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-gray-300' }}"></i>
              @endfor
            </div>
          </div>
        @endforeach
      @else
        <div class="testimonial-card" id="testimonial-1">
          <div class="testimonial-image">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Client" />
          </div>
          <div class="testimonial-text">
            "No testimonials available yet."
          </div>
        </div>
      @endif
    </div>

    @if($testimonials && $testimonials->count() > 1)
      <div class="slider-controls">
        <button class="slider-btn" onclick="changeTestimonial(-1)">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="slider-btn" onclick="changeTestimonial(1)">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    @endif
  </div>
</section>
