<?php

namespace minify\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use minify\Category;
use minify\Product;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;





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
        $cat = Category::where("parent_id","=",0)->with("childrenCategories")->get();

        View::share('getCategory', $cat);

        if(Request()->segment(1) == 'product'){
            $slug = Request()->segment(2);
            $screen_image = Product::where('slug','=',$slug)->first();
            View::share('screen_image', $screen_image->product_cover);
        }
    }
}