<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class mailController extends Controller
{
    public function send()
    {   
        $data = ["name"=>"Togrul Zade"];
        // Mail::send('mail.productCreated', $data, function ($message) {
        //     $message->from('adminminify@minify.az', 'Minify Sistem');
        //     $message->sender('adminminify@minify.az', 'John Doe');
        //     $message->to('adminminify@minify.az', 'John Doe');
        //     $message->subject('Subject');
        //     $message->priority(3);
        // });
        Mail::send(['text'=>"mail.productCreated"], $data, function($message){
            $message->to('adminminify@minify.az', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from('adminminify@minify.az','Virat Gandhi');
        } );
    }
}
