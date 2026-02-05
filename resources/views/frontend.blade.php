<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="google-site-verification" content="_oq2e_Dd4BVweLR0JFMSW_YmAiy3Sr5PFSpBn0QUbpE" />
    <title>{{ $seo->title ?? ($siteSettings->site_title ?? 'SNS Events - Premium Event Planning') }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? ($siteSettings->site_description ?? 'SNS Events provides premium event planning and decoration services in Texas.') }}" />
    <meta name="keywords" content="{{ $seo->meta_keywords ?? 'event planning, decorations, texas, weddings, corporate events' }}" />
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Favicon -->
    @if($siteSettings->favicon_path)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSettings->favicon_path) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $siteSettings->favicon_path) }}">
    @endif
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="{{ $seo->og_title ?? ($seo->title ?? ($siteSettings->site_title ?? 'SNS Events')) }}" />
    <meta property="og:description" content="{{ $seo->og_description ?? ($seo->meta_description ?? ($siteSettings->site_description ?? 'Premium Event Planning')) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    @if(isset($seo->og_image) && $seo->og_image)
        <meta property="og:image" content="{{ $seo->og_image }}" />
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo->og_title ?? ($seo->title ?? ($siteSettings->site_title ?? 'SNS Events')) }}">
    <meta name="twitter:description" content="{{ $seo->og_description ?? ($seo->meta_description ?? ($siteSettings->site_description ?? 'Premium Event Planning')) }}">
    @if(isset($seo->og_image) && $seo->og_image)
        <meta name="twitter:image" content="{{ $seo->og_image }}">
    @endif
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "SNS Events",
      "image": "{{ $siteSettings->logo_path ? asset('storage/'.$siteSettings->logo_path) : '' }}",
      "description": "{{ $companyProfile->mission ?? 'Premium event decoration services in Texas.' }}",
      "address": {
        "@type": "PostalAddress",
        "addressRegion": "Texas",
        "addressCountry": "US"
      },
      "areaServed": [
        @foreach($serviceAreas as $index => $area)
        {
            "@type": "City",
            "name": "{{ $area->name }}",
            "sameAs": "{{ $area->map_url ?? '' }}"
        }{{ $loop->last ? '' : ',' }}
        @endforeach
      ],
      "url": "{{ url('/') }}"
    }
    </script>

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
        /* Enhanced Premium Color Palette */
        --primary-color: {{ $siteSettings->primary_color ?? '#c9a227' }};
        --secondary-color: {{ $siteSettings->secondary_color ?? '#0f0f0f' }};
        --accent-color: {{ $siteSettings->accent_color ?? '#d4af37' }};
        --surface-white: {{ $siteSettings->background_color ?? '#ffffff' }};
        --text-dark: {{ $siteSettings->text_color ?? '#1a1a1a' }};
        
        /* Derived Colors using CSS color-mix */
        --primary-light: color-mix(in srgb, var(--primary-color), white 30%);
        --primary-dark: color-mix(in srgb, var(--primary-color), black 20%);
        --accent-dark: color-mix(in srgb, var(--accent-color), black 20%);
        --text-light: color-mix(in srgb, var(--text-dark), white 30%);
        --text-muted: color-mix(in srgb, var(--text-dark), white 50%);
        
        --primary-gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 50%, var(--primary-light) 100%);
        
        --light-bg: #fafafa;
        
        /* Refined Shadows */
        --shadow-xs: 0 1px 3px rgba(0,0,0,0.04);
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
        --shadow-md: 0 8px 24px rgba(0,0,0,0.08);
        --shadow-lg: 0 16px 48px rgba(0,0,0,0.12);
        --shadow-xl: 0 24px 64px rgba(0,0,0,0.16);
        --shadow-gold: 0 8px 32px color-mix(in srgb, var(--primary-color), transparent 75%);
        
        /* Glass Effect */
        --glass-bg: color-mix(in srgb, var(--surface-white), transparent 10%);
        --glass-border: color-mix(in srgb, var(--surface-white), transparent 80%);
        
        /* Smooth Transitions */
        --transition-fast: all 0.2s ease;
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      html {
        scroll-behavior: smooth;
      }

      html, body {
        width: 100%;
        overflow-x: hidden;
        position: relative;
      }

      body {
        font-family: "Poppins", sans-serif;
        color: var(--text-dark);
        background: var(--surface-white);
        line-height: 1.7;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      section {
        overflow: hidden;
        position: relative;
      }

      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        font-family: "Playfair Display", serif;
        font-weight: 600;
        line-height: 1.3;
      }

      /* Premium Animations */
      @keyframes shimmer {
        0% { background-position: -200% center; }
        100% { background-position: 200% center; }
      }

      @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px color-mix(in srgb, var(--primary-color) 30%, transparent); }
        50% { box-shadow: 0 0 40px color-mix(in srgb, var(--primary-color) 50%, transparent); }
      }

      @keyframes float-gentle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
      }

      @keyframes scale-in {
        0% { transform: scale(0.95); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
      }

      @keyframes slide-up {
        0% { transform: translateY(30px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
      }

      @keyframes rotate-subtle {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      /* Enhanced Scroll Animations */
      @keyframes bounce-in {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
      }

      @keyframes slide-in-left {
        0% { transform: translateX(-50px); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
      }

      @keyframes slide-in-right {
        0% { transform: translateX(50px); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
      }

      @keyframes fade-in-scale {
        0% { transform: scale(0.9); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
      }

      /* Smooth transitions for all AOS elements */
      [data-aos] {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
      }

      /* Add subtle hover lift to animated cards */
      [data-aos].service-card,
      [data-aos].gallery-item,
      [data-aos].vision-card,
      [data-aos].stat-box {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      /* Navbar */
      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: transparent;
        backdrop-filter: none;
        padding: 15px 0;
        box-shadow: none;
        transition: var(--transition-smooth);
        z-index: 1000;
        height: auto;
      }

      .navbar.scrolled {
        background: rgba(10, 10, 10, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
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
        transition: var(--transition-smooth);
      }

      .navbar-brand:hover {
        transform: scale(1.02);
        text-shadow: 0 0 20px color-mix(in srgb, var(--primary-color) 30%, transparent);
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

      .navbar-nav .nav-link::after {
        display: none;
      }

      /* Dropdown Menu */
      .dropdown-menu {
        background: color-mix(in srgb, var(--secondary-color) 95%, transparent);
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
        transition: var(--transition-fast);
      }

      .dropdown-item:hover, .dropdown-item:focus {
        background: rgba(255, 255, 255, 0.05);
        color: var(--primary-color);
        padding-left: 28px;
      }

      .nav-link.dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.4em;
        vertical-align: 0.15em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
        transition: var(--transition-fast);
      }

      .nav-item.show .nav-link.dropdown-toggle::after {
        transform: rotate(180deg);
      }

      /* Mobile Navbar */
      @media (max-width: 991.98px) {
        .navbar-collapse {
          background: color-mix(in srgb, var(--secondary-color) 98%, transparent);
          backdrop-filter: blur(20px);
          -webkit-backdrop-filter: blur(20px);
          margin-top: 15px;
          padding: 25px;
          border-radius: 16px;
          box-shadow: var(--shadow-xl);
          border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .navbar-nav .nav-link {
          padding: 12px 0 !important;
          margin: 0;
          border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .navbar-nav .nav-link:last-child {
          border-bottom: none;
        }
        
        .navbar:not(.scrolled) .navbar-toggler {
          border-color: rgba(255, 255, 255, 0.3);
        }
        
        .navbar-toggler {
          padding: 8px 12px;
          border-radius: 8px;
          transition: var(--transition-fast);
        }
        
        .navbar-toggler:focus {
          box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary-color) 25%, transparent);
        }
      }

      /* Hero Section */
      .hero-section {
        height: 100vh;
        min-height: 600px;
        background: linear-gradient(165deg, color-mix(in srgb, var(--secondary-color) 70%, transparent) 0%, rgba(0, 0, 0, 0.5) 50%, color-mix(in srgb, var(--secondary-color) 80%, transparent) 100%),
          url("https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
      }

      .hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        padding: 0 20px;
      }

      .hero-content h1 {
        font-size: 4.5rem;
        font-weight: 700;
        margin-bottom: 24px;
        text-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        animation: fadeInDown 1s ease;
        letter-spacing: 2px;
        line-height: 1.1;
      }

      .hero-content p {
        font-size: 1.4rem;
        margin-bottom: 40px;
        animation: fadeInUp 1s ease 0.3s backwards;
        font-weight: 300;
        letter-spacing: 1px;
        opacity: 0.95;
        text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
      }

      .hero-content .btn-primary-custom {
        background: var(--primary-gradient);
        color: #fff;
        padding: 18px 48px;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: var(--transition-smooth);
        animation: fadeInUp 1s ease 0.6s backwards;
        box-shadow: 0 8px 30px color-mix(in srgb, var(--primary-color) 30%, transparent);
        position: relative;
        overflow: hidden;
      }

      .hero-content .btn-primary-custom::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
      }

      .hero-content .btn-primary-custom:hover::before {
        left: 100%;
      }

      .hero-content .btn-primary-custom:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: var(--shadow-gold), 0 0 40px color-mix(in srgb, var(--primary-color) 40%, transparent);
      }

      /* Floating particles - refined */
      .hero-section::before {
        content: "";
        position: absolute;
        width: 200%;
        height: 200%;
        top: -50%;
        left: -50%;
        background: radial-gradient(
          circle,
          color-mix(in srgb, var(--primary-color) 8%, transparent) 1px,
          transparent 1px
        );
        background-size: 60px 60px;
        animation: float 30s infinite linear;
        pointer-events: none;
      }

      .hero-section::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 150px;
        background: linear-gradient(to top, var(--surface-white) 0%, transparent 100%);
        pointer-events: none;
        z-index: 1;
      }

      @keyframes float {
        0% {
          transform: translateY(0) rotate(0deg);
        }
        100% {
          transform: translateY(-60px) rotate(2deg);
        }
      }

      @keyframes fadeInDown {
        from {
          opacity: 0;
          transform: translateY(-40px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(40px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      /* Section Titles */
      .section-title {
        text-align: center;
        margin-bottom: 70px;
        position: relative;
      }

      .section-title h2 {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--secondary-color);
        position: relative;
        display: inline-block;
        padding-bottom: 24px;
        margin-bottom: 0;
      }

      .section-title h2::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 3px;
      }

      .section-title h2::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 1px;
        background: linear-gradient(
          to right,
          transparent,
          color-mix(in srgb, var(--primary-color) 30%, transparent),
          transparent
        );
      }

      .section-title p {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-top: 20px;
        font-weight: 400;
        letter-spacing: 0.5px;
      }

      /* About Section */
      .about-section {
        padding: 120px 0;
        background: var(--light-bg);
        position: relative;
      }

      .about-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, color-mix(in srgb, var(--primary-color) 20%, transparent), transparent);
      }

      .about-content {
        display: flex;
        align-items: center;
        gap: 60px;
      }

      .about-image {
        flex: 1;
        position: relative;
      }

      .about-image::before {
        content: "";
        position: absolute;
        top: -20px;
        left: -20px;
        width: 100px;
        height: 100px;
        border-top: 4px solid var(--primary-color);
        border-left: 4px solid var(--primary-color);
        border-radius: 4px 0 0 0;
        opacity: 0.6;
      }

      .about-image::after {
        content: "";
        position: absolute;
        bottom: -20px;
        right: -20px;
        width: 100px;
        height: 100px;
        border-bottom: 4px solid var(--primary-color);
        border-right: 4px solid var(--primary-color);
        border-radius: 0 0 4px 0;
        opacity: 0.6;
      }

      .about-image img {
        width: 100%;
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        transition: var(--transition-smooth);
      }

      .about-image:hover img {
        transform: scale(1.02);
        box-shadow: var(--shadow-xl);
      }

      .about-text {
        flex: 1;
      }

      .about-text h3 {
        font-size: 2.3rem;
        margin-bottom: 24px;
        color: var(--secondary-color);
        line-height: 1.2;
      }

      .about-text p {
        font-size: 1.05rem;
        line-height: 1.85;
        color: var(--text-light);
        margin-bottom: 18px;
      }

      .stats-container {
        display: flex;
        gap: 20px;
        margin-top: 40px;
      }

      .stat-box {
        flex: 1;
        text-align: center;
        padding: 28px 20px;
        background: var(--surface-white);
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-smooth);
        border: 1px solid rgba(0, 0, 0, 0.03);
        position: relative;
        overflow: hidden;
      }

      .stat-box::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: var(--transition-smooth);
      }

      .stat-box:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-md);
      }

      .stat-box:hover::before {
        transform: scaleX(1);
      }

      .stat-box h4 {
        font-size: 2.8rem;
        font-weight: 700;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
      }

      .stat-box p {
        font-size: 0.9rem;
        color: var(--text-light);
        margin: 0;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
      }

      /* Services Section */
      .services-section {
        padding: 120px 0;
        background: var(--surface-white);
      }

      .service-card {
        background: var(--surface-white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-smooth);
        margin-bottom: 30px;
        cursor: pointer;
        border: 1px solid rgba(0, 0, 0, 0.04);
      }

      .service-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-lg);
      }

      .service-image {
        height: 260px;
        overflow: hidden;
        position: relative;
      }

      .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition-smooth);
      }

      .service-card:hover .service-image img {
        transform: scale(1.08);
      }

      .service-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 30%, color-mix(in srgb, var(--secondary-color) 85%, transparent) 100%);
        display: flex;
        align-items: flex-end;
        padding: 24px;
        transition: var(--transition-smooth);
      }

      .service-overlay h3 {
        color: #fff;
        font-size: 1.6rem;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      }

      .service-content {
        padding: 28px;
      }

      .service-content p {
        color: var(--text-light);
        margin-bottom: 20px;
        font-size: 0.95rem;
        line-height: 1.7;
      }

      .service-features {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .service-features li {
        padding: 10px 0;
        color: var(--text-light);
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
      }

      .service-features li:last-child {
        border-bottom: none;
      }

      .service-features li i {
        color: var(--primary-color);
        font-size: 0.85rem;
        width: 20px;
        height: 20px;
        background: color-mix(in srgb, var(--primary-color) 10%, transparent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      /* Pricing Section */
      .pricing-section {
        padding: 120px 0;
        background: var(--light-bg);
        position: relative;
      }

      .pricing-tabs {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 60px;
        flex-wrap: wrap;
      }

      .pricing-tab {
        padding: 14px 32px;
        background: var(--surface-white);
        border: 1px solid color-mix(in srgb, var(--primary-color) 30%, transparent);
        border-radius: 50px;
        cursor: pointer;
        transition: var(--transition-smooth);
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--text-dark);
        letter-spacing: 0.5px;
      }

      .pricing-tab:hover {
        border-color: var(--primary-color);
        background: color-mix(in srgb, var(--primary-color) 5%, transparent);
      }

      .pricing-tab.active {
        background: var(--primary-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: var(--shadow-gold);
      }

      .pricing-content {
        display: none;
      }

      .pricing-content.active {
        display: block;
        animation: fadeIn 0.5s ease;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .pricing-card {
        background: var(--surface-white);
        border-radius: 24px;
        padding: 40px 35px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-smooth);
        height: 100%;
        border: 1px solid rgba(0, 0, 0, 0.04);
        position: relative;
      }

      .pricing-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-lg);
      }

      .pricing-card.featured {
        border: 2px solid var(--primary-color);
        background: linear-gradient(180deg, color-mix(in srgb, var(--primary-color) 3%, transparent) 0%, var(--surface-white) 100%);
      }

      .pricing-card.featured:hover {
        box-shadow: var(--shadow-gold);
      }

      .pricing-badge {
        position: absolute;
        top: -14px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary-gradient);
        color: #fff;
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: var(--shadow-sm);
      }

      .pricing-card h3 {
        font-size: 1.8rem;
        margin-bottom: 16px;
        color: var(--secondary-color);
      }

      .pricing-price {
        font-size: 3rem;
        font-weight: 700;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
      }

      .pricing-price span {
        font-size: 1rem;
        -webkit-text-fill-color: var(--text-light);
        font-weight: 500;
      }

      .pricing-features {
        list-style: none;
        padding: 0;
        margin: 32px 0;
        text-align: left;
      }

      .pricing-features li {
        padding: 14px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        color: var(--text-light);
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .pricing-features li:last-child {
        border-bottom: none;
      }

      .pricing-features li i {
        color: var(--primary-color);
        font-size: 0.75rem;
        width: 22px;
        height: 22px;
        background: color-mix(in srgb, var(--primary-color) 10%, transparent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }

      .pricing-features li.disabled {
        opacity: 0.4;
      }

      .pricing-features li.disabled i {
        background: rgba(0, 0, 0, 0.05);
        color: var(--text-muted);
      }

      .btn-pricing {
        background: var(--primary-gradient);
        color: #fff;
        padding: 16px 40px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: var(--transition-smooth);
        margin-top: 20px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        font-size: 0.9rem;
      }

      .btn-pricing::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
      }

      .btn-pricing:hover::before {
        left: 100%;
      }

      .btn-pricing:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-gold);
      }

      /* Gallery Section */
      .gallery-section {
        padding: 120px 0;
        background: var(--surface-white);
      }

      .gallery-filters {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 50px;
        flex-wrap: wrap;
      }

      .gallery-filter {
        padding: 12px 28px;
        background: var(--surface-white);
        border: 1px solid color-mix(in srgb, var(--primary-color) 30%, transparent);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        color: var(--secondary-color);
      }

      .gallery-filter:hover {
        border-color: var(--primary-color);
        background: color-mix(in srgb, var(--primary-color) 5%, transparent);
      }

      .gallery-filter.active {
        background: var(--primary-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: var(--shadow-gold);
      }

      .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
      }

      .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        height: 320px;
        cursor: pointer;
        transition: var(--transition-smooth);
        box-shadow: var(--shadow-sm);
      }

      .gallery-item:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-lg);
      }

      .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition-smooth);
      }

      .gallery-item:hover img {
        transform: scale(1.08);
      }

      .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, color-mix(in srgb, var(--primary-color) 90%, transparent) 0%, color-mix(in srgb, var(--primary-dark) 85%, transparent) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition-smooth);
      }

      .gallery-item:hover .gallery-overlay {
        opacity: 1;
      }

      .gallery-overlay i {
        font-size: 2.5rem;
        color: #fff;
        transform: scale(0.5);
        transition: var(--transition-bounce);
      }

      .gallery-item:hover .gallery-overlay i {
        transform: scale(1);
      }

      /* Lightbox */
      .lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: color-mix(in srgb, var(--secondary-color) 98%, transparent);
        backdrop-filter: blur(10px);
        z-index: 9999;
        justify-content: center;
        align-items: center;
      }

      .lightbox.active {
        display: flex;
      }

      .lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 16px;
        box-shadow: var(--shadow-xl);
      }

      .lightbox-close {
        position: absolute;
        top: 30px;
        right: 30px;
        font-size: 2.5rem;
        color: rgba(255, 255, 255, 0.8);
        cursor: pointer;
        transition: var(--transition-smooth);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
      }

      .lightbox-close:hover {
        color: #fff;
        background: var(--primary-color);
        transform: rotate(90deg);
      }

      /* Testimonials Section */
      .testimonials-section {
        padding: 120px 0;
        background: var(--light-bg);
        position: relative;
      }

      .testimonial-slider {
        max-width: 850px;
        margin: 0 auto;
        position: relative;
      }

      .testimonial-card {
        background: var(--surface-white);
        padding: 50px 45px;
        border-radius: 24px;
        box-shadow: var(--shadow-md);
        text-align: center;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.03);
      }

      .testimonial-card::before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 30px;
        font-size: 6rem;
        font-family: "Playfair Display", serif;
        color: color-mix(in srgb, var(--primary-color) 15%, transparent);
        line-height: 1;
      }

      .testimonial-image {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        margin: 0 auto 28px;
        border: 4px solid var(--primary-color);
        overflow: hidden;
        box-shadow: var(--shadow-gold);
        position: relative;
        z-index: 1;
      }

      .testimonial-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .testimonial-text {
        font-size: 1.15rem;
        font-style: italic;
        color: var(--text-light);
        margin-bottom: 28px;
        line-height: 1.9;
        position: relative;
        z-index: 1;
      }

      .testimonial-author {
        font-weight: 600;
        color: var(--secondary-color);
        font-size: 1.1rem;
        margin-bottom: 4px;
      }

      .testimonial-role {
        color: var(--primary-color);
        font-size: 0.9rem;
        font-weight: 500;
      }

      .testimonial-rating {
        margin-top: 18px;
        display: flex;
        justify-content: center;
        gap: 4px;
      }

      .testimonial-rating i {
        color: var(--primary-color);
      }

      .slider-controls {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
      }

      .slider-btn {
        background: var(--primary-color);
        color: #fff;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .slider-btn:hover {
        background: var(--accent-color);
        transform: scale(1.1);
      }

      /* FAQ Section */
      .faq-section {
        padding: 100px 0;
      }

      .faq-container {
        max-width: 900px;
        margin: 0 auto;
      }

      .faq-item {
        background: #fff;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
      }

      .faq-question {
        padding: 25px 30px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        background: #fff;
      }

      .faq-question:hover {
        background: var(--light-bg);
      }

      .faq-question h4 {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin: 0;
        flex: 1;
      }

      .faq-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        transition: transform 0.3s ease;
      }

      .faq-item.active .faq-icon {
        transform: rotate(180deg);
      }

      .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
      }

      .faq-answer-content {
        padding: 0 30px 25px;
        color: var(--text-light);
        line-height: 1.8;
      }

      /* Service Areas Section */
      .service-areas-section {
        padding: 100px 0;
        background: #fff;
        position: relative;
        overflow: hidden;
      }
      
      .service-areas-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 10% 20%, color-mix(in srgb, var(--primary-color) 5%, transparent) 0%, transparent 20%),
                    radial-gradient(circle at 90% 80%, color-mix(in srgb, var(--secondary-color) 3%, transparent) 0%, transparent 20%);
        pointer-events: none;
        pointer-events: none;
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
        z-index: 1;
      }

      .area-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        border-bottom: 3px solid var(--primary-color);
      }
      
      .area-card::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, transparent 50%, color-mix(in srgb, var(--primary-color) 5%, transparent) 50%);
        border-radius: 0 10px 0 300px;
        transition: all 0.5s ease;
      }
      
      .area-card:hover::after {
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, transparent 50%, color-mix(in srgb, var(--primary-color) 10%, transparent) 50%);
      }

      .area-icon {
        width: 60px;
        height: 60px;
        background: color-mix(in srgb, var(--primary-color) 10%, transparent);
        color: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
        transition: all 0.3s ease;
      }
      
      .area-card:hover .area-icon {
        background: var(--primary-color);
        color: #fff;
        transform: rotateY(180deg);
      }

      .area-card h3 {
        font-size: 1.4rem;
        margin-bottom: 15px;
        color: var(--secondary-color);
      }

      .area-card p {
        color: var(--text-light);
        font-size: 0.95rem;
        margin-bottom: 20px;
        line-height: 1.6;
      }
      
      .area-link {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        transition: gap 0.3s ease;
      }
      
      .area-link:hover {
        gap: 12px;
        color: var(--accent-color);
      }

      .btn-view-all {
        background: var(--primary-color);
        color: #fff;
        padding: 15px 50px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      }

      .btn-view-all:hover {
        background: var(--accent-color);
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px color-mix(in srgb, var(--primary-color) 40%, transparent);
      }

      /* Contact Section */
      .contact-section {
        padding: 100px 0;
        background: var(--light-bg);
      }

      .contact-container {
        display: flex;
        gap: 50px;
        align-items: stretch;
      }

      .contact-info {
        flex: 1;
      }

      .contact-info h3 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--secondary-color);
      }

      .contact-info p {
        color: var(--text-light);
        margin-bottom: 30px;
        line-height: 1.8;
      }

      .contact-item {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
      }

      .contact-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.5rem;
      }

      .contact-details h5 {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin-bottom: 5px;
      }

      .contact-details p {
        margin: 0;
        color: var(--text-light);
      }

      .contact-map-section {
        margin-top: 30px;
        width: 100%;
      }

      .contact-map-section h5 {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .contact-map-section h5 i {
        color: var(--primary-color);
      }

      .contact-map {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 450px;
        width: 100%;
      }

      .contact-map:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
      }

      .contact-map iframe {
        display: block;
        width: 100%;
        height: 100%;
      }

      .contact-form {
        flex: 1;
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      }

      .form-group {
        margin-bottom: 25px;
      }

      .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--secondary-color);
        font-weight: 600;
      }

      .form-group input,
      .form-group textarea,
      .form-group select {
        width: 100%;
        padding: 15px;
        border: 2px solid #eee;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
      }

      .form-group input:focus,
      .form-group textarea:focus,
      .form-group select:focus {
        outline: none;
        border-color: var(--primary-color);
      }

      .form-group textarea {
        resize: vertical;
        min-height: 120px;
      }

      .btn-submit {
        background: var(--primary-color);
        color: #fff;
        padding: 15px 50px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
      }

      .btn-submit:hover {
        background: var(--accent-color);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px color-mix(in srgb, var(--primary-color) 40%, transparent);
      }

        /* Footer styles removed - moved to partial */

      /* Scroll to top button */
      .scroll-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 999;
      }

      .scroll-top.active {
        opacity: 1;
        visibility: visible;
      }

      .scroll-top:hover {
        background: var(--accent-color);
        transform: translateY(-5px);
      }

      /* Service Detail Modal */
      .service-detail-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10000;
        overflow-y: auto;
      }

      .service-detail-modal.active {
        display: block;
      }

      .service-detail-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 10001;
      }

      .service-detail-content {
        position: relative;
        max-width: 1200px;
        margin: 50px auto;
        background: #fff;
        border-radius: 20px;
        z-index: 10002;
        animation: slideDown 0.4s ease;
      }

      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-50px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .service-detail-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10003;
      }

      .service-detail-close:hover {
        background: var(--accent-color);
        transform: rotate(90deg);
      }

      .service-detail-body {
        padding: 50px;
      }

      .service-detail-header {
        text-align: center;
        margin-bottom: 50px;
      }

      .service-detail-header h2 {
        font-size: 3rem;
        color: var(--secondary-color);
        margin-bottom: 15px;
      }

      .service-detail-header p {
        font-size: 1.2rem;
        color: var(--text-light);
      }

      .service-detail-banner {
        width: 100%;
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 50px;
      }

      .service-detail-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .service-description {
        margin-bottom: 50px;
      }

      .service-description h3 {
        font-size: 2rem;
        color: var(--secondary-color);
        margin-bottom: 20px;
      }

      .service-description p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-light);
        margin-bottom: 15px;
      }

      .service-highlights {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin: 40px 0;
      }

      .highlight-box {
        background: var(--light-bg);
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s ease;
      }

      .highlight-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      }

      .highlight-box i {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 15px;
      }

      .highlight-box h4 {
        font-size: 1.3rem;
        color: var(--secondary-color);
        margin-bottom: 10px;
      }

      .highlight-box p {
        font-size: 0.95rem;
        color: var(--text-light);
        margin: 0;
      }

      .package-comparison {
        margin-top: 60px;
      }

      .package-comparison h3 {
        font-size: 2.5rem;
        color: var(--secondary-color);
        text-align: center;
        margin-bottom: 40px;
      }

      .package-table {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      }

      .package-table table {
        width: 100%;
        border-collapse: collapse;
      }

      .package-table thead {
        background: var(--secondary-color);
      }

      .package-table th {
        padding: 25px 20px;
        color: #fff;
        font-size: 1.3rem;
        font-weight: 600;
        text-align: center;
      }

      .package-table th:first-child {
        text-align: left;
      }

      .package-table td {
        padding: 20px;
        border-bottom: 1px solid #eee;
        text-align: center;
        color: var(--text-light);
      }

      .package-table td:first-child {
        text-align: left;
        font-weight: 600;
        color: var(--secondary-color);
      }

      .package-table tbody tr:hover {
        background: var(--light-bg);
      }

      .package-table .check-icon {
        color: var(--primary-color);
        font-size: 1.5rem;
      }

      .package-table .cross-icon {
        color: #ccc;
        font-size: 1.5rem;
      }

      .package-price-row td {
        background: var(--light-bg);
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
        padding: 30px 20px;
      }

      .package-price-row td:first-child {
        color: var(--secondary-color);
        font-size: 1.2rem;
      }

      .featured-package {
        background: linear-gradient(
          135deg,
          rgba(212, 175, 55, 0.1),
          rgba(212, 175, 55, 0.05)
        );
      }

      .detail-cta {
        text-align: center;
        margin-top: 50px;
        padding: 40px;
        background: var(--light-bg);
        border-radius: 15px;
      }

      .detail-cta h3 {
        font-size: 2rem;
        color: var(--secondary-color);
        margin-bottom: 20px;
      }

      .detail-cta p {
        font-size: 1.1rem;
        color: var(--text-light);
        margin-bottom: 30px;
      }

      /* Leadership & Vision Section */
      .leadership-section {
        padding: 120px 0;
        background: linear-gradient(180deg, var(--surface-white) 0%, var(--light-bg) 50%, var(--surface-white) 100%);
        position: relative;
        overflow: hidden;
      }

      .leadership-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
          radial-gradient(ellipse at 0% 0%, rgba(201, 162, 39, 0.08) 0%, transparent 50%),
          radial-gradient(ellipse at 100% 100%, rgba(201, 162, 39, 0.06) 0%, transparent 50%),
          radial-gradient(ellipse at 50% 50%, rgba(15, 15, 15, 0.02) 0%, transparent 70%);
        pointer-events: none;
      }

      .leadership-section::after {
        content: "";
        position: absolute;
        top: 50%;
        right: -200px;
        width: 400px;
        height: 400px;
        border: 1px solid rgba(201, 162, 39, 0.1);
        border-radius: 50%;
        transform: translateY(-50%);
        pointer-events: none;
      }

      .leader-image-wrapper {
        position: relative;
        padding: 10px;
      }

      .leader-image-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 120px;
        height: 120px;
        border-top: 4px solid var(--primary-color);
        border-left: 4px solid var(--primary-color);
        border-radius: 8px 0 0 0;
        transition: var(--transition-smooth);
      }

      .leader-image-wrapper::after {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        width: 120px;
        height: 120px;
        border-bottom: 4px solid var(--primary-color);
        border-right: 4px solid var(--primary-color);
        border-radius: 0 0 8px 0;
        transition: var(--transition-smooth);
      }

      .leader-image-wrapper:hover::before,
      .leader-image-wrapper:hover::after {
        width: 140px;
        height: 140px;
      }

      .leader-image {
        width: 100%;
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        filter: grayscale(15%);
        transition: var(--transition-smooth);
        position: relative;
        z-index: 1;
      }

      .leader-image:hover {
        filter: grayscale(0%);
        transform: scale(1.02);
        box-shadow: var(--shadow-xl);
      }

      .leader-badge {
        position: absolute;
        bottom: 50px;
        right: 50px;
        background: var(--primary-gradient);
        color: #fff;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: var(--shadow-gold);
        z-index: 2;
        animation: float-gentle 3s ease-in-out infinite;
      }

      .leader-badge i {
        font-size: 1.5rem;
        margin-right: 8px;
      }

      .leader-badge span {
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
      }

      .leader-subtitle {
        color: var(--primary-color);
        letter-spacing: 3px;
        text-transform: uppercase;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .leader-subtitle::before {
        content: "";
        width: 40px;
        height: 2px;
        background: var(--primary-gradient);
        border-radius: 2px;
      }

      .leader-name {
        font-size: 2.8rem;
        font-family: 'Playfair Display', serif;
        color: var(--secondary-color);
        margin-bottom: 24px;
        line-height: 1.2;
      }

      .leader-quote-box {
        background: linear-gradient(135deg, rgba(201, 162, 39, 0.05) 0%, rgba(255, 255, 255, 0.9) 100%);
        padding: 32px 36px;
        border-left: 4px solid var(--primary-color);
        border-radius: 0 16px 16px 0;
        margin-bottom: 32px;
        position: relative;
        box-shadow: var(--shadow-sm);
      }

      .leader-quote-box::before {
        content: '"';
        position: absolute;
        top: -10px;
        left: 20px;
        font-size: 5rem;
        font-family: 'Playfair Display', serif;
        color: rgba(201, 162, 39, 0.15);
        line-height: 1;
      }

      .leader-bio {
        font-style: italic;
        font-size: 1.15rem;
        color: var(--text-dark);
        line-height: 1.8;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
      }

      .leader-why {
        font-size: 0.95rem;
        color: var(--text-light);
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin: 0;
      }

      .leader-why strong {
        color: var(--primary-color);
        white-space: nowrap;
      }

      .leader-background {
        margin-bottom: 36px;
        padding: 24px;
        background: var(--surface-white);
        border-radius: 16px;
        box-shadow: var(--shadow-xs);
        border: 1px solid rgba(0, 0, 0, 0.04);
      }

      .leader-background-title {
        font-size: 1.1rem;
        color: var(--secondary-color);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
      }

      .leader-background-title i {
        width: 36px;
        height: 36px;
        background: rgba(201, 162, 39, 0.1);
        color: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
      }

      .leader-background p {
        color: var(--text-light);
        line-height: 1.75;
        margin: 0;
        padding-left: 48px;
      }

      .vision-mission-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
      }

      .vision-card {
        background: var(--surface-white);
        padding: 32px 28px;
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.03);
      }

      .vision-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: var(--transition-smooth);
      }

      .vision-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-md);
      }

      .vision-card:hover::before {
        transform: scaleX(1);
      }

      .vision-card.mission-card::before {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #333 100%);
      }

      .vision-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.4rem;
        transition: var(--transition-smooth);
      }

      .vision-card:hover .vision-icon {
        transform: rotateY(180deg);
      }

      .vision-icon.gold {
        background: rgba(201, 162, 39, 0.1);
        color: var(--primary-color);
      }

      .vision-icon.dark {
        background: rgba(15, 15, 15, 0.08);
        color: var(--secondary-color);
      }

      .vision-card h4 {
        font-size: 1.25rem;
        margin-bottom: 12px;
        color: var(--secondary-color);
      }

      .vision-card p {
        font-size: 0.95rem;
        color: var(--text-light);
        line-height: 1.7;
        margin: 0;
      }

      /* Decorative Elements */
      .leadership-decoration {
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(201, 162, 39, 0.08) 0%, transparent 70%);
        pointer-events: none;
        animation: pulse-glow 4s ease-in-out infinite;
      }

      .leadership-decoration.top-right {
        top: -100px;
        right: -100px;
      }

      .leadership-decoration.bottom-left {
        bottom: -100px;
        left: -100px;
      }

      @media (max-width: 991.98px) {
        .leader-name {
          font-size: 2.2rem;
        }
        
        .vision-mission-grid {
          grid-template-columns: 1fr;
        }
        
        .leader-badge {
          bottom: 40px;
          right: 40px;
          padding: 12px 18px;
        }
        
        .leader-image-wrapper::before,
        .leader-image-wrapper::after {
          width: 80px;
          height: 80px;
        }
      }

      @media (max-width: 768px) {
        .leadership-section {
          padding: 80px 0;
        }
        
        .leader-name {
          font-size: 1.8rem;
        }
        
        .leader-quote-box {
          padding: 24px;
        }
        
        .leader-bio {
          font-size: 1rem;
        }
        
        .leader-badge {
          display: none;
        }
      }

      /* Responsive */
      @media (max-width: 991.98px) {
        .about-content {
          flex-direction: column;
          gap: 30px;
        }
        
        .about-image, .about-text {
          width: 100%;
        }

        .navbar-brand {
          font-size: 1.5rem;
        }
      }

      @media (max-width: 768px) {
        .about-section, .services-section, .pricing-section, .gallery-section, .testimonials-section, .faq-section, .contact-section {
          padding: 60px 0;
        }

        .hero-content h1 {
          font-size: 2.2rem;
        }

        .hero-content p {
          font-size: 1.1rem;
        }

        .section-title h2 {
          font-size: 2rem;
        }

        .stats-container {
          flex-direction: column;
          gap: 20px;
        }

        .contact-container {
          flex-direction: column;
        }

        .contact-map {
          height: 300px;
        }

        .pricing-tabs {
          flex-direction: column;
          align-items: center;
          gap: 10px;
        }

        .gallery-grid {
          grid-template-columns: 1fr;
        }

        .service-detail-body {
          padding: 20px;
        }

        .service-detail-header h2 {
          font-size: 1.8rem;
        }

        .package-table {
          display: block;
          overflow-x: auto;
          white-space: nowrap;
        }

        .package-table th,
        .package-table td {
          padding: 12px 10px;
          font-size: 0.85rem;
        }

        /* Ensure hero takes full height even on mobile */
        .hero-section, .carousel-item {
          height: 100vh !important;
          min-height: 600px; /* Ensure space for content */
        }
      }

      @media (max-width: 480px) {
        .hero-content h1 {
          font-size: 1.8rem;
        }
        
        .btn-primary-custom {
          padding: 12px 30px;
          font-size: 1rem;
        }
        
        .section-title h2 {
          font-size: 1.8rem;
        }
      }
      /* YouTube Background Fix */
      .youtube-bg {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100vw;
        height: 100vh;
        transform: translate(-50%, -50%) scale(1.05); /* Reduced scale from 1.3 to 1.05 to minimize zoom */
        pointer-events: none;
      }

      @media (min-aspect-ratio: 16/9) {
        .youtube-bg {
          height: 56.25vw;
        }
      }

      @media (max-aspect-ratio: 16/9) {
        .youtube-bg {
          width: 177.78vh;
        }
      }

      /* Enhanced Service Card Styles - Compact Hover Reveal */
      .service-card {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow-sm);
        height: 300px; /* Reduced fixed height */
        background: #000;
        margin-bottom: 20px;
      }
      
      .service-image {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
      }
      
      .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.2, 1, 0.2, 1);
        opacity: 0.95;
      }
      
      .service-card:hover .service-image img {
        transform: scale(1.1);
        opacity: 0.7;
      }
      
      .service-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%, transparent 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 24px;
        transition: background 0.3s ease;
        z-index: 2;
      }
      
      .service-card:hover .service-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.7) 60%, rgba(0,0,0,0.2) 100%);
      }
      
      .service-content-overlay {
        transform: translateY(35px); /* Start lower to show just title */
        transition: transform 0.4s cubic-bezier(0.2, 1, 0.2, 1);
        width: 100%;
      }
      
      .service-card:hover .service-content-overlay {
        transform: translateY(0);
      }
      
      .service-content-overlay h3 {
        color: #fff;
        font-family: "Playfair Display", serif;
        font-size: 1.5rem;
        margin-bottom: 4px;
        text-shadow: 0 2px 8px rgba(0,0,0,0.5);
        font-weight: 600;
        transform-origin: left;
        transition: transform 0.3s ease;
      }
      
      .service-card:hover .service-content-overlay h3 {
        transform: translateY(-2px);
        color: var(--primary-color);
      }
      
      .service-content-overlay p {
        color: rgba(255,255,255,0.85);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 12px;
        opacity: 0;
        max-height: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limit to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: all 0.4s ease;
      }
      
      .service-card:hover .service-content-overlay p {
        opacity: 1;
        max-height: 50px; /* Approximately 2 lines */
        margin-bottom: 15px;
      }
      
      .service-link-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary-color);
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease 0.1s;
        text-decoration: none;
      }
      
      .service-card:hover .service-link-btn {
        opacity: 1;
        transform: translateY(0);
      }
      
      .service-link-btn i {
        font-size: 0.8rem;
        transition: transform 0.3s ease;
      }
      
      .service-link-btn:hover {
        color: #fff;
      }
      
      .service-link-btn:hover i {
        transform: translateX(3px);
      }

    </style>
  </head>
  <body>
    <!-- Navbar -->
    @include('layouts.partials.navbar')

    <!-- Dynamic Homepage Sections -->
    @if(isset($homepageSections) && $homepageSections->count() > 0)
        @foreach($homepageSections as $section)
             @if(View::exists('sections.' . $section->name))
                @include('sections.' . $section->name)
             @endif
        @endforeach
    @else
        <!-- Fallback if no sections defined (prevent empty page) -->
        @include('sections.hero')
        @include('sections.mission_vision')
        @include('sections.services')
        @include('sections.about')
        @include('sections.gallery')
        @include('sections.testimonials')
        @include('sections.faq')
        @include('sections.service_areas')
        @include('sections.contact')
    @endif

    <!-- Service Detail Modal -->
    <div class="service-detail-modal" id="serviceDetailModal">
      <div class="service-detail-overlay" onclick="closeServiceDetail()"></div>
      <div class="service-detail-content">
        <button class="service-detail-close" onclick="closeServiceDetail()">
          <i class="fas fa-times"></i>
        </button>
        <div class="service-detail-body" id="serviceDetailBody">
          <!-- Content will be dynamically loaded here -->
        </div>
      </div>
    </div>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
      <span class="lightbox-close">&times;</span>
      <img src="" alt="Gallery Image" id="lightbox-img" />
    </div>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop" onclick="scrollToTop()">
      <i class="fas fa-arrow-up"></i>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
      // Initialize AOS with Enhanced Settings
      AOS.init({
        duration: 800, // Slightly faster for snappier feel
        easing: 'ease-out-cubic', // Smooth easing
        once: true, // Animation happens only once
        offset: 120, // Trigger animations earlier
        delay: 0, // No global delay
        anchorPlacement: 'top-bottom', // Trigger when element's top hits bottom of viewport
        disable: function() {
          // Disable on mobile if performance is a concern
          return window.innerWidth < 768 ? false : false;
        }
      });

      // Navbar scroll effect
      window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        const scrollTop = document.getElementById("scrollTop");

        if (window.scrollY > 100) {
          navbar.style.background = "rgba(26, 26, 26, 0.98)";
          scrollTop.classList.add("active");
        } else {
          navbar.style.background = "transparent";
          scrollTop.classList.remove("active");
        }
      });

      // Smooth scroll for navigation links
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute("href"));
          if (target) {
            target.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        });
      });

      // Pricing tabs
      function showPricing(category) {
        // Hide all pricing content
        document.querySelectorAll(".pricing-content").forEach((content) => {
          content.classList.remove("active");
        });

        // Remove active class from all tabs
        document.querySelectorAll(".pricing-tab").forEach((tab) => {
          tab.classList.remove("active");
        });

        // Show selected pricing content
        document.getElementById(category + "-pricing").classList.add("active");

        // Add active class to clicked tab
        event.target.classList.add("active");
      }

      // Gallery filter
      function filterGallery(category) {
        const items = document.querySelectorAll(".gallery-item");
        const filters = document.querySelectorAll(".gallery-filter");

        // Remove active class from all filters
        filters.forEach((filter) => filter.classList.remove("active"));

        // Add active class to clicked filter
        event.target.classList.add("active");

        // Show/hide gallery items
        items.forEach((item) => {
          if (category === "all" || item.dataset.category === category) {
            item.style.display = "block";
            setTimeout(() => {
              item.style.opacity = "1";
              item.style.transform = "scale(1)";
            }, 10);
          } else {
            item.style.opacity = "0";
            item.style.transform = "scale(0.8)";
            setTimeout(() => {
              item.style.display = "none";
            }, 300);
          }
        });
      }

      // Lightbox functionality
      document.querySelectorAll(".gallery-item").forEach((item) => {
        item.addEventListener("click", function () {
          const imgSrc = this.querySelector("img").src;
          const lightbox = document.getElementById("lightbox");
          const lightboxImg = document.getElementById("lightbox-img");

          lightboxImg.src = imgSrc;
          lightbox.classList.add("active");
        });
      });

      function viewGalleryImage(src) {
        const lightbox = document.getElementById("lightbox");
        const lightboxImg = document.getElementById("lightbox-img");
        lightboxImg.src = src;
        lightbox.classList.add("active");
        document.body.style.overflow = "hidden";
      }

      function closeLightbox() {
        document.getElementById("lightbox").classList.remove("active");
        document.body.style.overflow = "auto";
      }

      // Testimonial slider
      let currentTestimonial = 1;
      const totalTestimonials = {{ $testimonials && $testimonials->count() > 0 ? $testimonials->count() : 1 }};

      function changeTestimonial(direction) {
        if (totalTestimonials <= 1) return;
        
        // Hide current testimonial
        const currentElement = document.getElementById("testimonial-" + currentTestimonial);
        if (currentElement) {
          currentElement.style.display = "none";
        }

        // Calculate new testimonial
        currentTestimonial += direction;

        // Loop around
        if (currentTestimonial > totalTestimonials) {
          currentTestimonial = 1;
        } else if (currentTestimonial < 1) {
          currentTestimonial = totalTestimonials;
        }

        // Show new testimonial
        const newElement = document.getElementById("testimonial-" + currentTestimonial);
        if (newElement) {
          newElement.style.display = "block";
        }
      }

      // Auto-advance testimonials
      @if($testimonials && $testimonials->count() > 1)
      setInterval(() => {
        changeTestimonial(1);
      }, 6000);
      @endif

      // FAQ toggle
      function toggleFaq(element) {
        const faqItem = element.parentElement;
        const answer = faqItem.querySelector(".faq-answer");
        const answerContent = answer.querySelector(".faq-answer-content");

        // Close all other FAQs
        document.querySelectorAll(".faq-item").forEach((item) => {
          if (item !== faqItem && item.classList.contains("active")) {
            item.classList.remove("active");
            item.querySelector(".faq-answer").style.maxHeight = "0";
          }
        });

        // Toggle current FAQ
        faqItem.classList.toggle("active");

        if (faqItem.classList.contains("active")) {
          answer.style.maxHeight = answerContent.offsetHeight + "px";
        } else {
          answer.style.maxHeight = "0";
        }
      }

      // Form submission
      function submitForm(e) {
        e.preventDefault();

        // Get form data
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);

        // Show success message
        alert(
          "Thank you for contacting us! We will get back to you within 24 hours."
        );

        // Reset form
        e.target.reset();

        // In a real application, you would send this data to your server
        console.log("Form submitted:", data);
      }

      // Scroll to top function
      function scrollToTop() {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      }

      // Dynamic Service Details
      @php
        $details = $eventTypes->mapWithKeys(function($type) {
            return [$type->slug => [
                'title' => $type->name,
                'subtitle' => 'Premium Event Services',
                'image' => $type->featured_image ? asset($type->featured_image) : 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'description' => $type->description,
                'tiers' => $type->pricingTiers
            ]];
        });
      @endphp
      const serviceDetails = @json($details);

      function showServiceDetail(serviceType) {
        const modal = document.getElementById("serviceDetailModal");
        const body = document.getElementById("serviceDetailBody");
        const service = serviceDetails[serviceType];

        if (!service) return;

        let tiersHTML = '<div class="row">';
        if (service.tiers && service.tiers.length > 0) {
            service.tiers.forEach(tier => {
                 tiersHTML += `
                 <div class="col-md-4 mb-3">
                    <div class="pricing-card h-100" style="padding: 20px; text-align: left;">
                        <h4 style="color: var(--primary-color)">${tier.tier_name}</h4>
                        <div class="pricing-price" style="font-size: 1.5rem; margin: 10px 0;">$${tier.price}</div>
                        <ul class="pricing-features" style="padding-left: 0; list-style: none;">
                            ${tier.features.map(f => `<li><i class="fas fa-check" style="color: var(--secondary-color); margin-right: 8px;"></i> ${f}</li>`).join('')}
                        </ul>
                    </div>
                 </div>
                 `;
            });
        } else {
            tiersHTML += '<div class="col-12"><p>Contact us for custom pricing.</p></div>';
        }
        tiersHTML += '</div>';

        body.innerHTML = `
            <div class="service-detail-header">
                <h2>${service.title}</h2>
                <p>${service.subtitle}</p>
            </div>
            <div class="service-detail-banner">
                <img src="${service.image}" alt="${service.title}">
            </div>
            <div class="service-description">
                <h3>About This Service</h3>
                ${service.description}
            </div>
            <div class="package-comparison">
                 <h3>Available Packages</h3>
                 ${tiersHTML}
            </div>
            <div class="detail-cta">
                <h3>Ready to Plan?</h3>
                <button class="btn-primary-custom" onclick="window.location.href='/events/${serviceType}'">View Full Details</button>
            </div>
        `;

        modal.classList.add("active");
        document.body.style.overflow = "hidden";
      }

      function showPricing(category) {
        const tabs = document.querySelectorAll('.pricing-tab');
        tabs.forEach(tab => {
            if(tab.getAttribute('onclick').includes(`('${category}')`)) {
                tab.classList.add('active');
            } else {
                tab.classList.remove('active');
            }
        });

        document.querySelectorAll('.pricing-content').forEach(content => {
            content.classList.remove('active');
            if (content.id === `${category}-pricing`) {
                content.classList.add('active');
            }
        });
      }

      function filterGallery(category) {
        const filters = document.querySelectorAll('.gallery-filter');
        filters.forEach(filter => {
             if(filter.getAttribute('onclick').includes(`('${category}')`)) {
                filter.classList.add('active');
            } else {
                filter.classList.remove('active');
            }
        });

        const items = document.querySelectorAll('.gallery-item');
        items.forEach(item => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        
        if(typeof AOS !== 'undefined') {
            AOS.refresh();
        }
      }


      function closeServiceDetail() {
        const modal = document.getElementById("serviceDetailModal");
        modal.classList.remove("active");
        document.body.style.overflow = "auto";
      }

      // Close modal on escape key
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          closeServiceDetail();
        }
      });

      // Counter animation for stats
      function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);

        const counter = setInterval(() => {
          start += increment;
          if (start >= target) {
            element.textContent = target + "+";
            clearInterval(counter);
          } else {
            element.textContent = Math.floor(start) + "+";
          }
        }, 16);
      }

      // Trigger counter animation when in viewport
      const observerOptions = {
        threshold: 0.5,
        rootMargin: "0px",
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (
            entry.isIntersecting &&
            !entry.target.classList.contains("counted")
          ) {
            entry.target.classList.add("counted");
            const target = parseInt(entry.target.textContent);
            animateCounter(entry.target, target);
          }
        });
      }, observerOptions);

      document.querySelectorAll(".stat-box h4").forEach((stat) => {
        observer.observe(stat);
      });
    </script>

    <!-- Carousel Video Optimization Script -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.getElementById('heroCarousel');
        
        if (myCarousel) {
          myCarousel.addEventListener('slide.bs.carousel', function (e) {
            // e.relatedTarget is the slide that is sliding into view
            // e.from is the index of the slide that is sliding out of view
            
            // Pause the current video
            var currentSlide = e.target.querySelectorAll('.carousel-item')[e.from];
            var currentVideo = currentSlide.querySelector('video');
            if (currentVideo) {
              currentVideo.pause();
            }
            
            // Play the next video
            var nextSlide = e.relatedTarget;
            var nextVideo = nextSlide.querySelector('video');
            if (nextVideo) {
              // Reset time to 0 to ensure it plays from start
              nextVideo.currentTime = 0;
              // Add a small delay to ensure transition is smooth
              setTimeout(() => {
                  var playPromise = nextVideo.play();
                  if (playPromise !== undefined) {
                    playPromise.catch(error => {
                      console.log("Auto-play was prevented");
                    });
                  }
              }, 500);
            }
          });
        }
      });
    </script>
    <!-- WhatsApp Floating Button -->
    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            left: 40px; /* Moved to left to avoid overlap */
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            color: white;
        }
        
        .whatsapp-float i {
            margin-top: 1px;
        }
    </style>
    @php
        $whatsappNumber = '1234567890'; // Default
        $contactInfo = \App\Models\ContactInfo::first();
        if($contactInfo && $contactInfo->phone) {
            $whatsappNumber = preg_replace('/[^0-9+]/', '', $contactInfo->phone);
        }
    @endphp
    <a href="https://wa.me/{{ $whatsappNumber }}" class="whatsapp-float" target="_blank" title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
  </body>
</html>