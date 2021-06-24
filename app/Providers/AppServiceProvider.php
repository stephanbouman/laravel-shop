<?php

namespace App\Providers;

use Mollie\Api\MollieApiClient;
use App\Blade\CurrencyDirective;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        CurrencyDirective::boot();

        app()->bind('mollie', function(){
            $mollie = new MollieApiClient();
            $mollie->setApiKey(config('services.mollie.key'));

            return $mollie;
        });

    }
}
