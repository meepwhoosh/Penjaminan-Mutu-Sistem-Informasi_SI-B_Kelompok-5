<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route as RouteFacade;

if (! function_exists('route_exists')) {
    function route_exists(string $name): bool
    {
        return RouteFacade::has($name);
    }
}

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
        // Make RedirectIfAuthenticated role-aware: redirect users by their role
        RedirectIfAuthenticated::redirectUsing(function ($request) {
            if (! Auth::check()) {
                return '/';
            }

            $user = Auth::user();

            if (isset($user->role) && $user->role === 'admin' && route_exists('admin.dashboard')) {
                return route('admin.dashboard');
            }

            if (isset($user->role) && $user->role === 'user' && route_exists('user.dashboard')) {
                return route('user.dashboard');
            }

            return route_exists('dashboard') ? route('dashboard') : '/';
        });
    }
}
