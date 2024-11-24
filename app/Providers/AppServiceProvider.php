<?php

namespace App\Providers;

use App\Models\Offer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('offer', function ($view) {
            $offers = Offer::all();
            $view->with('offers', $offers);
        });
    }
}
