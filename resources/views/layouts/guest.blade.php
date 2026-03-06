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
        
        <style>
            .brand-color { color: #c9a227; }
            .brand-color-hover:hover { color: #d4af37; }
            .brand-bg { background-color: #c9a227; }
            .brand-bg:hover { background-color: #d4af37; }
            .brand-border { border-color: #c9a227; }
            .brand-focus:focus { 
                border-color: #c9a227; 
                --tw-ring-color: rgba(201, 162, 39, 0.5);
                box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.2);
                outline: none;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50" style="font-family: 'Inter', sans-serif;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-10 sm:pt-0 relative overflow-hidden w-full">
            
            <div class="relative z-10 w-full flex flex-col items-center px-4 mt-8 sm:mt-0">
                <div class="mb-8 text-center">
                    <a href="/" class="inline-block relative">
                        @if(isset($siteSettings) && $siteSettings->logo_path)
                            <img src="{{ Storage::url($siteSettings->logo_path) }}" alt="Logo" class="w-48 sm:w-56 h-auto" />
                        @else
                            <h1 class="text-4xl md:text-5xl font-bold font-serif brand-color tracking-widest uppercase relative z-10" style="font-family: 'Playfair Display', serif;">SNS Events</h1>
                            <p class="mt-2 text-xs text-gray-500 tracking-[0.2em] uppercase font-medium relative z-10">Where Dreams Meet Reality</p>
                        @endif
                    </a>
                </div>

                <div class="w-full sm:max-w-md bg-white border border-gray-100 shadow-xl rounded-2xl relative overflow-hidden">
                    <!-- Top accent line -->
                    <div class="absolute top-0 left-0 right-0 h-1 brand-bg"></div>
                    
                    <div class="px-6 py-8 sm:px-10 sm:py-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            
            <div class="relative z-10 mt-12 mb-4 text-center text-xs tracking-wider text-gray-400 font-medium uppercase">
                &copy; {{ date('Y') }} SNS Events. All rights reserved.
            </div>
        </div>
    </body>
</html>
