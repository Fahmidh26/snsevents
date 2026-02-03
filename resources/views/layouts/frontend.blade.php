<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @if(isset($siteSettings) && $siteSettings->favicon_path)
        <link rel="shortcut icon" href="{{ Storage::url($siteSettings->favicon_path) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif
    <title>@yield('title', ($siteSettings->site_title ?? 'SNS Events') . ' - Premium Event Planning')</title>
    @yield('meta')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        html { scroll-behavior: smooth; }
        
        html, body { width: 100%; overflow-x: hidden; position: relative; }
        
        body { 
            font-family: "Poppins", sans-serif; 
            color: var(--text-dark); 
            background: var(--surface-white);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        h1, h2, h3, h4, h5, h6 { 
            font-family: "Playfair Display", serif;
            font-weight: 600;
            line-height: 1.3;
        }

        /* Navbar - Premium Design */
        .navbar {
            background: transparent;
            backdrop-filter: none;
            padding: 15px 0;
            box-shadow: none;
            transition: var(--transition-smooth);
            z-index: 1000;
            height: auto;
        }

        .navbar.scrolled {
            background: color-mix(in srgb, var(--secondary-color) 90%, black);
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

        .navbar-nav .nav-link:hover::before,
        .navbar-nav .nav-link.active::before {
            width: 100%;
        }

        .navbar-nav .nav-link::after {
            display: none;
        }
        
        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
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
            .navbar-brand { font-size: 1.5rem; }
        }

        /* Buttons */
        .btn-primary-custom {
            background: var(--primary-gradient);
            color: #fff;
            padding: 12px 35px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition-smooth);
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 30px color-mix(in srgb, var(--primary-color) 30%, transparent);
        }
        
        .btn-primary-custom::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            color: #fff;
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-gold), 0 0 40px color-mix(in srgb, var(--primary-color) 40%, transparent);
        }

        /* Inner Page Hero - Preserved & Enhanced */
        .inner-page-hero { 
            padding: 150px 0 100px; 
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1472653431158-6364773b2a56?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); 
            background-size: cover; 
            background-position: center; 
            color: #fff; 
            text-align: center; 
        }
        .inner-page-hero h1 { 
            font-size: 3.5rem; 
            font-weight: 700; 
            margin-bottom: 15px;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
            letter-spacing: 2px;
        }

        .alert-success { background: var(--primary-color); border: none; color: #fff; border-radius: 10px; }

        /* Responsive */
        @media (max-width: 991.98px) {
            .inner-page-hero h1 { font-size: 2.8rem; }
        }

        @media (max-width: 768px) {
            .inner-page-hero { padding: 120px 0 60px; }
            .inner-page-hero h1 { font-size: 2.2rem; }
        }

        @media (max-width: 480px) {
            .inner-page-hero h1 { font-size: 1.8rem; }
            .btn-primary-custom { padding: 10px 25px; font-size: 0.9rem; }
        }

        @yield('styles')
    </style>
</head>
<body>
    <!-- Navbar -->
    <!-- Navbar -->
    @include('layouts.partials.navbar')

    <!-- Flash Messages -->
    <div style="position: fixed; top: 100px; right: 20px; z-index: 9999; max-width: 400px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg border-0" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fs-4 me-3"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0" role="alert">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-exclamation-circle fs-4 me-3"></i>
                    <strong>Please correct the errors:</strong>
                </div>
                <ul class="mb-0 ps-3 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @yield('content')

    @include('layouts.partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    @yield('scripts')
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
        $whatsappNumber = '1234567890';
        // Check if $contactInfo is available (from controller) or fetch it
        if(!isset($contactInfo)) {
             $contactInfo = \App\Models\ContactInfo::first();
        }
        
        if($contactInfo && $contactInfo->phone) {
            $whatsappNumber = preg_replace('/[^0-9+]/', '', $contactInfo->phone);
        }
    @endphp
    <a href="https://wa.me/{{ $whatsappNumber }}" class="whatsapp-float" target="_blank" title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
</body>
</html>
