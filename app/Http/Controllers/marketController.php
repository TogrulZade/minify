<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use minify\market;
use minify\Product;
use minify\SeenProduct;
use minify\Helpers\FavHelper;

use Auth;


class marketController extends Controller
{
    public function index()
    {
        return view('createMarket');
    }

    public function create(Request $req)
    {
        $file = $req->file('image');
        $cover = $req->file('cover');
        $check = $req->validate([
            'name'=>"max:50|min:4"
        ]);

        $ex = $file->getClientOriginalExtension();
        $url = "public/profile/".uniqid().".".$ex;
        $image = Storage::put($url, file_get_contents($file));
        $imgurl = substr($url, 7);

        $exCover = $file->getClientOriginalExtension();
        $urlCover = "public/profile/".uniqid().".".$exCover;
        $image = Storage::put($urlCover, file_get_contents($cover));
        $coverurl = substr($urlCover, 7);

        $new = new market();
        $new->name = $req->name;
        $new->slogan = $req->slogan;
        $new->open_at = $req->open_at;
        $new->close_at = $req->close_at;
        $new->unvan = $req->unvan;
        $new->tel = $req->tel;
        $new->picture = $imgurl;
        $new->cover = $coverurl;
        $new->about = $req->about;
        $new->uid = Auth::user()->id;
        $new->status = 1;


        $lastId = market::orderBy("id","DESC")->first();
		if(empty($lastId)){
			$addId = 1;
		}else{
			$addId = $lastId->id+1;
		}

        $new->slug = Str::slug($addId."-".$req->name, '-');

        if($new->save()){
            return redirect('myMarket')->withInput(["success"=>"Magaza quruldu"]);
        }
        
    }

    public function myMarket(Request $req)
    {
        $market = market::where("uid","=",Auth::id())->where('status',"=",1)->get();
        if(!$market)
            return redirect('/makeMarket');
        return view('myMarket',compact('market'));
    }

    public function showMarket(Request $req)
    {
        $slug = $req->slug;
        $market = market::where('slug',"=",$slug)->first();
        if(!$market)
            return redirect("/");
        $marketItems = Product::where('market_id',"=",$market->id)
        ->with('vip')
        ->with('premium')
        ->orderBy('products.updated_at',"DESC")
        ->get();

        $seen = SeenProduct::with('products')->whereHas('products',function($q) use($market){
            return $q->where('market_id', $market->id);
        })->count();

        $favs = FavHelper::getFavs($req);
        $vips = Product::with('pictures')->with('vip')->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->get();

        // print_r($vips);
        
        return view('market', compact('market','marketItems','favs','vips','seen'));
    }
}
