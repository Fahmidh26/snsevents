<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CustomPackageRequestController;
use App\Http\Controllers\Admin\EventGalleryController;
use App\Http\Controllers\Admin\EventTypeController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\PackageInquiryController;
use App\Http\Controllers\Admin\PricingTierController;
use App\Http\Controllers\Admin\SeoDetailController;
use App\Http\Controllers\Admin\ServiceAreaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\PrivacyPolicyController as FrontendPrivacyPolicyController;
use App\Http\Controllers\TermsAndConditionController as FrontendTermsAndConditionController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\Admin\CounselingController as AdminCounselingController;
use App\Http\Controllers\ManagementSessionController;
use App\Http\Controllers\Admin\ManagementSessionController as AdminManagementSessionController;
use App\Http\Controllers\CounselingTermController;
use App\Http\Controllers\Admin\CounselingTermController as AdminCounselingTermController;
use App\Http\Controllers\NewsletterSubscriptionController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\Admin\ContactSubmissionController as AdminContactSubmissionController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Temporary route to fix storage link on shared hosting
// Serving storage files via Laravel for shared hosting (when symlink is disabled)
Route::get('storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);

    if (!file_exists($filePath)) {
        abort(404);
    }

    return response()->file($filePath);
})->where('path', '.*');

Route::get('/', function () {
    $companyProfile = \App\Models\CompanyProfile::first();
    $aboutUs = \App\Models\AboutUs::first();
    $heroSlides = \App\Models\HeroSection::where('is_active', true)->orderBy('sort_order')->get();
    $eventTypes = \App\Models\EventType::where('status', true)
        ->with(['pricingTiers' => function($q) {
            $q->where('status', true)->orderBy('display_order');
        }, 'galleries' => function($q) {
            $q->orderBy('display_order');
        }])
        ->orderBy('display_order')
        ->get();

    // SEO and Service Areas
    $seo = \App\Models\SeoDetail::getByPage('homepage');
    // REMOVED ->take(6) TO SHOW ALL SERVICE AREAS
    $serviceAreas = \App\Models\ServiceArea::active()->get();

    // Dynamic sections
    $testimonials = \App\Models\Testimonial::active()->orderBy('display_order')->get();
    $faqs = \App\Models\FAQ::active()->orderBy('display_order')->get();
    $contactInfo = \App\Models\ContactInfo::first();
    $counselingSettings = \App\Models\CounselingSettings::getSettings();
    $managementSessionSettings = \App\Models\ManagementSessionSettings::getSettings();

    // Fetch homepage sections order and visibility
    $homepageSections = \App\Models\HomepageSection::where('is_visible', true)->orderBy('order')->get();

    return view('frontend', compact('companyProfile', 'aboutUs', 'heroSlides', 'eventTypes', 'seo', 'serviceAreas', 'testimonials', 'faqs', 'contactInfo', 'counselingSettings', 'managementSessionSettings', 'homepageSections'));
});

Route::get('/service-areas', function () {
    $companyProfile = \App\Models\CompanyProfile::first();
    $serviceAreas = \App\Models\ServiceArea::active()->get();
    $pageSettings = \App\Models\ServiceAreaPageSetting::firstOrCreate([], [
        'heading' => 'Areas We Serve',
        'subheading' => 'Bringing The Magic To Your Neighborhood',
    ]);
    
    // SEO object
    $seo = new \stdClass();
    $seo->title = $pageSettings->seo_title ?? 'Areas We Serve - SNS Events';
    $seo->meta_description = $pageSettings->seo_description ?? 'Explore the locations we serve across Texas. SNS Events brings premium event decoration to Dallas, Fort Worth, Austin, and beyond.';
    $seo->meta_keywords = $pageSettings->seo_keywords ?? 'service areas, texas event locations, dallas, fort worth, austin, san antonio';
    $seo->og_image = $pageSettings->hero_image_path ? asset('storage/' . $pageSettings->hero_image_path) : null;
    
    return view('service-areas', compact('companyProfile', 'serviceAreas', 'seo', 'pageSettings'));
})->name('service-areas');

