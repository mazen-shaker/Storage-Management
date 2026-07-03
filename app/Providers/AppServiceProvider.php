<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('is-admin', function ($user) {
            return $user->prev_id === 1;
        });
    
        // تعريف Gate للتحقق من أن prev يساوي user
        Gate::define('is-user', function ($user) {
            return $user->prev_id === 2;
        });    
    
    }
}
