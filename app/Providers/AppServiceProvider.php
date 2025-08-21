<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Configurar Carbon en español
        Carbon::setLocale(config('app.locale'));

        // Forzar Laravel a reconocer HTTPS detrás de Nginx
        $this->app->singleton(TrustProxies::class, function ($app) {
            $trustProxies = new TrustProxies($app['request']);
            $trustProxies->setTrustedProxies(
                ['*'], // O aquí puedes poner la IP de tu Nginx si quieres más seguro
                Request::HEADER_X_FORWARDED_ALL
            );
            return $trustProxies;
        });
    }
}
