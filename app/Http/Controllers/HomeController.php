<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use minify\Product;
use minify\Fav;
use Auth;



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
        if(!$request->cookie('anonim') && !Auth::user()){
			\Cookie::queue('anonim', $anonim, $minutes);
        }

        $user = Auth::user() ? Auth::user()->id : $request->cookie('anonim');
        // echo $request->cookie('anonim');

        $vips = Product::with('pictures')->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->with('vip')->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->get();

        $products = Product::with(['pictures'])->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })->doesntHave('vip')->select('*', 'products.id as id')->get();
        $favs = Fav::where('user_id',"=",$user)->get();
        // print_r($products);
        return view('home', ["products"=> $products, 'vips'=>$vips, 'favs'=>$favs, 'user'=>$user, 'categoryName'=>'']);
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

    public function test()
    {
        $x = [1,2,3,4,5,6,7,8];
        $y = [4,5,6];
        $c = count($y);
        $z = '';
        foreach($x as $i=>$xx){
            for ($k=0; $k < $c; $k++) { 
                if($xx == $y[$k]){
                    echo "VIP - $xx<br/>";
                    $z = $xx;
                }
            }
            if($z !=$xx ){
                echo $xx."<br/>";
            }
        }
            echo "<hr/>";
        
    }

    public function cv()
    {
        return view("cv");
    }
}