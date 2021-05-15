<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use minify\Product;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function logo()
    {
        return view('logo');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $vips = Product::with('pictures')->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->with('vip')->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->get();

        $products = Product::with('pictures')->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })->doesntHave('vip')->get();

        return view('home', ["products"=> $products, 'vips'=>$vips, 'categoryName'=>'']);
    }

    public function cv()
    {
        return view("cv");
    }
}
