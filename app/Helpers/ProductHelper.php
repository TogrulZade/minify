<?php 

namespace minify\Helpers;
use minify\Product;
use minify\ireli;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductHelper{
    
    public static function aktivElanlar()
    {
        $id = Auth::user()->id;
        $all = Product::where('closed_at',">=",date('Y-m-d H:i:s'))->where('user_id',"=",$id)->orderBy('created_at','DESC')->where('active',"=",1)->get();
        return $all;
    }

    public static function yoxlanilanElanlar()
    {
        $id = Auth::user()->id;
        $all = Product::with('pictures')->whereHas('pictures',function($q){
			return $q->where('pictures.cover',"=",1);
		})->where('closed_at',">=",date('Y-m-d H:i:s'))->where('user_id',"=",$id)->orderBy('products.created_at','DESC')->where('active',"=",0)->get();
        return $all;
    }

    public static function duzelisElanlar()
    {
        $id = Auth::user()->id;
        $all = Product::with('pictures')->whereHas('pictures',function($q){
			return $q->where('pictures.cover',"=",1);
		})->where('closed_at',">=",date('Y-m-d H:i:s'))->where('user_id',"=",$id)->orderBy('products.created_at','DESC')->where('active',"=",2)->get();
        return $all;
    }

    public static function allAktivElanlar($page = 0, $take = 5){
        

        $ireli = Product::with(['pictures'])
        ->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })
        ->inRandomOrder()
        ->doesntHave('vip')
        ->join('ireli','ireli.product_id',"products.id")
        ->where('ireli.closed_at',">",date('Y-m-d H:i:s'))
        ->where('active',"=",'1')
        ->select('*', 'products.id as id','products.created_at as created_at')
        ->skip($page*$take)
        ->take($take)
        ->orderBy("ireli.id","DESC")
        ->get();

        $ireli_count = count($ireli);

        $products = Product::with(['pictures'])
        ->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })
        // ->doesntHave('vip')
        ->doesntHave('ireli')
        ->where('products.closed_at',">",date('Y-m-d H:i:s'))
        ->where('active',"=",'1')
        ->inRandomOrder()
        ->select('*', 'products.id as id','products.created_at as created_at')
        ->skip($page*$take)
        ->take($take-$ireli_count)
        ->orderBy("products.id","DESC")
        ->get()->random($take-$ireli_count);
        

        $ireli = collect($ireli);
        $products = collect($products);
        $merged = $ireli->merge($products);
        return $merged;
    }


    public static function allAktivElanlarWithPaginate($page = 0, $take = 5,$paginate=8){

        $ireli = Product::with(['pictures'])
        ->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })
        ->inRandomOrder()
        ->doesntHave('vip')
        ->join('ireli','ireli.product_id',"products.id")
        ->where('ireli.closed_at',">",date('Y-m-d H:i:s'))
        ->where('active',"=",'1')
        ->select('*', 'products.id as id','products.created_at as created_at')
        ->orderBy("ireli.id","DESC");


        $products = Product::with(['pictures'])
        ->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })
        ->doesntHave('vip')
        ->doesntHave('ireli')
        ->where('products.closed_at',">",date('Y-m-d H:i:s'))
        ->where('active',"=",'1')
        ->inRandomOrder()
        ->select('*', 'products.id as id','products.created_at as created_at')
        ->orderBy("products.id","DESC");
        

        $ireli = collect($ireli);
        $products = collect($products);
        $merged = $ireli->merge($products);
        $pag = new ProductHelper();
        dd($pag->paginate($merged));
        // return $pag->paginate($merged);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function premiumElanlar()
    {
        $premiums = Product::with(['pictures'])
        ->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })
        ->with("premium")
        ->where('products.closed_at',">",date('Y-m-d H:i:s'))
        ->where('active',"=",'1')->select('*', 'products.id as id')->orderBy("products.started_at","DESC")
        ->get();
        return $premiums;
    }

    public static function vipElanlar($take = 4){
        return Product::with('pictures')->whereHas('pictures',function($q){
            return $q->where('pictures.cover',"=",1);
        })->whereHas('vip',function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        })->with(['premium'=>function($q){
            return $q->where('closed_at',">", date('Y-m-d H:i:s'));
        }])->take($take)
        ->inRandomOrder()
        ->get();


    }
    
    public static function waiting()
    {
        $products = Product::with(['pictures'])->whereHas('pictures', function($q){
            return $q->where('pictures.cover',"=",1);
        })->where('products.closed_at',">",date('Y-m-d H:i:s'))->where('active',"=",'0')->select('*', 'products.id as id')->get();
        return $products;
    }

    public static function duzelis()
    {
        $products = Product::with(['pictures'])->whereHas('pictures', function($q){
            return $q->where('pictures.cover'   ,"=",1);
        })->where('products.closed_at',">",date('Y-m-d H:i:s'))->where('active',"=",'2')->select('*', 'products.id as id')->get();
        return $products;
    }

    public static function hasPid($pid)
    {
        $find = Product::find($pid);
        if($find == null){
            return false;
        }else{
            return true;
        }
    }
}

?>