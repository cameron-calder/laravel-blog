<?php

namespace App\Providers;

use App\Services\IpAddressLookup;
use Illuminate\Support\ServiceProvider;

class IpAddressLookupProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IpAddressLookup::class, function ($app) {
            return new IpAddressLookup(
               env('FREE_GEO_IP_API_KEY')
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
