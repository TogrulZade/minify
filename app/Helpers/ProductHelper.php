<?php 

namespace minify\Helpers;
use minify\Product;
use Auth;

class ProductHelper{
    
    public static function aktivElanlar()
    {
        $id = Auth::user()->id;
        $all = Product::where('closed_at',">=",date('Y-m-d H:i:s'))->where('user_id',"=",$id)->orderBy('created_at','DESC')->where('active',"=",1)->get();
        return $all;
    }

    public static function yoxlanilanElanlar()
    {
        $id = Auth::user()->id;
        $all = Product::with('pictures')->whereHas('pictures',function($q){
			return $q->where('pictures.cover',"=",1);
		})->where('closed_at',">=",date('Y-m-d H:i:s'))->where('user_id',"=",$id)->orderBy('products.created_at','DESC')->where('active',"=",0)->get();
        return $all;
    }

    public static function allAktivElanlar(){
        $products = Product::with(['pictures'])->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })->doesntHave('vip')->where('products.closed_at',">",date('Y-m-d H:i:s'))->where('active',"=",'1')->select('*', 'products.id as id')->get();
        return $products;
    }
    
    public static function waiting()
    {
        $products = Product::with(['pictures'])->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })->where('products.closed_at',">",date('Y-m-d H:i:s'))->where('active',"=",'0')->select('*', 'products.id as id')->get();
        return $products;
    }

    public static function duzelis()
    {
        $products = Product::with(['pictures'])->whereHas('pictures', function($q){
            return $q->where('pictures.cover'   ,"=",1);
        })->where('products.closed_at',">",date('Y-m-d H:i:s'))->where('active',"=",'2')->select('*', 'products.id as id')->get();
        return $products;
    }
}

?>