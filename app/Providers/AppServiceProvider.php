<?php

namespace App\Providers;

use App\Billing\IPaymentGateway;
use App\Billing\PaymentGateway;
use App\Hello\Hello;
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
        $this->app->bind(PaymentGateway::class, function ($app){
                return new PaymentGateway('usd');
        });

        $this->app->bind('greeting', function (){
            return new Hello;
        });

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      //  $this->app->bind(IPaymentGateway::class, PaymentGateway::class);
    }
}
