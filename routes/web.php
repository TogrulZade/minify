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
Route::get("/product/{slug}", "ProductController@index");
Route::get("/sell", "ProductController@sell")->middleware('auth');
Route::get("/cv", "HomeController@cv");
Route::post("/sell", "ProductController@sellAction")->middleware('auth');
Route::get("/c/{cat}", "ProductController@getByCategory");
Route::get("update", "ProductController@update");
Route::get("axtar", "HomeController@axtar");
Route::post("addFavs", "FavController@addFavs");
Route::get("showFavs", "FavController@show");
Route::get("test", "HomeController@test");
Route::get("cabinet", "CabinetController@index")->middleware('auth');
Route::get("profile", "ProfileController@index");
Route::post("uploadImage", "PictureController@uploadImage");
Route::get("verifyEdition/{uniqid}", "ProductController@verifyEdition")->middleware('auth');


Auth::routes();
Route::get('/logout', '\minify\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
