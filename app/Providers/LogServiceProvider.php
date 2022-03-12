<?php

namespace minify\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;

use minify\LogRegister;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $minutes = 60*24*30*12*100;
        // echo $_SERVER['REMOTE_ADDR'];
		// $anonim = 'fbclid-'.Str::random(14);


        if(request()->fbclid){
			\Cookie::queue('FBCLID', request()->fbclid, $minutes);
        }
    }
}