Route::get('/about-us', function () {
    $companyProfile = \App\Models\CompanyProfile::first();
    $aboutUs = \App\Models\AboutUs::first();
    $contactInfo = \App\Models\ContactInfo::first();
    
    $seo = new \stdClass();
    $seo->title = $aboutUs->title ?? 'About SNS Events - Premium Event Planning';
    $seo->meta_description = $aboutUs->subtitle ?? 'Learn more about SNS Events, our mission, vision, and the team behind our premium event planning services.';
    $seo->meta_keywords = 'about sns events, event planners texas, event decorators, wedding planners';
    $seo->og_image = $aboutUs->image_path ? asset('storage/' . $aboutUs->image_path) : null;
    
    return view('about', compact('companyProfile', 'aboutUs', 'contactInfo', 'seo'));
})->name('about-us');

Route::get('/privacy-policy', [FrontendPrivacyPolicyController::class, 'index'])->name('privacy-policy');
Route::get('/terms-and-conditions', [FrontendTermsAndConditionController::class, 'index'])->name('terms-and-conditions');
Route::get('/counseling-terms', [CounselingTermController::class, 'index'])->name('counseling-terms');
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);

// SEO Redirects: Old /events/* URLs to new /services/* URLs (301 Permanent Redirect)
Route::get('/events', function() {
    return redirect('/services', 301);
});
Route::get('/events/{slug}', function($slug) {
    return redirect('/services/' . $slug, 301);
});

