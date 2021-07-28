<?php

namespace App\Providers;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
        Gate::define('isAdmin', function ($user) {
            return $user->role_id == '1';
        });

        Gate::define('isOperatordinas', function ($user) {
            return $user->role_id == '2';
        });

        Gate::define('isPimpinan', function ($user) {
            return $user->role_id == '3';
        });
        Gate::define('isOperatorsekolah', function ($user) {
            return $user->role_id == '4';
        });
        Gate::define('isPembayaran', function ($user) {
            return $user->role_id == '5';
        });
    }
}
