<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        $productAbillities = ['insert-product', 'update-product', 'delete-product'];
        foreach($productAbillities as $abillity){
            Gate::define($abillity, function($user){
                return $user->roles()->whereIn('role', ['admin', 'owner'])->exists();
            });
        }
    }
}
