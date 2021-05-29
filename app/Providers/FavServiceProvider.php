<?php

namespace minify\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use View;
use minify\Fav;
use minify\Category;

class FavServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
    */
    public function boot()
    {
        $cat = Category::all();
        View::share('cat',$cat);
        View::share('layouts/mobile/nav',$cat);
    }
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

}
