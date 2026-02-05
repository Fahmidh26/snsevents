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
        /* Enhanced Premium Color Palette - Consistent with Frontend */
        --primary-color: #c9a227;
        --secondary-color: #0f0f0f;
        --accent-color: #d4af37;
        --surface-white: #ffffff;
        --text-dark: #1a1a1a;
        --text-light: #666666;
        
        --primary-gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 50%, #e0c158 100%);
        --light-bg: #fafafa;
        
        --shadow-xs: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
        --shadow-md: 0 8px 24px rgba(0,0,0,0.08);
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

      /* Navbar Override for consistency */
      .navbar {
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(12px);
        padding: 10px 0;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      }
      
      .navbar-brand {
        font-family: "Playfair Display", serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color) !important;
        text-transform: uppercase;
        letter-spacing: 2px;
      }

      /* Page Hero */
      .page-hero {
        position: relative;
        height: 50vh;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
        color: #fff;
        text-align: center;
        margin-top: 76px; /* Offset fixed navbar */
      }
      
      .page-hero-content {
        position: relative;
        z-index: 2;
      }
      
      .page-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.3);
      }
      
      .page-hero p {
        font-size: 1.5rem;
        font-weight: 300;
        letter-spacing: 1px;
      }
      
      .area-card {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
        position: relative;
        overflow: hidden;
      }

      .area-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        border-color: rgba(201, 162, 39, 0.2);
      }

      .area-icon {
        width: 60px;
        height: 60px;
        background: rgba(201, 162, 39, 0.1);
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
    </style>
  </head>
  <body>

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
                        <small class="text-muted"><i class="fas fa-city me-2" style="color: var(--primary-color)"></i> {{ $area->city }}, {{ $area->state }}</small>
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
                <a href="{{ url('/#contact') }}" class="btn-contact-custom">Contact Us Today</a>
                <style>
                    .btn-contact-custom {
                        background: var(--primary-gradient);
                        color: #fff;
                        padding: 15px 40px;
                        border: none;
                        border-radius: 50px;
                        font-weight: 700;
                        text-decoration: none;
                        display: inline-block;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 15px rgba(201, 162, 39, 0.4);
                    }
                    .btn-contact-custom:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 8px 25px rgba(201, 162, 39, 0.6);
                        color: #fff;
                        background: var(--accent-color);
                    }
                </style>

            </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({ duration: 1000, once: true });
    </script>
  </body>
</html>
