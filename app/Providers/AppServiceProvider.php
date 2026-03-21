<?php

namespace App\Providers;

use App\Models\Permitdb;
use Illuminate\Support\Facades\View;
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
        /**
         * Share $permit with every view automatically.
         *
         * This means sidenav, topnav, and all dashboard pages always have
         * $permit available without any controller needing to pass it manually.
         *
         * For guests, a blank Permitdb instance is used so all flags default
         * to false — Blade @if($permit->oppo) checks are always safe.
         */
        View::composer('*', function ($view) {
            $permit = auth()->check()
                ? (Permitdb::forRole(auth()->user()->role) ?? new Permitdb())
                : new Permitdb();

            $view->with('permit', $permit);
        });
    }
}