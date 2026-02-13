<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @php
        $siteSettings = \App\Models\SiteSetting::current();
    @endphp
    <title>{{ $privacyPolicy->meta_title ?? 'Privacy Policy - ' . $siteSettings->site_title }}</title>
    <meta name="description" content="{{ $privacyPolicy->meta_description ?? 'Privacy Policy for ' . $siteSettings->site_title . '. Learn about how we handle your data.' }}" />
    <meta name="keywords" content="{{ $privacyPolicy->meta_keywords ?? 'privacy policy, terms, data protection' }}">
    @include('layouts.partials.schema')

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $privacyPolicy->meta_title ?? 'Privacy Policy - ' . $siteSettings->site_title }}">
    <meta property="og:description" content="{{ $privacyPolicy->meta_description ?? 'Privacy Policy for ' . $siteSettings->site_title }}">
    <meta property="og:image" content="{{ $privacyPolicy->image_path ? asset('storage/' . $privacyPolicy->image_path) : ($siteSettings->og_image ? asset('storage/' . $siteSettings->og_image) : asset('images/default-og.jpg')) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $privacyPolicy->meta_title ?? 'Privacy Policy - ' . $siteSettings->site_title }}">
    <meta property="twitter:description" content="{{ $privacyPolicy->meta_description ?? 'Privacy Policy for ' . $siteSettings->site_title }}">
    <meta property="twitter:image" content="{{ $privacyPolicy->image_path ? asset('storage/' . $privacyPolicy->image_path) : ($siteSettings->og_image ? asset('storage/' . $siteSettings->og_image) : asset('images/default-og.jpg')) }}">
    
    <!-- Favicon -->
    @if($siteSettings->favicon_path)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings->favicon_path) }}">
    @endif

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

    <style>
      :root {
        --primary-color: #c9a227;
        --primary-gradient: linear-gradient(135deg, #c9a227 0%, #d4af37 50%, #e8d48a 100%);
        --secondary-color: #0f0f0f;
        --accent-color: #d4af37;
        --light-bg: #fafafa;
        --text-dark: #1a1a1a;
        --text-light: #5a5a5a;
        --shadow-lg: 0 16px 48px rgba(0,0,0,0.12);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      }

      body {
        font-family: "Poppins", sans-serif;
        color: var(--text-dark);
        background-color: var(--light-bg);
        overflow-x: hidden;
      }

      h1, h2, h3, h4, h5, h6 {
        font-family: "Playfair Display", serif;
      }

      /* Navbar - matching frontend */
      .navbar {
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        padding: 10px 0;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        transition: var(--transition-smooth);
        z-index: 1000;
      }

      .navbar-brand {
        font-family: "Playfair Display", serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color) !important;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: var(--transition-smooth);
      }

      .navbar-brand:hover {
        transform: scale(1.02);
        text-shadow: 0 0 20px rgba(201, 162, 39, 0.3);
      }

      .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        margin: 0 10px;
        padding: 6px 0 !important;
        font-weight: 500;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: relative;
        transition: var(--transition-smooth);
      }

      .navbar-nav .nav-link:hover {
        color: var(--primary-color) !important;
      }

      .navbar-nav .nav-link::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--primary-gradient);
        transition: var(--transition-smooth);
        transform: translateX(-50%);
        border-radius: 2px;
      }

      .navbar-nav .nav-link:hover::before {
        width: 100%;
      }

      .dropdown-menu {
        background: rgba(15, 15, 15, 0.95);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 10px 0;
        box-shadow: var(--shadow-lg);
        margin-top: 10px;
      }

      .dropdown-item {
        color: rgba(255, 255, 255, 0.85);
        padding: 10px 24px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
      }

      .dropdown-item:hover, .dropdown-item:focus {
        background: rgba(255, 255, 255, 0.05);
        color: var(--primary-color);
        padding-left: 28px;
      }

      /* Mobile Navbar */
      @media (max-width: 991.98px) {
        .navbar-collapse {
          background: rgba(15, 15, 15, 0.98);
          backdrop-filter: blur(20px);
          -webkit-backdrop-filter: blur(20px);
          margin-top: 15px;
          padding: 25px;
          border-radius: 16px;
          box-shadow: 0 24px 64px rgba(0,0,0,0.16);
          border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .navbar-nav .nav-link {
          padding: 12px 0 !important;
          margin: 0;
          border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .navbar-toggler {
          padding: 8px 12px;
          border-radius: 8px;
        }
      }

      /* Hero */
      .page-hero {
        position: relative;
        height: 50vh;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover !important;
        background-position: center !important;
        background-attachment: fixed !important;
        color: #fff;
        text-align: center;
        margin-top: 70px;
      }
      
      .page-hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(to top, var(--light-bg), transparent);
      }

      .hero-content {
          position: relative;
          z-index: 2;
          padding: 40px;
          border: 1px solid rgba(255,255,255,0.1);
          background: rgba(0,0,0,0.4);
          backdrop-filter: blur(5px);
          border-radius: 8px;
          animation: fadeInUp 1s ease;
      }
      
      .page-hero h1 {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 0;
        text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        letter-spacing: 1px;
      }

      /* Content */
      .content-section {
        padding: 80px 0 120px;
        position: relative;
        margin-top: -60px;
        z-index: 10;
      }

      .content-card {
        background: var(--glass-bg);
        border-radius: 20px;
        padding: 60px;
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255,255,255,0.5);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 1s ease 0.3s backwards;
      }

      .content-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      }

      .content-card h2 {
        color: var(--secondary-color);
        margin-top: 40px;
        margin-bottom: 25px;
        font-size: 2rem;
        position: relative;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
      }

      .content-card h2:first-child {
        margin-top: 0;
      }
      
      .content-card h3 {
          font-size: 1.5rem;
          color: var(--secondary-color);
          margin-top: 30px;
          margin-bottom: 15px;
      }

      .content-card p {
        color: var(--text-light);
        margin-bottom: 24px;
        line-height: 1.9;
        font-size: 1.05rem;
      }
      
      .content-card ul, .content-card ol {
          margin-bottom: 24px;
          padding-left: 20px;
          color: var(--text-light);
      }
      
      .content-card li {
          margin-bottom: 12px;
          line-height: 1.8;
      }
      
      .last-updated {
          color: var(--primary-color);
          font-style: italic;
          margin-bottom: 30px;
          display: block;
          font-weight: 500;
      }

      @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    @include('layouts.partials.navbar')

    <!-- Page Hero -->
    <section class="page-hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ $privacyPolicy->image_path ? asset('storage/' . $privacyPolicy->image_path) : 'https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' }}');">
        <div class="container text-center">
            <div class="hero-content">
                <h1 class="display-3">Privacy Policy</h1>
                <p class="lead mb-0 text-white-50 mt-3">Transparency & Trust</p>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="content-section">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content-card">
                    <span class="last-updated"><i class="far fa-clock me-2"></i> Last Updated: {{ $privacyPolicy->updated_at->format('F d, Y') }}</span>
                    {!! $privacyPolicy->content !!}
                </div>
            </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
