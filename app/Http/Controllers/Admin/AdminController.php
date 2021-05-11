<?php

namespace minify\Http\Controllers\Admin;

use Illuminate\Http\Request;
use minify\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $data = [];
        $tables = DB::select('SHOW TABLES');
        foreach($tables as $t){
            print_r($t->Tables_in_shopin."<br/>");
            // $col = DB::select("SHOW COLUMNS FROM ".$t->Tables_in_shopin." LIKE '%edit%'");
            $col = DB::select("SHOW COLUMNS FROM ".$t->Tables_in_shopin."");
            // $exists = count($col) ? TRUE:FALSE; 
            // if($exists){
                // array_push($data, $col->get());
                // foreach($col as $c){
                    // foreach($c as $cc){
                        print_r($col);
                        echo "<br/>";
                    // }
                // }
            // }
        }
        
        // $data['col'] = $col;
        // print_r($col->get());
        // return view("Admin.Admin", ['tables'=>$data]);
    }
}
