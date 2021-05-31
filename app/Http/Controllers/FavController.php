<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Fav;
use minify\Product;
use Auth;
use minify\Helpers\FavHelper;

class FavController extends Controller
{

    public function show(Request $request)
    {
        $getFavs = FavHelper::getfavs($request);
        return view('favs', ['favs'=>$getFavs]);
    }
    public function addFavs(Request $request)
    {
        $user = Auth::user() ? Auth::user()->id : $request->cookie('anonim');
        $find = Product::where('id',"=",$request->product_id)->get();
        if(count($find) == 0){
            return response()->json('not_found');
        }

        $check = Fav::where('user_id',"=",$user)->where('product_id',"=",$request->product_id);
        if($check->count() > 0){
            $check->delete();
            return response()->json('unfavorite');
        }

        $fav = new Fav();
        $fav->product_id = $request->product_id;
        $fav->user_id = Auth::user() ? Auth::user()->id : $request->cookie('anonim');

        if($fav->save()){
            return response()->json(true);
        }else{
            return response()->json(false);
        }

    }

    public function redirected(Request $request)
    {
        # code...
    }
}
