<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //$this->registerPolicies();

        Auth::extend('session-guard', function ($app, $name, array $config) {
            return new SessionGuard();
        });
    }
}
