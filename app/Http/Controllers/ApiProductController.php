<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Product;

class ApiProductController extends Controller
{
    public function show(Request $request)
    {
        $pid = $request->pid;
        $data = Product::with('pictures')->with('city')->with('market')->orderBy('created_at',"DESC")->where('id',"=",$pid)->get();
        return $data;
    }
}
