<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Helpers\ProductHelper;

class CabinetController extends Controller
{
    public function index(Request $request)
    {
        $aktivElanlar = ProductHelper::aktivElanlar();
        $yoxlanilanElanlar = ProductHelper::yoxlanilanElanlar();
        $duzelisElanlar = ProductHelper::duzelisElanlar();
        return view('cabinet',['aktivElanlar'=>$aktivElanlar,'yoxlanilanElanlar'=>$yoxlanilanElanlar,'duzelisElanlar'=>$duzelisElanlar]);
    }
}
