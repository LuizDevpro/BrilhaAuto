<?php

namespace App\Providers;

use App\Models\User;
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
        Gate::define('sys-admin', function ($user) {
            return $user->role === 'sys-admin';
        });

        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('client', function ($user) {
            return $user->role === 'client';
        }); 

        Gate::define('guest-or-client', function (?User $user) {
            return is_null($user) || $user->role === 'client';
        });

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

    }
}
