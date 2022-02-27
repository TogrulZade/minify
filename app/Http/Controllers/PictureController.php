<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Picture;
use minify\Product;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PictureController extends Controller
{
    public function uploadImage(Request $request)
    {
        $file = $request->file('image');
        $t = $request->t;
        $imageName = [];
        $coverCut = '';


        $check = Picture::where('uniqid',"=",$t)->get();
        if(count($check) < 1){$cover = 1;}else{$cover = 0;}

        $ex = $file->getClientOriginalExtension();
        $url = "public/products/".uniqid().".".$ex;
        $image = Storage::put($url, file_get_contents($file));
        $imgurl = substr($url, 7);
            $coverUrl = "storage/products/cover/".uniqid().".".$ex;
            $coverCut = substr($coverUrl, 8);
            $image_resize = Image::make($file->getRealPath());          
            
            // list($width, $height,$type) = getimagesize($file);
            // $ratio = $width/$height;
            
            // $width = 220;
            // $wr = $width/220;
            // if($wr < 1){    
            //     $height = $height*$wr;
            // }else{
            //     $height = $height/$wr;
            // }

            // $image_resize->resize($width, $height);
            // // $image_resize->crop(220, 163, 0,0);
            $image_resize->save(public_path($coverUrl));
            Picture::create(["url"=>$imgurl,"cover"=>$cover,'cover_photo'=>$coverCut,"uniqid"=>$t]);
        }

        public function makeCover(Request $request)
        {
            $find = Picture::where("id","=",$request->pic)->first();
            if(!$find)
                return 'not_found_pic';
            
            
            $product = Product::where('uniqid','=',$find->uniqid)->first();
            if(!$product)
                return 'not_found_product';
            
            
            $find_cover = Picture::where("uniqid","=",$product->uniqid)
                          ->where('cover',"=",1)
                          ->first();
            // return $find_cover;
            if($find_cover->id == $find->id)
                return 'same_choosen';

            $find_cover->cover = 0;
            $find_cover->update();
            $find->cover = 1;
            if($find->update())
                return 'ok';
            
            return 'not_updated';
            
        }
    }
// }
