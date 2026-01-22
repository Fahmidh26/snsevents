<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyProfileController;
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
        ->take(6)
        ->get();

    // SEO and Service Areas
    $seo = \App\Models\SeoDetail::getByPage('homepage');
    $serviceAreas = \App\Models\ServiceArea::active()->take(6)->get();

    // Dynamic sections
    $testimonials = \App\Models\Testimonial::active()->orderBy('display_order')->get();
    $faqs = \App\Models\FAQ::active()->orderBy('display_order')->get();
    $contactInfo = \App\Models\ContactInfo::first();

    return view('frontend', compact('companyProfile', 'aboutUs', 'heroSlides', 'eventTypes', 'seo', 'serviceAreas', 'testimonials', 'faqs', 'contactInfo'));
});

Route::get('/service-areas', function () {
    $companyProfile = \App\Models\CompanyProfile::first();
    $serviceAreas = \App\Models\ServiceArea::active()->get();
    
    // Create a dummy SEO object for this page
    $seo = new \stdClass();
    $seo->title = 'Areas We Serve - SNS Events';
    $seo->meta_description = 'Explore the locations we serve across Texas. SNS Events brings premium event decoration to Dallas, Fort Worth, Austin, and beyond.';
    $seo->meta_keywords = 'service areas, texas event locations, dallas, fort worth, austin, san antonio';
    $seo->og_image = null;
    
    return view('service-areas', compact('companyProfile', 'serviceAreas', 'seo'));
})->name('service-areas');

// Frontend Event Routes
Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [\App\Http\Controllers\EventController::class, 'show'])->name('events.show');
Route::post('/inquire', [\App\Http\Controllers\EventController::class, 'inquire'])->name('inquire.store');
Route::get('/custom-package', function() {
    return view('events.custom');
})->name('custom-package');
Route::post('/custom-package/submit', [\App\Http\Controllers\EventController::class, 'submitCustomRequest'])->name('custom-package.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Company Profile Routes
    Route::get('/company-profile/edit', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
    Route::post('/company-profile/update', [CompanyProfileController::class, 'update'])->name('company-profile.update');

    // About Us Routes
    Route::get('/about-us/edit', [\App\Http\Controllers\AboutUsController::class, 'edit'])->name('about-us.edit');
    Route::post('/about-us/update', [\App\Http\Controllers\AboutUsController::class, 'update'])->name('about-us.update');

    // Hero Section Routes
    Route::resource('hero', \App\Http\Controllers\HeroSectionController::class)->except(['show']);

    // Admin Event Management Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::resource('event-types', \App\Http\Controllers\Admin\EventTypeController::class);
        Route::resource('pricing-tiers', \App\Http\Controllers\Admin\PricingTierController::class);
        Route::resource('galleries', \App\Http\Controllers\Admin\EventGalleryController::class);
        
        Route::get('inquiries', [\App\Http\Controllers\Admin\PackageInquiryController::class, 'index'])->name('inquiries.index');
        Route::patch('inquiries/{inquiry}/status', [\App\Http\Controllers\Admin\PackageInquiryController::class, 'updateStatus'])->name('inquiries.update-status');
        Route::delete('inquiries/{inquiry}', [\App\Http\Controllers\Admin\PackageInquiryController::class, 'destroy'])->name('inquiries.destroy');
        
        Route::get('custom-requests', [\App\Http\Controllers\Admin\CustomPackageRequestController::class, 'index'])->name('custom-requests.index');
        Route::patch('custom-requests/{customRequest}/status', [\App\Http\Controllers\Admin\CustomPackageRequestController::class, 'updateStatus'])->name('custom-requests.update-status');
        Route::delete('custom-requests/{customRequest}', [\App\Http\Controllers\Admin\CustomPackageRequestController::class, 'destroy'])->name('custom-requests.destroy');
        
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
        
        // SEO Management
        Route::get('seo', [\App\Http\Controllers\Admin\SeoDetailController::class, 'index'])->name('seo.index');
        Route::get('seo/{id}/edit', [\App\Http\Controllers\Admin\SeoDetailController::class, 'edit'])->name('seo.edit');
        Route::post('seo/{id}/update', [\App\Http\Controllers\Admin\SeoDetailController::class, 'update'])->name('seo.update');
        
        // Service Areas Management
        Route::resource('service-areas', \App\Http\Controllers\Admin\ServiceAreaController::class);
        
        // Testimonials Management
        Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
        
        // FAQs Management
        Route::resource('faqs', \App\Http\Controllers\Admin\FAQController::class);
    });

    // Contact Info Routes
    Route::get('/contact-info/edit', [\App\Http\Controllers\ContactInfoController::class, 'edit'])->name('contact-info.edit');
    Route::post('/contact-info/update', [\App\Http\Controllers\ContactInfoController::class, 'update'])->name('contact-info.update');
});

require __DIR__.'/auth.php';
