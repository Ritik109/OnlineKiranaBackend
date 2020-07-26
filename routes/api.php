<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/alluser', 'UsersController@index');
Route::post('/newuser','UsersController@store');
Route::post('/login','LoginController@validateCred');
Route::get('/getCategories','CategoryController@fetchAll');
Route::get('/getTopPics','TopPicsController@index');


Route::namespace('Api')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('/app-home-page/{userId}','AppHomePageController@index');
    Route::get('/item-search/{search_item}','ItemSearchController@search_item');
    Route::get('/get-category/{category_name}','CategoryController@get_category');
    Route::prefix('/address')->group(function () {
        Route::get('/get-all/{userId}', 'AddressController@index');
        Route::post('/add/{userId}','AddressController@store');
        Route::post('/update/{AddressId}','AddressController@update');
    });
    Route::prefix('/cart')->group(function () {
        Route::get('/add-to-cart/{userId}/{productId}/{event}', 'CartController@add_to_cart');
        Route::get('/cart-items/{userId}','CartController@cart_items');
        Route::get('/checkout/{userId}/{addressId?}','CartController@checkout');
    });
});
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});