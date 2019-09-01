<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;

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
			Schema::defaultStringLength(191);

			// Share categories accross all views

			// This was running before any migration attemp so i couldn't migrate the database
			// \View::share('categories', Category::all());

			\View::composer(['users.create', 'users.edit', 'users.show'], function($view) {
				$view->with('categories', Category::all());
			});
    }
}
