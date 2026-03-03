<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $siteSettings->site_title ?? config('app.name', 'Laravel') }}</title>
        @if(isset($siteSettings) && $siteSettings->favicon_path)
            <link rel="shortcut icon" href="{{ Storage::url($siteSettings->favicon_path) }}" type="image/x-icon">
        @else
            <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        @endif
        @include('layouts.partials.schema')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-white antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            
            <!-- Background Image & Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1519167758481-83f29da8c8f0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Background" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black/70 mix-blend-multiply"></div>
                <!-- Gradient to match frontend -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#0f0f0f]/80 via-black/50 to-transparent"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col items-center">
                <div class="mb-4">
                    <a href="/">
                        @if(isset($siteSettings) && $siteSettings->logo_path)
                            <img src="{{ Storage::url($siteSettings->logo_path) }}" alt="Logo" class="w-32 h-auto hover:scale-105 transition-transform duration-300 drop-shadow-[0_0_15px_rgba(201,162,39,0.3)]" />
                        @else
                            <h1 class="text-4xl font-bold font-serif text-[#c9a227] tracking-wider uppercase drop-shadow-lg" style="font-family: 'Playfair Display', serif;">SNS Events</h1>
                        @endif
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-[#0f0f0f]/60 backdrop-blur-xl border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.5)] sm:rounded-2xl relative">
                    <!-- Subtle top highlight for glass card -->
                    <div class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-[#c9a227]/50 to-transparent"></div>
                    
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
