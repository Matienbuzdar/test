<?php

namespace App\Providers;
use Razorpay\Api\Api;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       $this->app->singleton(Api::class, function ($app) {
            return new Api('rzp_live_S1c6FeCd9ihl6l', 'H8EUFxa4B7JaiRxTXUB7CfdP');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
