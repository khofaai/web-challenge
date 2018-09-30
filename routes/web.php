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


Route::get('/{vue_capture?}', 'BaseController@index')->where('vue_capture', '[\/\w\.-]*');
Route::post('/user/create','Auth\RegisterController@createUser');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'authorize_client'], function () {

	Route::post('/load-narby-shops',"ShopController@loadNearbyShops");
	Route::post('/load-preferred-shops',"ShopController@loadPreferredShops");
	Route::post('/like-shop',"ShopController@likeShop");
	Route::post('/dislike-shop',"ShopController@dislikeShop");
	Route::post('/remove-shop',"ShopController@removeShop");
});