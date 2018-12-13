<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        # This view composer will make the data available for the `layouts.master` view, which
        # includes the `modules.nav` view where we want to use this data.
        view()->composer('layouts.master', function ($view) {
            $user = request()->user();
            $view->with('user', $user);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}