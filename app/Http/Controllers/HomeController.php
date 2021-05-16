<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
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
    public function index(Request $request)
    {
    	$minutes = 60*24*30*12*100;
		$anonim = Str::random(14);
        if(!$request->cookie('anonim')){
			\Cookie::queue('anonim', $anonim, $minutes);
        }
        // echo $request->cookie('anonim');

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

    public function axtar(Request $request)
    {
        $axtar = $request->axtar;

        $vips = Product::with('pictures')->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->with('vip')->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->where('product_name',"like","%".$axtar."%")->get();

        $products = Product::with('pictures')->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })->where('product_name',"like","%".$axtar."%")->get();
        $categoryName = '';
        return view('axtar',compact('products','vips','categoryName'));
    }

    public function cv()
    {
        return view("cv");
    }
}