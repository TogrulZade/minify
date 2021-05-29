<?php

namespace minify\Http\Controllers\Admin;

use Illuminate\Http\Request;
use minify\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view("Admin.Admin");
    }
}
