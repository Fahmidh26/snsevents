<section id="about" class="about-section">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>{{ $aboutUs->title ?? 'About Us' }}</h2>
      <p>{{ $aboutUs->subtitle ?? 'Crafting Perfect Celebrations Since 2010 — Based in Texas' }}</p>
    </div>
    <div class="about-content">
      <div class="about-image" data-aos="fade-right">
        @if(isset($aboutUs) && $aboutUs->image_path)
            <img src="{{ asset('storage/' . $aboutUs->image_path) }}" alt="{{ $aboutUs->title }}">
        @else
            <img
              src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="About Us"
            />
        @endif
      </div>
      <div class="about-text" data-aos="fade-left">
        <h3>{{ $aboutUs->main_heading ?? 'Your Vision, Our Expertise' }}</h3>
        
        @if(isset($aboutUs) && $aboutUs->description)
            @foreach(explode("\n", $aboutUs->description) as $paragraph)
                @if(trim($paragraph))
                    <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                @endif
            @endforeach
        @else
            <p>
              At SNS Events, based in Texas, we believe every celebration is
              unique and deserves to be treated as such. With over a decade of
              experience in creating magical moments, we've mastered the art of
              turning dreams into reality.
            </p>
            <p>
              Our team of dedicated professionals works tirelessly to ensure
              every detail is perfect, from the initial concept to the final
              execution. We pride ourselves on our creativity, attention to
              detail, and unwavering commitment to excellence.
            </p>
        @endif

        @if(isset($companyProfile) && $companyProfile->team_description)
            <h4 style="color: var(--secondary-color); margin-top: 20px;">Our Team</h4>
            <p>{{ $companyProfile->team_description }}</p>
        @endif

        <div class="stats-container">
          <div class="stat-box" data-aos="zoom-in" data-aos-delay="100">
            <h4>{{ $aboutUs->events_count ?? '500+' }}</h4>
            <p>{{ $aboutUs->events_label ?? 'Events Planned' }}</p>
          </div>
          <div class="stat-box" data-aos="zoom-in" data-aos-delay="200">
            <h4>{{ $aboutUs->clients_count ?? '450+' }}</h4>
            <p>{{ $aboutUs->clients_label ?? 'Happy Clients' }}</p>
          </div>
          <div class="stat-box" data-aos="zoom-in" data-aos-delay="300">
            <h4>{{ $aboutUs->experience_years ?? '10+' }}</h4>
            <p>{{ $aboutUs->experience_label ?? 'Years Experience' }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
