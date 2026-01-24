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
        $eventTypes = EventType::where('status', true)->orderBy('display_order')->get();
        return view('events.index', compact('eventTypes'));
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
            
        return view('events.show', compact('eventType'));
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
