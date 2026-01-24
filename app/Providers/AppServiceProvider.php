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
            \Illuminate\Support\Facades\View::share('siteSettings', $siteSettings);
        } catch (\Exception $e) {
            // Handle migration or DB connection issues
        }
    }
}
