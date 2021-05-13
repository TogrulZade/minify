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
});

Route::get("/", "HomeController@index");
Route::get("/logo", "HomeController@logo");
Route::get("/stores", "HomeController@index");
Route::get("/product/{slug}", "ProductController@index");
Route::get("/sell", "ProductController@sell");
Route::get("/cv", "HomeController@cv");
Route::post("/sell", "ProductController@sellAction");
Route::get("/c/{cat}", "ProductController@getByCategory");
Route::get("update", "ProductController@update");

Auth::routes();
Route::get('/logout', '\minify\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
