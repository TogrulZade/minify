<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use minify\Product;

class ApiProductController extends Controller
{
    public function show(Request $request)
    {
        $pid = $request->pid;
        // $data = Product::with('pictures')->with('city')->with('market')->orderBy('created_at',"DESC")->where('id',"=",$pid)->first();
        $data = DB::table("products")->join("pictures","products.id","=","product_id")->leftJoin('markets','markets.id','products.market_id')->where("products.id", "=", $pid)->leftJoin('cities','cities.id','products.city_id')->select("products.*","markets.*","markets.name as market","pictures.*","cities.name as city")->get();
        return $data;
    }
}
