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

Route::get('/', function () {
    return view('welcome');
});
Route::get('manage-category',['as'=>'manage-category.view', 'uses' => 'ManageCategoryController@index']);
Route::get('manage-category/edit/{cate_id}',['as'=> 'manage-category.edit','uses' => 'ManageCategoryController@edit']);
Route::put('manage-category/edit/{cate_id}', ['as' => 'manage-category.update', 'uses' => 'ManageCategoryController@update']);
Route::get('manage-category/delete/{cate_id}',['as'=>'manage-category.delete' ,'uses' =>'ManageCategoryController@destroy']);
Route::get('manage-category/new', ['as' => 'manage-category.new', 'uses' => 'ManageCategoryController@create']);
Route::post('manage-category/new', ['as' => 'manage-category.new', 'uses' => 'ManageCategoryController@store']);
Route::post('manage-category/editImg', ['as' => 'manage-category.updateImage', 'uses' => 'ManageCategoryController@imageUploadPost']);

Route::get('manage-product',['as'=> 'manage-product.view','uses'=> 'ManageProductsController@index']);
Route::get('manage-product/new',['as'=> 'manage-product.new','uses'=> 'ManageProductsController@create']);
Route::post('manage-product/new',['as'=> 'manage-product.new','uses'=> 'ManageProductsController@store']);
Route::get('manage-product/edit/{prod_id}',['as'=> 'manage-product.edit','uses'=> 'ManageProductsController@edit']);
Route::post('manage-product/edit/{prod_id}',['as'=> 'manage-product.update','uses'=> 'ManageProductsController@update']);
Route::post('manage-product/editImg',['as'=> 'manage-product.updateImage','uses'=> 'ManageProductsController@updateImage']);
Route::get('manage-product/delete/{prod_id}',['as'=> 'manage-product.delete','uses'=> 'ManageProductsController@destroy']);


Route::prefix('/order')->group(function () {
	Route::get('/current-orders',['as'=>'order.current','uses'=>'ManageOrders@current_orders']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
/*Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});*/
