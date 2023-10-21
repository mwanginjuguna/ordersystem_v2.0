<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
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
        // app admin
        $admin = Cache::remember('admin', now()->addHours(1), function () {
            return User::where('role', 'A')->first();
        });

        // share
        view()->share('admin', $admin);
    }
}
