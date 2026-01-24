<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $seo->title ?? 'Areas We Serve - SNS Events' }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? 'Explore the locations we serve across Texas.' }}" />
    <meta name="keywords" content="{{ $seo->meta_keywords ?? 'service areas, texas event locations' }}" />
    
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <style>
      :root {
        --primary-color: #d4af37;
        --secondary-color: #1a1a1a;
        --accent-color: #c9a961;
        --light-bg: #f8f9fa;
        --text-dark: #2c3e50;
        --text-light: #6c757d;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Poppins", sans-serif;
        color: var(--text-dark);
        overflow-x: hidden;
      }

      h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display", serif;
      }

      /* Navbar */
      .navbar {
        background: rgba(26, 26, 26, 0.95);
        backdrop-filter: blur(10px);
        padding: 1rem 0;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
      }

      .navbar-brand {
        font-family: "Playfair Display", serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color) !important;
        text-transform: uppercase;
        letter-spacing: 2px;
      }

      .navbar-nav .nav-link {
        color: #fff !important;
        margin: 0 15px;
        font-weight: 500;
        position: relative;
        transition: color 0.3s ease;
      }

      .navbar-nav .nav-link:hover {
        color: var(--primary-color) !important;
      }

      .navbar-nav .nav-link::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-color);
        transition: width 0.3s ease;
      }

      .navbar-nav .nav-link:hover::after {
        width: 100%;
      }
      
      .navbar-nav .nav-link.active {
        color: var(--primary-color) !important;
      }
      
      /* Service Areas Specific */
      .page-hero {
        position: relative;
        height: 50vh;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
        color: #fff;
        text-align: center;
      }
      
      .page-hero::before {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6);
      }
      
      .page-hero-content {
        position: relative;
        z-index: 2;
      }
      
      .page-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
      }
      
      .page-hero p {
        font-size: 1.5rem;
        font-weight: 300;
      }
      
      .area-card {
        background: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
        height: 100%;
        position: relative;
        overflow: hidden;
      }

      .area-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        border-bottom: 3px solid var(--primary-color);
      }

      .area-icon {
        width: 60px;
        height: 60px;
        background: rgba(212, 175, 55, 0.1);
        color: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
      }

      .area-card h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: var(--secondary-color);
      }
      
      .area-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
      }

      /* Footer - copied minimal styles */
      .footer {
        background: var(--secondary-color);
        color: #fff;
        padding: 80px 0 30px;
      }
      .footer h3 { color: var(--primary-color); margin-bottom: 25px; }
      .footer ul { list-style: none; padding: 0; }
      .footer ul li { margin-bottom: 12px; }
      .footer a { color: #ccc; text-decoration: none; transition: 0.3s; }
      .footer a:hover { color: var(--primary-color); }
      .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px; margin-top: 50px; text-align: center; color: #888; }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <!-- Navbar -->
    @include('layouts.partials.navbar')

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="page-hero-content" data-aos="fade-up">
            <h1>Areas We Serve</h1>
            <p>Bringing The Magic To You</p>
        </div>
    </section>

    <!-- Service Areas List -->
    <section class="py-5 bg-light">
      <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="mb-3" style="color: var(--secondary-color);">Serving Texas with Excellence</h2>
            <p class="text-muted" style="max-width: 700px; margin: 0 auto;">SNS Events is proud to bring premium event planning and decoration services to major cities and communities across Texas.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($serviceAreas as $area)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ 100 }}">
                <div class="area-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="area-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        @if($area->map_url)
                        <a href="{{ $area->map_url }}" target="_blank" class="text-secondary" title="View on map">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        @endif
                    </div>
                    
                    <h3>{{ $area->name }}</h3>
                    <p class="text-muted mb-4">{{ $area->description ?? "Expert event decoration services in {$area->name}. Contact us to plan your next event here." }}</p>
                    
                    <div class="border-top pt-3 mt-auto">
                        <small class="text-muted"><i class="fas fa-city me-2 text-warning"></i> {{ $area->city }}, {{ $area->state }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- CTA -->
        <div class="text-center mt-5 pt-4" data-aos="fade-up">
            <div class="p-5 rounded bg-white shadow-sm d-inline-block" style="border-top: 4px solid var(--primary-color); max-width: 600px;">
                <h3 class="h4 mb-3">Don't see your city?</h3>
                <p class="mb-4 text-muted">We often travel to surrounding areas and can accommodate destination events. Contact us to discuss your location.</p>
                <a href="{{ url('/#contact') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold text-white border-0" style="background: var(--primary-color);">Contact Us Today</a>
            </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-4">
            <h3>SNS Events</h3>
            <p>Creating unforgettable moments since 2010. Based in Texas, we transform your vision into reality.</p>
          </div>
          <div class="col-md-4 mb-4">
            <h3>Quick Links</h3>
            <ul>
              <li><a href="{{ url('/#home') }}">Home</a></li>
              <li><a href="{{ url('/#about') }}">About Us</a></li>
              <li><a href="{{ url('/#services') }}">Services</a></li>
              <li><a href="{{ url('/#contact') }}">Contact</a></li>
              <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
              <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
            </ul>
          </div>
          <div class="col-md-4 mb-4">
            <h3>Newsletter</h3>
            <form>
              <input type="email" placeholder="Your email" class="form-control mb-2" style="background: rgba(255,255,255,0.1); border: none; color: white;">
              <button class="btn btn-warning w-100" style="background: var(--primary-color); border: none; color: white;">Subscribe</button>
            </form>
          </div>
        </div>
        <div class="footer-bottom">
          <p>&copy; 2026 SNS Events. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({ duration: 1000, once: true });
    </script>
  </body>
</html>
