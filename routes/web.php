<?php
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('admin/', 'Admin\AdminController@index');
    Route::get('admin/showTesdiq', 'Admin\AdminController@showTesdiq');
    Route::post('admin/product/tesdiqle', 'Admin\AdminController@elantesdiqle');
    Route::get('admin/showDuzelis', 'Admin\AdminController@showDuzelis');
    Route::get('admin/edit/{pid}', 'Admin\AdminController@edit');
    Route::get('admin/delete/{pid}', 'Admin\AdminController@delete');
    Route::post('admin/edit/action', 'Admin\AdminController@editAction');
    Route::get('admin/categoryEdit', 'Admin\AdminController@categoryEdit');
    Route::get('admin/logregister', 'Admin\AdminController@logregister');
    Route::get('admin/todaysusers', 'Admin\AdminController@todaysUsers');
    Route::post('admin/todaysusers', 'Admin\AdminController@todaysUsersAction');
});

Route::group(['prefix'=>''],function () {


Route::get("/", "HomeController@index");
Route::get("/logo", "HomeController@logo");
Route::get("/stores", "HomeController@index");
Route::get("/product/{slug}", "ProductController@index")->name('detail');
Route::get("/sell", "ProductController@sell")->middleware('auth');
Route::get("/cv", "HomeController@cv");
Route::post("/sell", "ProductController@sellAction")->middleware('auth');
Route::get("/c/{cat}", "ProductController@getByCategory")
        ->where('cat','^[a-zA-Z0-9-_\/]+$')->name('category');
Route::get("update", "ProductController@update");
Route::get("axtar", "HomeController@axtar");
Route::post("addFavs", "FavController@addFavs");
Route::get("showFavs", "FavController@show");
Route::get("test", "HomeController@test");
Route::get("cabinet", "CabinetController@index")->middleware('auth');
Route::get("profile", "ProfileController@index");
Route::post("uploadImage", "PictureController@uploadImage");
Route::get("verifyEdition/{uniqid}", "ProductController@verifyEdition")->middleware('auth');
Route::get("edit/{uniqid}", "ProductController@edit")->middleware('auth');
Route::post("editAction", "ProductController@editAction")->middleware('auth');
Route::get("loadProduct", "ProductController@loadProduct");
Route::get("makeMarket", "marketController@index")->middleware('auth');
Route::post("makeMarket", "marketController@create")->middleware('auth');
Route::get("myMarket", "marketController@myMarket")->middleware('auth');
Route::get("market/{slug}", "marketController@showMarket");
Route::get("subGrab", "SubCategoryController@index");
Route::post("checkVip", "VipController@checkVip");
Route::post("makeVip", "VipController@makeVip");
Route::post("checkPremium", "PremiumController@checkPremium");
Route::post("makePremium", "PremiumController@makePremium");
Route::get("elanlar/vip", "VipController@all");
Route::get("elanlar", "HomeController@elanlar");
Route::post("makeVipWithNumber", "VipController@checkProduct");
Route::post("makeCover", "PictureController@makeCover")->middleware('auth');
Route::get("searching", "ProductController@searching");
Route::post("checkCategory", "ProductController@checkCategory");
});
Route::get("grab", "GrabController@index");
Route::get('test', function(){
    $url = "https://graph.facebook.com/v13.0/100681546069592/messages";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "X-Custom-Header: value",
   "Content-Type: application/json",
   "Authorization: Bearer EAALFxiC2zIkBAEZAW6VRapoSFNb1ImolwP0ppBtsfpZCZBM5OxXYnh663jOC4ly5xkbPuIZB34cENIKeuZCfrctkvVrXChAm3ZCKGvQx9zlMcnJyTGJkC66PohnngtZCPKIn26t6hVgXo9yBzEW1C8sqDxVsJy3YXT5NgWqu9ZAad9m5SBayIGNzbAQupcNZCpBRiRXDkpZA0wHTGTZCXD1vZA9ZCzZBTLRqgVbm8ZD",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = '{ "messaging_product": "whatsapp", "to": "994708827974", "type": "template", "template": { "name": "hello_world", "language": { "code": "en_US" } } }';

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
    
});

Auth::routes();
Route::get('/logout', '\minify\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
