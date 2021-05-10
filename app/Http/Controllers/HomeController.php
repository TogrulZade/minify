<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $products = DB::table("products")->join("pictures","products.id","=","pictures.product_id")->where("cover","=","1")->get();
        return view('home', ["products"=> $products,'categoryName'=>'']);
    }

    public function cv()
    {
        return view("cv");
    }
}
