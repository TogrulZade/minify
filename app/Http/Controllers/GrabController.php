<?php

namespace minify\Http\Controllers;
use GuzzleHttp\Client;



use Illuminate\Http\Request;

class GrabController extends Controller
{
    public function index()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://httpbin.org',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', 'https://instagram.com');
        
        echo $response->getBody();
    }
}
