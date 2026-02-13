<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin-only', function ($user) {
            return $user->is_admin === 1;
        });

        try {
            $siteSettings = \App\Models\SiteSetting::current();
            $contactInfo = \App\Models\ContactInfo::first();
            
            \Illuminate\Support\Facades\View::share('siteSettings', $siteSettings);
            \Illuminate\Support\Facades\View::share('contactInfo', $contactInfo);
            
            $navbarItems = \App\Models\NavbarItem::whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('order')
                ->with(['children' => function($q) {
                    $q->where('is_active', true)->orderBy('order');
                }])
                ->get();
            \Illuminate\Support\Facades\View::share('navbarItems', $navbarItems);

            // Share Company Profile and Service Areas globally for Schema Markup
            $companyProfile = \App\Models\CompanyProfile::first();
            $serviceAreas = \App\Models\ServiceArea::active()->get();
            \Illuminate\Support\Facades\View::share('companyProfile', $companyProfile);
            \Illuminate\Support\Facades\View::share('serviceAreas', $serviceAreas);
        } catch (\Exception $e) {
            // Handle migration or DB connection issues
        }
    }
}
