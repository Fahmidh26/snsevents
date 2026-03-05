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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-[#FCFBF8] selection:bg-[#c9a227] selection:text-white" style="font-family: 'Inter', sans-serif;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            
            <!-- Elegant Background Accents -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
                <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-gradient-to-br from-[#c9a227] to-transparent opacity-[0.05] blur-3xl"></div>
                <div class="absolute top-[60%] -right-[10%] w-[60%] h-[60%] rounded-full bg-gradient-to-tl from-[#c9a227] to-transparent opacity-[0.05] blur-3xl"></div>
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-30"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col items-center px-4">
                <div class="mb-10 text-center">
                    <a href="/" class="inline-block">
                        @if(isset($siteSettings) && $siteSettings->logo_path)
                            <img src="{{ Storage::url($siteSettings->logo_path) }}" alt="Logo" class="w-48 sm:w-56 h-auto hover:scale-105 transition-transform duration-500 ease-out" />
                        @else
                            <h1 class="text-4xl md:text-5xl font-bold font-serif text-[#c9a227] tracking-widest uppercase" style="font-family: 'Playfair Display', serif;">SNS Events</h1>
                            <p class="mt-2 text-xs text-gray-400 tracking-[0.2em] uppercase font-light">Where Dreams Meet Reality</p>
                        @endif
                    </a>
                </div>

                <div class="w-full sm:max-w-md bg-white border border-gray-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] rounded-2xl relative overflow-hidden">
                    <!-- Top accent line -->
                    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-transparent via-[#c9a227] to-transparent opacity-80"></div>
                    
                    <div class="px-8 py-10 sm:px-10 sm:py-12">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            
            <div class="relative z-10 mt-12 mb-8 text-center text-xs tracking-wider text-gray-400 font-medium uppercase">
                &copy; {{ date('Y') }} SNS Events. All rights reserved.
            </div>
        </div>
    </body>
</html>
