<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Product;
// use minify\Picture;

class ApiHomeController extends Controller
{
    public function all()
    {
        $all = Product::with('pictures')->get();
        return $all;
    }
}
