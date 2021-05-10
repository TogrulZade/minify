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
            $col = DB::select("SHOW COLUMNS FROM ".$t->Tables_in_shopin." LIKE 'editable'");
            $exists = (mysql_num_rows($col))?TRUE:FALSE; 
            if($exists){
                array_push($data, $col);
            }
        }
        
        $data['col'] = $col;
        return view("Admin.Admin", $data);
    }
}
