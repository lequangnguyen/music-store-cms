<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExtraServiceProvider extends ServiceProvider
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
        $this->app-> singleton(
            \App\Services\ImageServicesInterface::class,
            \App\Services\ImageServices::class
        );
    }
}
