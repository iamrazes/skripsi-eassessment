<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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

    public function boot()
    {
        Blade::component('components.sidebar', 'sidebar');
        Blade::component('components.navbar', 'navbar');
        Blade::component('components.footer', 'footer');

        Blade::directive('js', function ($path) {
            return "<script src=\"{{ asset($path) }}\"></script>";
        });
    }
}
