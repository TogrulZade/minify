<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Product;
use minify\Premium;

class PremiumController extends Controller
{
    public function checkPremium(Request $req)
    {
        return Premium::where("product_id","=",$req->id)->orderBy('id','DESC')->first();
    }

    public function makePremium(Request $req)
    {
        if(intval($req->premium_day) !== 1 && intval($req->premium_day) !== 2 && intval($req->premium_day) !==3 ){
            return 'Hacking attempt!';
        }
        
        if($req->premium_day == 1) $premium_day = 5;
        if($req->premium_day == 2) $premium_day = 15;
        if($req->premium_day == 3) $premium_day = 30;

        $product = Product::find($req->id);
        
        if(!$product)
            return 'not found';
        
        $product->updated_at = date('Y-m-d H:i:s');
        
        $findPremium = Premium::where('product_id',"=",$req->id)->orderBy('id','DESC')->first();
        $premium = new Premium();
        $premium->product_id = $req->id;
        $premium->started_at = date('Y-m-d H:i:s');
        $premium->day = $premium_day;
        if($findPremium){
            if(strtotime($findPremium->closed_at) - strtotime(date('Y-m-d H:i:s')) < 0){
                $premium->closed_at = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s').'+'.$premium_day." days"));
            }else{
                $premium->closed_at = date("Y-m-d H:i:s",strtotime($findPremium->closed_at. '+'.$premium_day.' days'));
            }
        }else{
            $premium->closed_at = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s').'+'.$premium_day." days"));
        }
        
        if($premium->save() && $product->update()){
            return redirect()->back()->withSuccess(['message'=>'Success']);
        }else{
            return redirect()->back()->withErrors(['error'=>'Error']);
        }
    }
}
