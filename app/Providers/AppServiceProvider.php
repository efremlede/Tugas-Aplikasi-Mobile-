<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Product;
use App\Policies\ProductPolicy;

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
        // Pendaftaran Policy (khusus Laravel versi baru)
        Gate::policy(Product::class, ProductPolicy::class);

        // Mendefinisikan Gate 'edit-product'
        Gate::define('edit-product', function (User $user) {
            return $user->usertype === 'admin';
        });

        // Redirect default setelah login ke /dashboard
        // pada Laravel 11/12, pengaturan ini biasanya di RouteServiceProvider,
        // tetapi untuk kebutuhan praktikum kita set juga di aplikasi saat ini.
        \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url', 'http://localhost'));
    }
}