<?php 

namespace minify\Helpers;
use minify\Product;
use Auth;

class ProductHelper{
    
    public static function aktivElanlar()
    {
        $id = Auth::user()->id;
        $all = Product::where('created_at',">=",date('Y-m-d H:i:s'))->where('user_id',"=",$id)->orderBy('created_at','DESC')->where('active',"=",1)->get();
        return $all;
    }

    public static function yoxlanilanElanlar()
    {
        $id = Auth::user()->id;
        $all = Product::where('created_at',">=",date('Y-m-d H:i:s'))->where('user_id',"=",$id)->orderBy('created_at','DESC')->where('active',"=",0)->get();
        return $all;
    }
}

?>