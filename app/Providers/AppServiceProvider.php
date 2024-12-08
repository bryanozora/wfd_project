<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
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
        RedirectIfAuthenticated::redirectUsing(fn () => route('home'));
        
        Gate::define('user',function(User $user){
            return $user->roles->role == 'user';
        });

        Gate::define('admin',function(User $user){
            return $user->roles->role == 'admin';
        });

        Gate::define('artist',function(User $user){
            return $user->roles->role == 'artist';
        });
    }
}
