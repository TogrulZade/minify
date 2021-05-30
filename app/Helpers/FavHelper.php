<?php 

namespace minify\Helpers;
use Illuminate\Http\Request;
use Auth;
use Cookie;
use minify\Product;

class FavHelper{

    public static function getFavs(Request $request){
        $user = Auth::user() ? Auth::user()->id : $request->cookie('anonim');
        $favs = Product::with(['pictures','favs'])
            ->whereHas('favs',function($q) use($user){
                return $q->where('user_id',"=",$user)
                ->select('*','favs.product_id as fav_id');
            })
            ->whereHas('pictures', function($q){
                return $q->where('pictures.cover',"=",1);
            })
            ->where('products.closed_at',">",date('Y-m-d H:i:s'))
            ->where('products.active',"=",'1')
            ->select('*', 'products.id as id')->get();

            return $favs;
    }
}

?>