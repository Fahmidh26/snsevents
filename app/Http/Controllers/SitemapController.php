<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        // Static Routes
        $routes = [
            '/',
            '/about-us',
            '/service-areas',
            '/events',
            '/counseling',
            '/management-session',
            '/contact-info',
            '/custom-package',
        ];

        // Dynamic Event Pages
        // Using EventType as the model for "Services" or "Events"
        $events = EventType::where('status', true)->get();

        $content = view('sitemap', compact('routes', 'events'));

        return Response::make($content, 200, [
            'Content-Type' => 'text/xml',
        ]);
    }
}
