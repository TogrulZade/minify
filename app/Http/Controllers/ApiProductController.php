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
        $data = Product::with('pictures')->with('city')->with('market')->orderBy('created_at',"DESC")->where('id',"=",$pid)->get();
        return $data;
    }

    public function axtar(Request $request)
    {
        $q = $request->q;
        if($q !=""){
            $data = Product::where("product_name","like","%".$q."%")->get();
        }else{
            $data = [];
        }
        return $data;
    }
}