// Frontend Event Routes
Route::get('/services', [EventController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [EventController::class, 'show'])->name('services.show');
Route::post('/inquire', [EventController::class, 'inquire'])->name('inquire.store');
Route::get('/custom-package', function() {
    return view('events.custom');
})->name('custom-package');
Route::post('/custom-package/submit', [EventController::class, 'submitCustomRequest'])->name('custom-package.submit');

// Booking Tracking Routes
Route::get('/track-booking', [App\Http\Controllers\BookingLookupController::class, 'index'])->name('bookings.track');
Route::post('/track-booking', [App\Http\Controllers\BookingLookupController::class, 'lookup'])->name('bookings.lookup');

// Counseling Frontend Routes
Route::get('/counseling', [CounselingController::class, 'index'])->name('counseling');
Route::get('/counseling/slots', [CounselingController::class, 'getSlots'])->name('counseling.slots');
Route::post('/counseling/book', [StripeController::class, 'checkoutCounseling'])->name('counseling.book');
Route::get('/counseling/confirmation/{code}', [CounselingController::class, 'confirmation'])->name('counseling.confirmation');
Route::get('/counseling/payment/success/{code}', [StripeController::class, 'successCounseling'])->name('counseling.payment.success');
Route::get('/counseling/payment/cancel/{code}', [StripeController::class, 'cancelCounseling'])->name('counseling.payment.cancel');
Route::get('/counseling/reschedule/{code}', [\App\Http\Controllers\RescheduleController::class, 'showCounseling'])->name('counseling.reschedule');
Route::post('/counseling/reschedule/{code}', [\App\Http\Controllers\RescheduleController::class, 'submitCounseling'])->name('counseling.reschedule.submit');

// Management Session Frontend Routes
Route::get('/management-session', [ManagementSessionController::class, 'index'])->name('management-session');
Route::get('/management-session/slots', [ManagementSessionController::class, 'getSlots'])->name('management-session.slots');
Route::post('/management-session/book', [StripeController::class, 'checkoutManagement'])->name('management-session.book');
Route::get('/management-session/confirmation/{code}', [ManagementSessionController::class, 'confirmation'])->name('management-session.confirmation');
Route::get('/management-session/payment/success/{code}', [StripeController::class, 'successManagement'])->name('management-session.payment.success');
Route::get('/management-session/payment/cancel/{code}', [StripeController::class, 'cancelManagement'])->name('management-session.payment.cancel');
Route::get('/management-session/reschedule/{code}', [\App\Http\Controllers\RescheduleController::class, 'showManagement'])->name('management-session.reschedule');
Route::post('/management-session/reschedule/{code}', [\App\Http\Controllers\RescheduleController::class, 'submitManagement'])->name('management-session.reschedule.submit');

// Stripe Webhook (CSRF excluded via VerifyCsrfToken middleware)
Route::post('/stripe/webhook', [StripeController::class, 'webhook'])->name('stripe.webhook');

// Newsletter Subscription Route
Route::post('/newsletter/subscribe', [NewsletterSubscriptionController::class, 'subscribe'])->name('newsletter.subscribe');

// Contact Form Submission Route
Route::post('/contact/submit', [ContactSubmissionController::class, 'submit'])->name('contact.submit');

// Dashboard route moved to admin.php


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CEO Section Routes
    Route::get('/company-profile/edit', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
    Route::post('/company-profile/update', [CompanyProfileController::class, 'update'])->name('company-profile.update');

    // About Us Routes
    Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('about-us.edit');
    Route::post('/about-us/update', [AboutUsController::class, 'update'])->name('about-us.update');

    // Hero Section Routes
    Route::resource('hero', HeroSectionController::class)->except(['show']);

    // Admin Event Management Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::resource('event-types', EventTypeController::class);
        Route::resource('pricing-tiers', PricingTierController::class);
        Route::resource('galleries', EventGalleryController::class);
        
        Route::get('inquiries', [PackageInquiryController::class, 'index'])->name('inquiries.index');
        Route::patch('inquiries/{inquiry}/status', [PackageInquiryController::class, 'updateStatus'])->name('inquiries.update-status');
        Route::delete('inquiries/{inquiry}', [PackageInquiryController::class, 'destroy'])->name('inquiries.destroy');
        
        Route::get('custom-requests', [CustomPackageRequestController::class, 'index'])->name('custom-requests.index');
        Route::patch('custom-requests/{customRequest}/status', [CustomPackageRequestController::class, 'updateStatus'])->name('custom-requests.update-status');
        Route::delete('custom-requests/{customRequest}', [CustomPackageRequestController::class, 'destroy'])->name('custom-requests.destroy');
        
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [SettingController::class, 'update'])->name('settings.update');
        
        // SEO Management
        Route::get('seo', [SeoDetailController::class, 'index'])->name('seo.index');
        Route::get('seo/{id}/edit', [SeoDetailController::class, 'edit'])->name('seo.edit');
        Route::post('seo/{id}/update', [SeoDetailController::class, 'update'])->name('seo.update');
        
        // Service Areas Management
        Route::get('service-areas/settings', [ServiceAreaController::class, 'settings'])->name('service-areas.settings');
        Route::post('service-areas/settings', [ServiceAreaController::class, 'updateSettings'])->name('service-areas.settings.update');
        Route::resource('service-areas', ServiceAreaController::class);
        
        // Testimonials Management
        Route::resource('testimonials', TestimonialController::class);
        
        // FAQs Management
        Route::resource('faqs', FAQController::class);

        // Privacy Policy
        Route::get('privacy-policy', [PrivacyPolicyController::class, 'edit'])->name('privacy-policy.edit');
        Route::post('privacy-policy', [PrivacyPolicyController::class, 'update'])->name('privacy-policy.update');

        // Terms & Conditions
        Route::get('terms-and-conditions', [TermsAndConditionController::class, 'edit'])->name('terms-and-condition.edit');
        Route::post('terms-and-conditions', [TermsAndConditionController::class, 'update'])->name('terms-and-condition.update');

        // Counseling Terms
        Route::get('counseling-terms', [AdminCounselingTermController::class, 'edit'])->name('counseling-terms.edit');
        Route::post('counseling-terms', [AdminCounselingTermController::class, 'update'])->name('counseling-terms.update');

        // Counseling Management
        Route::get('counseling/settings', [AdminCounselingController::class, 'settings'])->name('counseling.settings');
        Route::post('counseling/settings', [AdminCounselingController::class, 'updateSettings'])->name('counseling.settings.update');
        Route::get('counseling/slots', [AdminCounselingController::class, 'slots'])->name('counseling.slots');
        Route::get('counseling/slots/create', [AdminCounselingController::class, 'createSlot'])->name('counseling.slots.create');
        Route::post('counseling/slots', [AdminCounselingController::class, 'storeSlot'])->name('counseling.slots.store');
        Route::get('counseling/slots/{id}/edit', [AdminCounselingController::class, 'editSlot'])->name('counseling.slots.edit');
        Route::put('counseling/slots/{id}', [AdminCounselingController::class, 'updateSlot'])->name('counseling.slots.update');
        Route::delete('counseling/slots/{id}', [AdminCounselingController::class, 'deleteSlot'])->name('counseling.slots.destroy');
        Route::get('counseling/bookings', [AdminCounselingController::class, 'bookings'])->name('counseling.bookings');
        Route::patch('counseling/bookings/{id}/status', [AdminCounselingController::class, 'updateBookingStatus'])->name('counseling.bookings.status');
        Route::delete('counseling/bookings/{id}', [AdminCounselingController::class, 'deleteBooking'])->name('counseling.bookings.destroy');
        Route::get('counseling/check-availability', [AdminCounselingController::class, 'checkSlotAvailability'])->name('counseling.check-availability');

        // Management Session Management
        Route::get('management-session/settings', [AdminManagementSessionController::class, 'settings'])->name('management-session.settings');
        Route::post('management-session/settings', [AdminManagementSessionController::class, 'updateSettings'])->name('management-session.settings.update');
        Route::get('management-session/slots', [AdminManagementSessionController::class, 'slots'])->name('management-session.slots');
        Route::get('management-session/slots/create', [AdminManagementSessionController::class, 'createSlot'])->name('management-session.slots.create');
        Route::post('management-session/slots', [AdminManagementSessionController::class, 'storeSlot'])->name('management-session.slots.store');
        Route::get('management-session/slots/{id}/edit', [AdminManagementSessionController::class, 'editSlot'])->name('management-session.slots.edit');
        Route::put('management-session/slots/{id}', [AdminManagementSessionController::class, 'updateSlot'])->name('management-session.slots.update');
        Route::delete('management-session/slots/{id}', [AdminManagementSessionController::class, 'deleteSlot'])->name('management-session.slots.destroy');
        Route::get('management-session/bookings', [AdminManagementSessionController::class, 'bookings'])->name('management-session.bookings');
        Route::patch('management-session/bookings/{id}/status', [AdminManagementSessionController::class, 'updateBookingStatus'])->name('management-session.bookings.status');
        Route::delete('management-session/bookings/{id}', [AdminManagementSessionController::class, 'deleteBooking'])->name('management-session.bookings.destroy');
        
        // Homepage Sections
        Route::get('homepage-sections', [App\Http\Controllers\Admin\HomepageSectionController::class, 'index'])->name('homepage-sections.index');
        Route::post('homepage-sections/update-order', [App\Http\Controllers\Admin\HomepageSectionController::class, 'updateOrder'])->name('homepage-sections.update-order');
        Route::post('homepage-sections/toggle-visibility', [App\Http\Controllers\Admin\HomepageSectionController::class, 'toggleVisibility'])->name('homepage-sections.toggle-visibility');
        
        // Navbar Management
        Route::resource('navbar-items', App\Http\Controllers\Admin\NavbarItemController::class);
        
        // Newsletter Management
        Route::get('newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
        Route::post('newsletter/{id}/toggle', [NewsletterController::class, 'toggleStatus'])->name('newsletter.toggle');
        Route::delete('newsletter/{id}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');
        Route::get('newsletter/export', [NewsletterController::class, 'export'])->name('newsletter.export');
        
        // Contact Submissions Management
        Route::get('contact-submissions', [AdminContactSubmissionController::class, 'index'])->name('contact-submissions.index');
        Route::get('contact-submissions/{id}', [AdminContactSubmissionController::class, 'show'])->name('contact-submissions.show');
        Route::post('contact-submissions/{id}/status', [AdminContactSubmissionController::class, 'updateStatus'])->name('contact-submissions.update-status');
        Route::post('contact-submissions/{id}/notes', [AdminContactSubmissionController::class, 'updateNotes'])->name('contact-submissions.update-notes');
        Route::delete('contact-submissions/{id}', [AdminContactSubmissionController::class, 'destroy'])->name('contact-submissions.destroy');
        Route::get('contact-submissions-export', [AdminContactSubmissionController::class, 'export'])->name('contact-submissions.export');

        // Reschedule Requests
        Route::get('reschedule-requests', [\App\Http\Controllers\Admin\RescheduleRequestController::class, 'index'])->name('reschedule-requests.index');
        Route::post('reschedule-requests/{id}/approve', [\App\Http\Controllers\Admin\RescheduleRequestController::class, 'approve'])->name('reschedule-requests.approve');
        Route::post('reschedule-requests/{id}/reject', [\App\Http\Controllers\Admin\RescheduleRequestController::class, 'reject'])->name('reschedule-requests.reject');
    });

    // Contact Info Routes
    Route::get('/contact-info/edit', [ContactInfoController::class, 'edit'])->name('contact-info.edit');
    Route::post('/contact-info/update', [ContactInfoController::class, 'update'])->name('contact-info.update');
});

require __DIR__.'/auth.php';

// Google Calendar OAuth Setup Routes
Route::get('/google/auth', [\App\Http\Controllers\Admin\GoogleCalendarAuthController::class, 'auth'])->name('google.auth');
Route::get('/google/callback', [\App\Http\Controllers\Admin\GoogleCalendarAuthController::class, 'callback'])->name('google.callback');
