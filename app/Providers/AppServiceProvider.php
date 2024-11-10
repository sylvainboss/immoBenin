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
        Gate::define('acces-admin',function(User $user){
            return $user->admin;
        });

        Gate::define('access-owner',function(User $user){
            return $user->role === "owner" || $user->role === "controller";
        });
    }
}
