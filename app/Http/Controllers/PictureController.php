<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;
use minify\Picture;
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
            $coverUrl = "storage/products/cover/000-".uniqid().".".$ex;
            $coverCut = substr($coverUrl, 8);
            $image_resize = Image::make($file->getRealPath());          
            
            list($width, $height,$type) = getimagesize($file);
            $ratio = $width/$height;
            
            $width = 220;
            $wr = $width/220;
            if($wr < 1){    
                $height = $height*$wr;
            }else{
                $height = $height/$wr;
            }

            $image_resize->resize($width, $height);
            // $image_resize->crop(220, 163, 0,0);
            $image_resize->save(public_path($coverUrl));
        // Picture::create(["url"=>$imgurl,"cover"=>$cover,'cover_photo'=>$coverCut,"uniqid"=>$t]);   
        }
    }
// }
