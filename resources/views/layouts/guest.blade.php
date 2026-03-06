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
            .brand-bg { background-color: #c9a227; color: white; }
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
    <body class="font-sans antialiased text-gray-900" style="font-family: 'Inter', sans-serif; background-color: #f9fafb;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden w-full">
            
            <div class="relative z-10 w-full flex flex-col items-center">
                <div class="mb-4 text-center">
                    <a href="/" class="inline-block relative">
                        @if(isset($siteSettings) && $siteSettings->logo_path)
                            <img src="{{ Storage::url($siteSettings->logo_path) }}" alt="Logo" class="w-32 h-auto" />
                        @else
                            <h1 class="text-4xl font-bold font-serif brand-color tracking-wider uppercase relative z-10" style="font-family: 'Playfair Display', serif;">SNS Events</h1>
                        @endif
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-8 py-8 border sm:rounded-2xl relative overflow-hidden" style="background-color: #ffffff; border-color: #f3f4f6; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); padding: 2rem;">
                    <!-- Top accent line -->
                    <div class="absolute top-0 left-0 right-0 h-1 brand-bg"></div>
                    
                    {{ $slot }}
                </div>
            </div>
            
            <div class="relative z-10 mt-6 mb-4 text-center text-xs tracking-wider font-medium uppercase" style="color: #9ca3af;">
                &copy; {{ date('Y') }} SNS Events. All rights reserved.
            </div>
        </div>
    </body>
</html>
