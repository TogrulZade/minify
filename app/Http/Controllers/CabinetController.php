<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Helpers\ProductHelper;
use Jenssegers\Agent\Agent;

class CabinetController extends Controller
{
    public function index(Request $request)
    {
        $aktivElanlar = ProductHelper::aktivElanlar();
        $yoxlanilanElanlar = ProductHelper::yoxlanilanElanlar();
        $duzelisElanlar = ProductHelper::duzelisElanlar();

        $agent = new Agent();
        $page = $agent->isMobile() ? 'mobile/cabinet' : 'cabinet';
        
        return view($page,['aktivElanlar'=>$aktivElanlar,'yoxlanilanElanlar'=>$yoxlanilanElanlar,'duzelisElanlar'=>$duzelisElanlar]);
    }
}
