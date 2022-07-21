<?php

namespace minify\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use minify\Product;
use minify\Picture;
use minify\market;
use minify\LogRegister;

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
use minify\Helpers\SettingsHelper;


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

		// $up = Product::all();
		// foreach($up as $u){
		// $u->closed_at = "2021-12-31 00:00:00";
		// $u->update();
		// }
	}

    public function index(Request $request)
    {
		$user = Auth::user() ? Auth::user()->id : $request->cookie('anonim');
		$log = new LogRegister();
        $log->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $log->ip_address = isset($_SERVER['HTTP_CLIENT_IP']) 
        ? $_SERVER['HTTP_CLIENT_IP'] 
        : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
          ? $_SERVER['HTTP_X_FORWARDED_FOR'] 
          : $_SERVER['REMOTE_ADDR']);

		
		  $log->utm_source = request()->utm_source ? request()->utm_source : '';
		  $log->fbclid = request()->fbclid ? request()->fbclid : '';  
		  $params = '';
			foreach($_GET as $key => $value){
				$params .= $key . "=" . $value . "&";
			}
		  $log->params = $params;
		  $log->save();

        $minutes = 60*24*30*12*100;

        if(request()->fbclid){
			\Cookie::queue('FBCLID', request()->fbclid, $minutes);
        }

		// $product = DB::table("products")->leftjoin("pictures","products.id","=","product_id")->leftJoin('markets','markets.id','products.market_id')->where("products.slug", "=", $request->slug)->leftJoin('cities','cities.id','products.city_id')->where('products.active','=',1)->leftJoin("categories","products.product_category","categories.id")->leftJoin('vip',"products.id","vip.product_id")->select("products.*","markets.*","products.uniqid as pid","products.id as pr_id","markets.name as market","pictures.*","cities.name as city","categories.name as category_name","categories.slug as category_slug","markets.slug as market_slug",'vip.*')->first();

		$product = Product::with('pictures')
			->with('market')
			->with('vip')
			->with('premium')
			->with('category')
			// ->where('products.active','=',1)
			->where("products.slug", "=", $request->slug)
		->first();

		if(!$product)
			return abort(404);

		$cover_photo = Picture::with('product')
			->where('uniqid',"=",$product->uniqid)
			->where('cover','=',1)
		->first();

		if(Auth::user()){
			$check = Product::where('slug',"=",$request->slug)->first();
			if($check){
				if($check->user_id == Auth::user()->id || Auth::user()->id == 1){
					// $product = DB::table("products")->leftjoin("pictures","products.id","=","product_id")->leftJoin('markets','markets.id','products.market_id')->where("products.slug", "=", $request->slug)->leftJoin('cities','cities.id','products.city_id')->leftJoin("categories","products.product_category","categories.id")->leftJoin('vip',"products.id","vip.product_id")->select("products.*","markets.*","products.id as pr_id","products.uniqid as pid","markets.name as market","pictures.*","cities.name as city","categories.name as category_name","markets.slug as market_slug","categories.slug as category_slug",'vip.*')->first();
					if(Auth::user()->id == $check->user_id){
						$product = Product::with('pictures')
						->with('market')
						->with('vip')
						->with('premium')
						->where("products.slug", "=", $request->slug)
						->first();
					}else{
						$product = Product::with('pictures')
						->with('market')
						->with('vip')
						->with('premium')
						->where("products.slug", "=", $request->slug)
						->where('products.active','=',1)
						->first();
					}
				}
			}
		}

		if($product == null)
			abort(404);

		$more_products = Product::with('pictures')->whereHas('pictures',function($q){
			return $q->where('pictures.cover',"=",1);
		})->leftJoin('vip', 'vip.product_id','products.id')->where("products.product_category","=",$product->product_category)->where('products.active','=',1)->orderBy('vip.created_at',"DESC")->select("*",'products.created_at as created')->where('products.id',"!=",$product->id)->get();

		$pictures = Picture::where("uniqid","=",$product->uniqid)->get();

		$favs = FavHelper::getFavs($request);
		$user = Auth::user() ? Auth::user()->id : $request->cookie('anonim');
		$isFav = Fav::where('product_id',"=",$product->pr_id)->where('user_id',"=",$user)->first();

		// Mehsula baxildi
		$minutes = 60*24*30*12*100;
		$anonim = Str::random(14);
        if(!$request->cookie('anonim')){
			\Cookie::queue('anonim', $anonim, $minutes);
        }


		if(Auth::user()){
			if($product->user_id != Auth::user()->id){
				SeenProduct::create([
					'user_id'=>Auth::user() ? Auth::user()->id : null, 
					'product_id'=>$product->id,
					'anonim'=>$request->cookie('anonim') ? $request->cookie('anonim') : null
				]);
			}
		}else{
			SeenProduct::create([
				'user_id'=>Auth::user() ? Auth::user()->id : null, 
				'product_id'=>$product->id,
				'anonim'=>$request->cookie('anonim') ? $request->cookie('anonim') : null
			]);
		}
		

		$count_seen = SeenProduct::where('product_id',"=",$product->id)->get();

		// return view("product", ["product"=>$product,"pictures"=>$pictures,"count_seen"=>$count_seen->count(), "more_products"=>$more_products,'favs'=>$favs, 'isFav'=>$isFav]);
		// return view("detail", ["product"=>$product,"pictures"=>$pictures,"count_seen"=>$count_seen->count(), "more_products"=>$more_products,'favs'=>$favs, 'isFav'=>$isFav]);
		return view("detail", ["product"=>$product,"pictures"=>$pictures,"count_seen"=>$count_seen, "more_products"=>$more_products,'favs'=>$favs, 'isFav'=>$isFav,'cover_photo'=>$cover_photo]);
    }

    public function sell(Request $request)
    {
		$cities = City::all();
		$category = Category::where('status',">",0)->get();
		$markets = market::where("uid","=",Auth::id())->get();
    	return view("sell",['category'=>$category,'cities'=>$cities, 'uniqid'=>uniqid(), 'markets'=>$markets]);
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
			"image"=>'required',
			'nov'=>'integer'
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
			'nov'=>'Növ düzgün formatda deyil. Rəqəm olmalıdır.'
			// 'files.required'=>'Elanın ən az bir şəklini yerləşdirməlisiniz'
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);
		
		if ($validator->fails()) {
			// dd($validator->fails);
    		return redirect('sell')->withErrors($validator)->withInput();
		}

		$lastId = Product::orderBy("id","DESC")->first();
		if(empty($lastId)){
			$addId = 1;
		}else{
			$addId = $lastId->id+1;
		}

		if($request->market == 0)$request->market = '';
		// $nov = $request->nov ? '"nov"=>'.$request->nov : "";
		// return $nov;

		if(Auth::user()){
			$prNumber = Product::create(["product_name"=>$request->product_name,"product_category"=>$request->nov ? $request->nov : $request->product_category,"product_price"=>$request->product_price,"product_description"=>$request->product_description,"merchant_number"=>$request->merchant_number,
			"user_id" => Auth::user()->id,
			"product_merchant"=>$request->product_merchant,
			"closed_at"=>date('Y-m-d H:i:s', strtotime('+30 days')),
			'uniqid'=>$request->t,
			'market_id'=>$request->market,
			'new'=>$request->new,
			'delivery'=>$request->delivery,
			"slug"=>Str::slug($addId."-".$request->product_name, '-')])->id;
			
		}else{
			// User olmadiqda .. hazirda bu funksiya islemir
			$prNumber = Product::create(["product_name"=>$request->product_name,"product_category"=>$request->nov ? $request->nov : $request->product_category,"product_price"=>$request->product_price,"product_description"=>$request->product_description,"merchant_number"=>$request->merchant_number,"product_merchant"=>$request->product_merchant,
			"closed_at"=>date('Y-m-d H:i:s', strtotime('+30 days')),
			'new'=>$request->new,
			'delivery'=>$request->delivery,
			$nov,
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

		$sl = Product::where("id","=",$prNumber)->first();

		// return redirect("sell")->withInput(["success"=>"Məhsulunuz müvəffəqiyyətlə əlavə edildi."]);

			


				$to = "togrul.zade@yandex.ru";
				$subject = $request->product_name." - Minify.az-a əlavə edildi<br/>";
				$txt = "Title: ".$request->product_name."<br/>Description: ".$request->product_description."<br/> Market:".$request->merchant_number."<br/> User: ".Auth::user()->id."<br/>Price: ".$request->product_price."<br/>";
				$headers = "From: togrulzade@gmail.com" . "\r\n";
				mail($to,$subject,$txt,$headers);
			// error_reporting($errLevel);  // restore old error levels
			
			
		// return redirect("/product/".$sl->slug)->withInput(["success"=>"Məhsulunuz müvəffəqiyyətlə əlavə edildi."]);
    }

	public function getByCategory(Request $request)
	{
		$isCategoryRoute = request()->routeIs('category');
		$cat = explode("/",$request->cat);
		$current_cat = $request->cat;
		$cc = explode("/",$request->cat);
		$ccc = Category::whereIn("slug",$cc)->get();


		$getCat = Category::where('slug',"=",$cat[count($cat)-1])->first();
		if($getCat){
			$parent_category = Category::where('id',"=",$getCat->parent_id)->first();
			$take = SettingsHelper::take();
			$subCategory = Category::where('parent_id',"=",$getCat->id)->get();
			$collection = collect([]);
			foreach($subCategory as $i=>$sc){
				$collection->push($sc->id);
			}

			if($collection->all()){
				$sub2 = Category::where('parent_id',"=",$collection->all())->get();

				foreach($sub2 as $s2){
					$collection->push($s2->id);
				}
			}
			$collection->push($getCat->id);

			
			$vips = Product::with('pictures')
			->whereHas('pictures',function($q){
				return $q->where('pictures.cover',"=",1);
			})
			->with('vip')
			->whereHas('vip',function($q){
				return $q->where('closed_at',">", date('Y-m-d H:i:s'));
			})
			->where('products.active',"=",1)
			// ->where("product_category","=",$getCat->id)
			->whereIn('products.product_category',$collection->all())
			->where('closed_at',">", date('Y-m-d H:i:s'))
			->orderBy('updated_at',"DESC")
			->limit(7)
			->get();

			if($subCategory){
				$products = Product::with('pictures')
				->whereHas('pictures', function($q){
					return $q->where('pictures.cover',"=",1);
				})
				->with('category')
				// ->where('products.product_category',"=",$getCat->id)
				->whereIn('products.product_category',$collection->all())
				->where('products.active','=',1)
				->where('closed_at',">", date('Y-m-d H:i:s'))
				->orderBy('products.updated_at',"DESC")
				->get();
			}

			$favs = FavHelper::getFavs($request);

			return view('byCategory', ['products'=>$products, 'favs'=>$favs, 'vips'=>$vips, 'categoryName'=>$getCat->name,'subCategory'=>$subCategory,'isCategoryRoute'=>$isCategoryRoute,'parent_category'=>$parent_category,'current_cat'=>$ccc]);
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

	public function edit(Request $request)
	{
		$uniqid = $request->uniqid;
		$product = Product::where('uniqid','=',$uniqid)->first();
		
		if(!$product)
			return abort(404);
		if($product){
			if($product->user_id != Auth::id()){
				return abort(404);
			}
		}
		
		return view('edit',compact('product'));
	}

	public function editAction(Request $request)
	{
		$uniqid = $request->key;
		$product = Product::where('uniqid','=',$uniqid)->first();

		if(!$product)
			return abort(404);
		if($product){
			if($product->user_id != Auth::id()){
				return abort(404);
			}
		}

        $product->product_name = $request->name;
        $product->product_description = $request->description;
        $product->product_price = $request->price;
        $product->merchant_number = $request->merchant_number;
        $product->product_category = $request->product_category;
        $product->active = 0;
        if($product->update()){
            return redirect('/product/'.$product->slug)->withInput(["success"=>"Elanınız düzəlişə göndərildi. Minify Moderatorları tərəfindən təsdiq gözləyir."])->withInput();
        }
	}

	public function searching(Request $request)
	{
		$search = $request->search;
		if($search == '')
			return 'empty';
		
		$products = Product::where('product_name',"like","%".$search."%")
		->with('pictures')
		->whereHas('pictures',function($q){
			return $q->where('cover',"=",1);
		})
		->where('products.closed_at',">",date('Y-m-d H:i:s'))
		->where('products.active',1)
		->orderby('products.updated_at','DESC')
		->groupBy('products.product_name')
		->limit(3)
		->get();

		$categories = Category::where('name',"like","%".$search."%")->get();

		return compact('products','categories');
	}

	public function checkCategory(Request $request)
	{
		$category = $request->category;
		if(intval($category) != 0){
			$subCategory = Category::where('parent_id',"=",$category)->get();
			return $subCategory;
		}else{
			return 'no';
		}
	}

	public function loadProduct(Request $request)
	{
		$take = SettingsHelper::take();
		$products = ProductHelper::allAktivElanlar($request->p, $take->take);
		// $products = ProductHelper::PremiumElanlar($request->p, $take->take);
		return $products;
	}
}
