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
use minify\City;
use minify\vip;
use minify\Fav;
use minify\SeenProduct;
use minify\Helpers\FavHelper;
use minify\Helpers\ProductHelper;

class ProductController extends Controller
{
	public function update()
	{
		$cities = ['Ağcabədi','Ağdam','Ağdaş','Ağdərə','Ağstafa','Ağsu','Astara','Bakı','Balakən','Beyləqan','Bərdə','Biləsuvar','Cəbrayıl','Cəlilabad','Culfa','Daşkəsən','Fizuli','Gədəbəy','Gəncə','Goranboy','Göyçay','Göygöl','Göytəpə','Hacıqabul','Horadiz','İmişli','İsmayıllı','Kəlbəcər','Kürdəmir','Laçın','Lerik','Lənkəran','Masallı','Mingəçevir','Nabran','Naftalan','Naxçıvan','Nefçala','Oğuz','Ordubad','Qax','Qazax','Qəbələ','Qobustan','Quba','Qubadlı','Qusar','Saatlı','Sabirabad','Şabran','Şahbuz','Salyan','Şamaxı','Samux','Şəki','Şəmkir','Şərur','Şirvan','Siyəzən','Sumqayıt','Şuşa','Tərtər','Tovuz','Ucar','Xaçmaz','Xankəndi','Xırdalan','Xızı','Xocalı','Xocavənd','Xudat','Yardımlı','Yevlax','Zaqatala','Zəngilan', 'Zərdab'];

		// foreach($cities as $city){
		// 	$p = new City();
		// 	$p->name = $city;
		// 	$p->save();
		// }

		// $up = Product::where('user_id',"=",'')->get();
		// foreach($up as $u){
		// 	echo $u->product_name."<br/>";
		// 	$u->user_id = rand(1,10);
		// 	$u->update();
		// }
	}

    public function index(Request $request)
    {
		$user = Auth::user() ? Auth::user()->id : $request->cookie('anonim');
    	$product = DB::table("products")->leftjoin("pictures","products.id","=","product_id")->leftJoin('markets','markets.id','products.market_id')->where("slug", "=", $request->slug)->leftJoin('cities','cities.id','products.city_id')->where('products.active','=',1)->select("products.*","markets.*","products.uniqid as pid","products.id as pr_id","markets.name as market","pictures.*","cities.name as city")->first();


		// echo $product->product->uid;
		// die;

		if(Auth::user()){
			$check = Product::where('slug',"=",$request->slug)->first();
			if($check->user_id == Auth::user()->id || Auth::user()->id == 1){
				$product = DB::table("products")->leftjoin("pictures","products.id","=","product_id")->leftJoin('markets','markets.id','products.market_id')->where("slug", "=", $request->slug)->leftJoin('cities','cities.id','products.city_id')->select("products.*","markets.*","products.id as pr_id","products.uniqid as pid","markets.name as market","pictures.*","cities.name as city")->first();
			}
		}

		if($product == null)
			abort(404);

		$more_products = Product::with('pictures')->whereHas('pictures',function($q){
			return $q->where('pictures.cover',"=",1);
		})->leftJoin('vip', 'vip.product_id','products.id')->where("products.product_category","=",$product->product_category)->where('products.active','=',1)->orderBy('vip.created_at',"DESC")->select("*",'products.created_at as created')->get();

		$pictures = Picture::where("uniqid","=",$product->pid)->get();

		$favs = FavHelper::getFavs($request);
		$user = Auth::user() ? Auth::user()->id : $request->cookie('anonim');
		$isFav = Fav::where('product_id',"=",$product->pr_id)->where('user_id',"=",$user)->first();

		// Mehsula baxildi
		$minutes = 60*24*30*12*100;
		$anonim = Str::random(14);
        if(!$request->cookie('anonim')){
			\Cookie::queue('anonim', $anonim, $minutes);
        }

		SeenProduct::create([
			'user_id'=>Auth::user() ? Auth::user()->id : null, 
			'product_id'=>$product->pr_id,
			'anonim'=>$request->cookie('anonim') ? $request->cookie('anonim') : null
		]);
		
		$count_seen = SeenProduct::where('product_id',"=",$product->pr_id)->get();

		return view("product", ["product"=>$product,"pictures"=>$pictures,"count_seen"=>$count_seen->count(), "more_products"=>$more_products,'favs'=>$favs, 'isFav'=>$isFav]);
    }

    public function sell(Request $request)
    {
		$cities = City::all();
		$category = Category::where('status',">",0)->get();
    	return view("sell",['category'=>$category,'cities'=>$cities, 'uniqid'=>uniqid()]);
    }

