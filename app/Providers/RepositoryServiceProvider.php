<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
            \App\Repository\UserRepositoryInterface::class,
            \App\Repository\UserRepository::class
        );
        $this->app-> singleton(
            \App\Repository\CategoryRepositoryInterface::class,
            \App\Repository\CategoryRepository::class
        );
        $this->app-> singleton(
            \App\Repository\ProductRepositoryInterface::class,
            \App\Repository\ProductRepository::class
        );
    }
}
