<?php

namespace App\Providers;

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
        return $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '794b5xxkqfnjy5hw',
            'publicKey' => 'pymzsr68k8zspdgg',
            'privateKey' => '32dfe078fccdb975bee6703b118bb48d'
        ]);
    }
}
