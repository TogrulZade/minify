<?php

namespace minify\Http\Controllers\Admin;

use Illuminate\Http\Request;
use minify\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use minify\Helpers\ProductHelper;
use minify\Product;

class AdminController extends Controller
{
    public function index()
    {
        $products = ProductHelper::waiting();
        return view("Admin.Admin", ['products'=>$products]);
    }

    public function showTesdiq(Request $request)
    {
        $products = ProductHelper::waiting();
        return view('admin/showTesdiq', ['products'=>$products]);
    }

    public function elantesdiqle(Request $request)
    {
        $id = $request->id;
        $find = Product::find($id);
        $find->active = 1;
        
        if($find->update()){
            return response()->json('updated');
        }
    }

    public function showDuzelis(Request $request)
    {
        $products = ProductHelper::duzelis();
        return view('admin/showDuzelis', ['products'=>$products]);
    }
}
