<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class SubCategoryController extends Controller
{
    public function index()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://tap.az/elanlar/ev-ve-bag-ucun');

        $response->filter('.subcategories-inner ul li a>span')->each(function($node){
            echo $node->text();
        });
    }
}