<?php

namespace App\Providers;

use App\Models\Offer;
use App\Services\RecommendationService; // Import the RecommendationService
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the RecommendationService to the service container
        $this->app->singleton(RecommendationService::class, function () {
            return new RecommendationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share offers data with the 'offer' view
        View::composer('offer', function ($view) {
            $offers = Offer::all();
            $view->with('offers', $offers);
        });
    }
}