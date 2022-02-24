<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Product;
use minify\Vip;
use minify\Premium;
use minify\Helpers\FavHelper;

class VipController extends Controller
{

    public function all(Request $req)
    {
        $vips = Product::with('pictures')
        ->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->withCount('vip')
        ->with(['premium'=>function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        }])
        ->where('active',"=",1)
        ->paginate(80);
        
        $favs = FavHelper::getFavs($req);

        return view('vips',compact('vips','favs'));
    }

    public function checkVip(Request $req)
    {
        return Vip::where("product_id","=",$req->id)->orderBy('id','DESC')->first();
    }

    public function checkProduct(Request $req)
    {
        return Product::find($req->id);
    }

    public function makeVip(Request $req)
    {
        if(intval($req->vip_day) !== 1 && intval($req->vip_day) !== 2 && intval($req->vip_day) !==3 ){
            return 'Hacking attempt!';
        }
        
        if($req->vip_day == 1) $vip_day = 5;
        if($req->vip_day == 2) $vip_day = 15;
        if($req->vip_day == 3) $vip_day = 30;

        $product = Product::find($req->id);
        
        if(!$product)
            return 'not found';
        
        
        $findVip = Vip::where('product_id',"=",$req->id)->orderBy('id','DESC')->first();
        $vip = new Vip();
        $vip->product_id = $req->id;
        $vip->started_at = date('Y-m-d H:i:s');
        $vip->day = $vip_day;
        if($findVip){
            if(strtotime($findVip->closed_at) - strtotime(date('Y-m-d H:i:s')) < 0){
                $vip->closed_at = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s').'+'.$vip_day." days"));
            }else{
                $vip->closed_at = date("Y-m-d H:i:s",strtotime($findVip->closed_at. '+'.$vip_day.' days'));
            }
        }else{
            $vip->closed_at = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s').'+'.$vip_day." days"));
        }
        
        if($vip->save()){
            return redirect()->back()->withSuccess(['message'=>'Success']);
        }else{
            return redirect()->back()->withErrors(['error'=>'Error']);
        }
    }
}
