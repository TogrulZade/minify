<?php
namespace minify\Helpers;
use Illuminate\Http\Request;
use Auth;
use Cookie;
use minify\Product;
use minify\Category;

class GeneralHelper
{
    public static function allCat()
    {
        return Category::all();
    }
}


?>