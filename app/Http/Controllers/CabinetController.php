<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;

use minify\Helpers\ProductHelper;
use minify\Helpers\FavHelper;

use Jenssegers\Agent\Agent;

class CabinetController extends Controller
{
    public function index(Request $request)
    {
        $aktivElanlar = ProductHelper::aktivElanlar();
        $yoxlanilanElanlar = ProductHelper::yoxlanilanElanlar();
        $duzelisElanlar = ProductHelper::duzelisElanlar();
        $favs = FavHelper::getFavs($request);

        $agent = new Agent();
        $page = $agent->isMobile() ? 'mobile/cabinet' : 'cabinet';
        
        return view($page,['aktivElanlar'=>$aktivElanlar,'yoxlanilanElanlar'=>$yoxlanilanElanlar,
        'duzelisElanlar'=>$duzelisElanlar,
        'favs'=>$favs
        ]);
    }
}