    public function sellAction(Request $request)
    {

		$find_images = Picture::where('uniqid',"=",$request->t)->get();
		$error = ['picture_not_found'=>'Şəkil bazaya yüklənməyib'];
		if(count($find_images)<1){
			// dd($request->t);
			return redirect('sell')->withErrors($error)->withInput();
		}

    	$rules = [
    		"product_category" => "required",
    		'product_name' 	=> "required",
    		'product_price' 	=> "required",
    		'product_description' 	=> "required",
    		'merchant_number' 	=> "required",
    		'product_merchant' 	=> "required",
    		'city' 	=> "required",
    		'delivery' 	=> "required",
    		'new' 	=> "required",
            "image.*"           => 'mimes:jpeg,jpg,png|required',
			"image"=>'required'
    	];

    	$messages = [
    		// 'product_name.required' => 'Məhsul adı seçmədiniz',
    		'product_category.required' => 'Kayeqoriya adı seçmədiniz',
    		'product_price.required' => 'Qiymət təyin etmədiniz',
    		'product_description.required' => 'Məhsul haqqında yazmadınız',
    		'merchant_number.required' => 'Əlaqə nömrəsi qeyd etmədiniz',
    		'product_merchant.required' => 'Adınızı qeyd etmədiniz',
    		'city.required' => 'Şəhər qeyd etmədiniz',
    		'delivery.required' => 'Çatdırılma qeyd etmədiniz',
    		'new.required' => 'Yeni və ya köhnə olduğunu qeyd etmədiniz',
            'image.*.mimes'=> "Yalnız jpeg,jpg,png formatlı şəkil yükləyə bilərsiniz",
            'image.required'=> "Elanın ən az bir şəklini yerləşdirməlisiniz",
			// 'files.required'=>'Elanın ən az bir şəklini yerləşdirməlisiniz'
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);
		
		if ($validator->fails()) {
			dd($validator->fails);
    		return redirect('sell')->withErrors($validator)->withInput();
		}

        $picture = new Picture();

		$lastId = Product::orderBy("id","DESC")->first();
		if(empty($lastId)){
			$addId = 1;
		}else{
			$addId = $lastId->id+1;
		}

		if(Auth::user()){
			$prNumber = Product::create(["product_name"=>$request->product_name,"product_category"=>$request->product_category,"product_price"=>$request->product_price,"product_description"=>$request->product_description,"merchant_number"=>$request->merchant_number,
			"user_id" => Auth::user()->id,
			"product_merchant"=>$request->product_merchant,
			"closed_at"=>date('Y-m-d H:i:s', strtotime('+30 days')),
			'uniqid'=>$request->t,
			"slug"=>Str::slug($addId."-".$request->product_name, '-')])->id;
		}else{
			// User olmadiqda .. hazirda bu funksiya islemir
			$prNumber = Product::create(["product_name"=>$request->product_name,"product_category"=>$request->product_category,"product_price"=>$request->product_price,"product_description"=>$request->product_description,"merchant_number"=>$request->merchant_number,"product_merchant"=>$request->product_merchant,
			"closed_at"=>date('Y-m-d H:i:s', strtotime('+30 days')),
			"slug"=>Str::slug($addId."-".$request->product_name, '-')])->id;
		}

        // $files = $request->file('image');

        // $imageName = [];

        // $k = 0;
        // foreach ($files as $file) {
        //     $k++;
        //     $ex = $file->getClientOriginalExtension();
        //     $url = "public/products/".uniqid($prNumber."_", true).".".$ex;
        //     $image = Storage::put($url, file_get_contents($file));
        //     $imgurl = substr($url, 7);
        //     if($k == 1){
		// 		$coverUrl = "storage/products/cover/".uniqid($prNumber."_", true).".".$ex;
		// 		$coverCut = substr($coverUrl, 8);
		// 		$image_resize = Image::make($file->getRealPath());          
		// 		$image_resize->resize(220, 163);	
		// 		$image_resize->save(public_path($coverUrl));
		// 		$cover = 1;
        //         $up = Product::find($prNumber);
        //         $up->product_cover = $coverCut;
        //         $up->save();
        //     }else{$cover = 0;}
            
        //     Picture::create(["product_id"=>$prNumber, "url"=>$imgurl,"cover"=>$cover]);
        // }
		
		
		foreach($find_images as $fi){
			if($fi->cover == 1){
				$cp = Product::find($prNumber);
				$cp->product_cover = $fi->url;
				$cp->update();
			}
		}

		return redirect("sell")->withInput(["success"=>"Məhsulunuz müvəffəqiyyətlə əlavə edildi."]);

    }

	public function getByCategory(Request $request)
	{
		$cat = $request->cat;
		$getCat = Category::where('slug','=',$cat)->first();
		if($getCat){
			$vips = Product::with('pictures')->whereHas('pictures',function($q){
				return $q->where('pictures.cover',"=",1);
			})->with('vip')->whereHas('vip',function($q){
				return $q->where('closed_at',">", date('Y-m-d H:i:s'));
			})->where("product_category","=",$getCat->id)->get();

			$products = Product::with('pictures')->whereHas('pictures', function($q){
				return $q->where('pictures.cover',"=",1);
			})->where('products.product_category',"=",$getCat->id)->doesntHave('vip')->get();

			$products = Product::with('pictures')
			->whereHas('pictures', function($q){
				return $q->where('pictures.cover',"=",1);
			})
			->where('products.product_category',"=",$getCat->id)
			->where('products.closed_at',">",date('Y-d-m H:i:s'))
			->where('products.active','=',1)
			->doesntHave('vip')
			->get();

			$favs = FavHelper::getFavs($request);

			return view('home', ['products'=>$products, 'favs'=>$favs, 'vips'=>$vips, 'categoryName'=>$getCat->name]);
		}else{
			return redirect('/');
		}
	}

	public function verifyEdition(Request $request)
	{
		$uniqid =  $request->uniqid;
		$find = Product::where('uniqid',"=",$uniqid)->first();
		if($find->user_id !=Auth::id() && Auth::id() !=1){
			return redirect('/');
		}

		$find->active = 1;
		$find->update();
		return redirect("/product/".$find->slug)->withInput(["success"=>"Elan müvəffəqiyyətlə paylaşıldı."]);
	}

	public function loadProduct(Request $request)
	{
		$products = ProductHelper::allAktivElanlar($request->p, 5);
		return $products;
	}
}
