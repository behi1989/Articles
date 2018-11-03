<?php

namespace App\Providers;

use App\category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        schema::defaultStringLength(191);

        view()->composer('layouts.sidebar', function ($view){
           $categories = Category::all();
           $categories = $categories->chunk(round($categories->count() / 2));
           $view->with(compact('categories'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
