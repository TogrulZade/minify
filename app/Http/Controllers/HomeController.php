<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use minify\Product;
use minify\Fav;
use Auth;

use minify\Traits\FavTrait;
use minify\Helpers\ProductHelper;
use minify\Helpers\FavHelper;
use minify\Helpers\SettingsHelper;


class HomeController extends Controller
{
    use FavTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // echo "cons";
        // $x = new FavTrait();
        // echo $this->fav_trait();
        // echo ProductHelper::getAllProduct();
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
        $take = SettingsHelper::take();
        
    	$minutes = 60*24*30*12*100;
		$anonim = Str::random(14);
        if(!$request->cookie('anonim') && !Auth::user()){
			\Cookie::queue('anonim', $anonim, $minutes);
        }

        $user = Auth::user() ? Auth::user()->id : $request->cookie('anonim');

        $premiums = Product::with('pictures')->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->whereHas('premium',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->with(['vip'=>function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        }])->where('active',"=",1)->orderBy('updated_at','DESC')->get();


        $products = ProductHelper::allAktivElanlar(0,$take->take);
        $favs = FavHelper::getFavs($request);
        
        $vips = Product::with('pictures')->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->with(['premium'=>function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        }])->orderBy('updated_at','DESC')
        ->limit($take->take)->get();

        return view('home', ["products"=> $products, 'vips'=>$vips, 'premiums'=>$premiums, 'favs'=>$favs, 'user'=>$user, 'categoryName'=>'']);
    }

    public function elanlar(Request $req)
    {
        if($req->page > 3){
            $req->page = 0;
            echo $req->page;
        }
        $products = Product::with('pictures')->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->with(['premium'=>function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        }])->with(['vip'=>function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        }])->where('active',"=",1)->orderBy('started_at','DESC')->paginate(80);


        // $count = count($products->get());
        // if($count>40){
        //     $products = $products->paginate(20);
        // }else{
        //     $products = $products->paginate(4);
        // }

        $take = SettingsHelper::take();


        $favs = FavHelper::getFavs($req);
        $vips = ProductHelper::vipElanlar(3);

        return view('elanlar', compact('products','vips','favs'));
    }

    public function axtar(Request $request)
    {
        $axtar = $request->axtar;
        if($axtar == NULL)
            return redirect('/');

        $vips = Product::with('pictures')
        ->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->with('vip')
        ->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })
        ->where('product_name',"like","%".$axtar."%")
        ->select("*",'products.created_at as created_at','products.id as id')
        ->get();

        $products = Product::with('pictures')
        ->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })
        ->where('product_name',"like","%".$axtar."%")
        ->where('products.closed_at',">",date('Y-m-d H:i:s'))
        ->where('products.active','=',1)
        ->select("*",'products.created_at as created_at')
        ->get();


        $cats = Product::with('pictures')
        ->with('category')
        ->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })->leftJoin('ireli','ireli.product_id','products.id')
        ->orderBy('ireli.started_at','DESC')
        ->where('product_name',"like","%".$axtar."%")
        ->where('products.closed_at',">",date('Y-d-m H:i:s'))
        ->where('products.active','=',1)
        ->groupBy('product_category')
        ->get();

        $categoryName = '';
        $favs = FavHelper::getFavs($request);

        return view('axtar',compact('products','vips','categoryName','favs','cats'));
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