<?php

namespace minify\Http\Controllers\Admin;

use Illuminate\Http\Request;
use minify\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use minify\Helpers\ProductHelper;
use minify\Helpers\GeneralHelper;
use minify\Product;

class AdminController extends Controller
{
    public function index()
    {
        $products = ProductHelper::waiting();
        return view("admin.admin", ['products'=>$products]);
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

    public function edit(Request $request)
    {
        $cat = GeneralHelper::allCat();
        $product = Product::where("id","=",$request->pid)->first();
        if($product == null){
            return 'Tapilmadi';
        }else{
            return view('admin.edit', ['product'=>$product, 'category'=>$cat]);
        }
    }

    public function editAction(Request $request)
    {
        $pid = $request->pid;
        if(!ProductHelper::hasPid($pid)){
            return redirect()->back()->withErrors(["isNot"=>ProductHelper::hasPid($pid)])->withInput();
        }

        $update = Product::find($pid);
        $update->product_name = $request->name;
        $update->product_description = $request->description;
        $update->product_price = $request->price;
        $update->merchant_number = $request->merchant_number;
        $update->product_category = $request->product_category;
        $update->active = 2;
        $update->started_at = $request->started_at;
        $update->closed_at = $request->closed_at;
        if($update->update()){
            return redirect('/admin/edit/'.$pid)->withInput(["success"=>"Məhsul elave edidi"])->withInput();
        }

    }
}
