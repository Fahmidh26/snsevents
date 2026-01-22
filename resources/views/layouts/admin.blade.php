<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - SNS Events</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#d4af37',
                        secondary: '#1a1a1a',
                        accent: '#c9a961',
                        'light-bg': '#f8f9fa',
                        dark: '#0f0f0f',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-secondary">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 z-50 w-64 bg-secondary text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shadow-xl flex flex-col">
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 border-b border-gray-800 bg-black/20">
                <h1 class="font-serif text-2xl font-bold text-primary tracking-widest">SNS EVENTS</h1>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 overflow-y-auto py-5 px-3 space-y-1">
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-2">Main</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                    Dashboard
                </a>

                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-6">Content Management</p>

                <a href="{{ route('hero.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('hero.*') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    Hero Slider
                </a>

                <a href="{{ route('about-us.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('about-us.edit') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-info-circle w-5 h-5 mr-3"></i>
                    About Us
                </a>

                <a href="{{ route('admin.event-types.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.event-types.*') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                    Event Types
                </a>

                <a href="{{ route('admin.pricing-tiers.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.pricing-tiers.*') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-tags w-5 h-5 mr-3"></i>
                    Pricing Tiers
                </a>
                
                <a href="{{ route('admin.galleries.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.galleries.*') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-images w-5 h-5 mr-3"></i>
                    Event Gallery
                </a>

                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-6">Requests & Inquiries</p>

                <a href="{{ route('admin.inquiries.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.inquiries.*') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-envelope-open-text w-5 h-5 mr-3"></i>
                    Package Inquiries
                </a>

                <a href="{{ route('admin.custom-requests.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.custom-requests.*') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-magic w-5 h-5 mr-3"></i>
                    Custom Requests
                </a>

                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-6">Settings</p>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.settings.index') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-cog w-5 h-5 mr-3"></i>
                    General Settings
                </a>

                <a href="{{ route('company-profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('company-profile.edit') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-building w-5 h-5 mr-3"></i>
                    Company Profile
                </a>

                <a href="{{ route('admin.seo.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.seo.*') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-search w-5 h-5 mr-3"></i>
                    SEO Settings
                </a>

                <a href="{{ route('admin.service-areas.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.service-areas.*') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-map-marker-alt w-5 h-5 mr-3"></i>
                    Service Areas
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('profile.edit') ? 'bg-primary/20 text-primary' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                    <i class="fas fa-user-cog w-5 h-5 mr-3"></i>
                    Admin Profile
                </a>
            </nav>

            <!-- User Info (Bottom Sidebar) -->
            <div class="p-4 border-t border-gray-800 bg-black/20">
                <div class="flex items-center">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-gray-400 hover:text-primary mt-1">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Top Header -->
            <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-6 shadow-sm z-10">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div class="flex items-center gap-4 ml-auto">
                   <a href="{{ url('/') }}" target="_blank" class="text-gray-500 hover:text-primary flex items-center gap-2 text-sm font-medium">
                       <i class="fas fa-external-link-alt"></i> Visit Website
                   </a>
                   <div class="h-8 w-px bg-gray-200 mx-2"></div>
                   <div class="flex items-center gap-2">
                       <div class="w-8 h-8 rounded-full bg-secondary text-primary flex items-center justify-center font-serif font-bold">
                           {{ substr(Auth::user()->name, 0, 1) }}
                       </div>
                   </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                <!-- Page Title -->
                @if(isset($header))
                    <div class="mb-8">
                        <h2 class="font-serif text-3xl font-bold text-secondary">
                            {{ $header }}
                        </h2>
                    </div>
                @endif

                <!-- Content -->
                {{ $slot }}
            </main>
        </div>

        <!-- Overlay for mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" x-cloak></div>
    </div>
</body>
</html>
