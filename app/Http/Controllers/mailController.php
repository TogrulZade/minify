<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class mailController extends Controller
{
    public function send()
    {   
        $data = [];
        Mail::send('mail.productCreated', $data, function ($message) {
            $message->from('togrulzade@gmail.com', 'Minify Sistem');
            $message->sender('togrulzade@gmail.com', 'John Doe');
            $message->to('togrul.zade@yandex.ru', 'John Doe');
            $message->subject('Subject');
            $message->priority(3);
        });
    }
}
