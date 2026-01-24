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
            --primary-color: #d4af37;
            --secondary-color: #1a1a1a;
            --accent-color: #c9a961;
            --light-bg: #f8f9fa;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; overflow-x: hidden; position: relative; }
        body { font-family: "Poppins", sans-serif; color: var(--text-dark); }
        h1, h2, h3, h4, h5, h6 { font-family: "Playfair Display", serif; }

        .navbar { 
            background: transparent; 
            backdrop-filter: none; 
            padding: 1.5rem 0; 
            box-shadow: none; 
            transition: all 0.3s ease; 
        }

        .navbar.scrolled { 
            background: rgba(26, 26, 26, 0.95); 
            backdrop-filter: blur(10px); 
            padding: 1rem 0; 
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1); 
        }
        .navbar-brand { font-family: "Playfair Display", serif; font-size: 1.8rem; font-weight: 700; color: var(--primary-color) !important; text-transform: uppercase; letter-spacing: 2px; }
        .navbar-nav .nav-link { color: #fff !important; margin: 0 15px; font-weight: 500; position: relative; transition: color 0.3s ease; }
        .navbar-nav .nav-link:hover { color: var(--primary-color) !important; }
        .navbar-nav .nav-link::after { content: ""; position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: var(--primary-color); transition: width 0.3s ease; }
        .navbar-nav .nav-link:hover::after { width: 100%; }

        /* Mobile Navbar background when toggled */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(26, 26, 26, 0.98);
                margin-top: 15px;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            }
            .navbar:not(.scrolled) .navbar-toggler {
                border-color: rgba(255, 255, 255, 0.5);
            }
        }
        .navbar-nav .nav-link.active { color: var(--primary-color) !important; }

        .btn-primary-custom { background: var(--primary-color); color: #fff; padding: 12px 35px; border: none; border-radius: 50px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; text-decoration: none; display: inline-block; }
        .btn-primary-custom:hover { background: var(--accent-color); color: #fff; transform: translateY(-3px); box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4); }

        .inner-page-hero { padding: 150px 0 100px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1472653431158-6364773b2a56?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; color: #fff; text-align: center; }
        .inner-page-hero h1 { font-size: 3.5rem; font-weight: 700; margin-bottom: 15px; }

        /* Footer styles removed - moved to partial */

        .alert-success { background: var(--primary-color); border: none; color: #fff; border-radius: 10px; }

        /* Responsive */
        @media (max-width: 991.98px) {
            .navbar-brand { font-size: 1.5rem; }
            .inner-page-hero h1 { font-size: 2.8rem; }
        }

        @media (max-width: 768px) {
            .inner-page-hero { padding: 120px 0 60px; }
            .inner-page-hero h1 { font-size: 2.2rem; }
            footer { padding: 60px 0 30px; }
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
</body>
</html>
