<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        Paginator::useBootstrap();

        // if(env('APP_ENV') !== 'local') {
        //     URL::forceScheme('https');
        // }

        Gate::define('admin', function(User $user) {
            return $user->role === 'admin';
        });

        Gate::define('ketua', function(User $user) {
            return $user->role === 'Ketua';
        });

        Gate::define('sekretaris', function(User $user) {
            return $user->role === 'Sekretaris';
        });

        Gate::define('kewirausahaan', function(User $user) {
            return $user->role === 'Kewirausahaan';
        });

        Gate::define('inteks', function(User $user) {
            return $user->role === 'Internal&Eksternal';
        });
    }
}
