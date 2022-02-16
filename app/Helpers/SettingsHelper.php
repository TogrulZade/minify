<?php 

namespace minify\Helpers;
use Illuminate\Http\Request;
use minify\Setting;

class SettingsHelper{

    public static function take()
    {
        return Setting::where("id","=",1)->first();
    }

    public static function takeVip()
    {
        return 80;
    }

}
