<?php

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
  
Route::group(['middleware' => ['auth']], function () {
    Route::get('admin/', 'Admin\AdminController@index');
    Route::get('admin/showTesdiq', 'Admin\AdminController@showTesdiq');
    Route::post('admin/product/tesdiqle', 'Admin\AdminController@elantesdiqle');
    Route::get('admin/showDuzelis', 'Admin\AdminController@showDuzelis');
    Route::get('admin/edit/{pid}', 'Admin\AdminController@edit');
    Route::post('admin/edit/action', 'Admin\AdminController@editAction');
});

Route::get("/", "HomeController@index");
Route::get("/logo", "HomeController@logo");
Route::get("/stores", "HomeController@index");
Route::get("/product/{slug}", "ProductController@index")->name('detail');
Route::get("/sell", "ProductController@sell")->middleware('auth');
Route::get("/cv", "HomeController@cv");
Route::post("/sell", "ProductController@sellAction")->middleware('auth');
Route::get("/c/{cat}", "ProductController@getByCategory")
        ->where('cat','^[a-zA-Z0-9-_\/]+$');
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


Auth::routes();
Route::get('/logout', '\minify\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
