<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Auth\Access\Gate;
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
        Gate::define('superAdmin', function(User $user){
            return $user->id_level === 2;
        });
    
        Gate::define('dpuk', function(User $user){
            return $user->id_level === 3;
        });
    
        Gate::define('keuangan', function(User $user){
            return $user->id_level === 4;
        });
    }
}
