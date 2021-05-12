<?php

namespace minify\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use minify\Product;
use minify\Picture;

use Illuminate\Http\File;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

use Auth;

use minify\Category;




class ProductController extends Controller
{
    public function index(Request $request)
    {
    	$product = DB::table("products")->join("pictures","products.id","=","product_id")->leftJoin('markets','markets.id','products.market_id')->where("slug", "=", $request->slug)->first();
        $pictures = Picture::where("product_id","=",$product->product_id)->get();
        // echo $product->product_id;
    	
    	return view("product", ["product"=>$product,"pictures"=>$pictures]);
		// echo Auth::user();
    }

    public function sell(Request $request)
    {
		$category = Category::where('status',">",0)->get();
    	return view("sell",['category'=>$category]);
    }

    public function sellAction(Request $request)
    {
    	$rules = [
    		"product_category" => "required",
    		'product_name' 	=> "required",
    		'product_price' 	=> "required",
    		'product_description' 	=> "required",
    		'merchant_number' 	=> "required",
    		'product_merchant' 	=> "required",
            "image.*"           => 'mimes:jpeg,jpg,png',
    	];

    	$messages = [
    		// 'product_name.required' => 'Məhsul adı seçmədiniz',
    		'product_category.required' => 'Kayeqoriya adı seçmədiniz',
    		'product_price.required' => 'Qiymət təyin etmədiniz',
    		'product_description.required' => 'Məhsul haqqında yazmadınız',
    		'merchant_number.required' => 'Əlaqə nömrəsi qeyd etmədiniz',
    		'product_merchant.required' => 'Adınızı qeyd etmədiniz',
            'image.*.mimes'=> "Yalnız jpeg,jpg,png formatlı şəkil yükləyə bilərsiniz",
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);
		
		if ($validator->fails()) {
    		return redirect('sell')->withErrors($validator)->withInput();
		}

		$product = new Product();
        $picture = new Picture();

		$lastId = Product::orderBy("id","DESC")->first();
		if(empty($lastId)){
			$addId = 1;
		}else{
			$addId = $lastId->id+1;
		}

		$product->product_name = $request->product_name;
		$product->product_category = $request->product_category;
		$product->product_price = $request->product_price;
		$product->product_description = $request->product_description;
		$product->merchant_number = $request->merchant_number;
		$product->product_merchant = $request->product_merchant;
		$product->slug = Str::slug($addId."-".$request->product_name, '-');

		$prNumber = Product::create(["product_name"=>$request->product_name,"product_category"=>$request->product_category,"product_price"=>$request->product_price,"product_description"=>$request->product_description,"merchant_number"=>$request->merchant_number,"product_merchant"=>$request->product_merchant,"slug"=>Str::slug($addId."-".$request->product_name, '-')])->id;

        $files = $request->file('image');

        $imageName = [];

        $k = 0;
        foreach ($files as $file) {
            $k++;
            $ex = $file->getClientOriginalExtension();
            $url = "public/products/".uniqid($prNumber."_", true).".".$ex;
            $image = Storage::put($url, file_get_contents($file));
            $imgurl = substr($url, 7);
            if($k == 1){
				$coverUrl = "storage/products/cover/".uniqid($prNumber."_", true).".".$ex;
				$coverCut = substr($coverUrl, 8);
				$image_resize = Image::make($file->getRealPath());          
				$image_resize->resize(220, 163);	
				$image_resize->save(public_path($coverUrl));
				$cover = 1;
                $up = Product::find($prNumber);
                $up->product_cover = $coverCut;
                $up->save();
            }else{$cover = 0;}
            
            Picture::create(["product_id"=>$prNumber, "url"=>$imgurl,"cover"=>$cover]);
        }
        

		return redirect("sell")->withInput(["success"=>"Məhsulunuz müvəffəqiyyətlə əlavə edildi."]);

    }

	public function getByCategory(Request $request)
	{
		$cat = $request->cat;
		$getCat = Category::where('slug','=',$cat)->first();
		if($getCat){
			$products = DB::table("products")->join("pictures","products.id","=","pictures.product_id")->where("cover","=","1")->where("product_category","=",$getCat->id)->get();
			return view('home', ['products'=>$products,'categoryName'=>$getCat->name]);
			// echo $getCat->id;
		}else{
			return redirect('/');
		}
	}
}
