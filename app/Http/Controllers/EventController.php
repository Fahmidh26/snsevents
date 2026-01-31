<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use App\Models\PackageInquiry;
use App\Models\CustomPackageRequest;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PackageInquiryMail;
use App\Mail\CustomPackageRequestMail;

class EventController extends Controller
{
    public function index()
    {
        $eventTypes = EventType::where('status', true)
            ->with(['pricingTiers' => function($q) {
                $q->where('status', true)->orderBy('display_order');
            }])
            ->orderBy('display_order')->get();
        
        // Get all unique categories that are not null
        $categories = EventType::where('status', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        // Common Data for Layout
        $siteSettings = SiteSetting::first();
        $companyProfile = \App\Models\CompanyProfile::first();
        $contactInfo = \App\Models\ContactInfo::first();
        
        // SEO for Events Page
        $seo = new \stdClass();
        $seo->title = 'Our Services - SNS Events';
        $seo->meta_description = 'Explore our comprehensive list of event planning and decoration services.';
        $seo->meta_keywords = 'event planning, services, weddings, corporate events, sns events';
        $seo->og_image = $siteSettings->logo_path ? asset('storage/'.$siteSettings->logo_path) : null;

        $counselingSettings = \App\Models\CounselingSettings::getSettings();

        return view('events.index', compact('eventTypes', 'categories', 'siteSettings', 'companyProfile', 'contactInfo', 'seo', 'counselingSettings'));
    }

    public function show($slug)
    {
        $eventType = EventType::where('slug', $slug)->where('status', true)
            ->with(['galleries' => function($q) {
                $q->orderBy('display_order');
            }, 'pricingTiers' => function($q) {
                $q->where('status', true)->orderBy('display_order');
            }])
            ->firstOrFail();
        
        // Prepare SEO data with fallbacks
        $seo = (object) [
            'title' => $eventType->meta_title ?? $eventType->name . ' - SNS Events',
            'meta_description' => $eventType->meta_description ?? $eventType->description ?? 'Premium ' . $eventType->name . ' services by SNS Events.',
            'meta_keywords' => $eventType->meta_keywords ?? $eventType->name . ', event planning, decorations, texas',
            'og_title' => $eventType->og_title ?? $eventType->meta_title ?? $eventType->name . ' - SNS Events',
            'og_description' => $eventType->og_description ?? $eventType->meta_description ?? $eventType->description ?? 'Premium ' . $eventType->name . ' services by SNS Events.',
            'og_image' => $eventType->og_image ?? $eventType->featured_image ?? null
        ];
            
        return view('events.show', compact('eventType', 'seo'));
    }

    public function inquire(Request $request)
    {
        $request->validate([
            'pricing_tier_id' => 'required|exists:pricing_tiers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_date' => 'nullable|date',
            'message' => 'nullable|string',
        ]);

        $inquiry = PackageInquiry::create($request->all());

        // Send Email to Admin
        $adminEmail = SiteSetting::current()->admin_email;
        if ($adminEmail) {
            Mail::to($adminEmail)->send(new PackageInquiryMail($inquiry));
        }

        return back()->with('success', 'Your inquiry has been sent successfully. We will contact you soon!');
    }

    public function submitCustomRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_type' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'guest_count' => 'nullable|integer',
            'venue' => 'nullable|string|max:255',
            'budget' => 'nullable|numeric',
            'requirements' => 'nullable|string',
        ]);

        $customRequest = CustomPackageRequest::create($request->all());

        // Send Email to Admin
        $adminEmail = SiteSetting::current()->admin_email;
        if ($adminEmail) {
            Mail::to($adminEmail)->send(new CustomPackageRequestMail($customRequest));
        }

        return back()->with('success', 'Your custom request has been submitted successfully. We will get back to you with a quote!');
    }
}
