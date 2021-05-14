<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Product;
use minify\vip;
// use minify\Picture;

class ApiHomeController extends Controller
{
    public function all()
    {

        $all = Product::with('pictures')->orderBy('created_at',"DESC")->get();

        $vips = Product::with('pictures')->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->with('vip')->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->get();
        return ['all'=>$all, "vip"=>$vips];
    }
}
