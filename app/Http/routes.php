<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('login',['as'=>'login','uses'=>'LoginController@index']);
Route::get('register-new-user',['as'=>'login','uses'=>'LoginController@register']);
Route::post('save-user', 'LoginController@save_user');
Route::post('check-login', 'LoginController@authenticate_user');
  Route::get('api-product-details/{apikey}', 'ProductController@api_product_details');


Route::group(['middleware'=>['auth']],function(){
	// Seperate controllers for each module	
	Route::get('dashboard', 'HomeController@index');
	Route::get('/', 'HomeController@index');
    Route::get('logout', 'HomeController@logout');
    Route::get('manage-products', 'ProductController@index');
    Route::get('create-new-product', 'ProductController@create_product');
    Route::get('api-details', 'HomeController@api_details');
    Route::get('edit-product/{id}', 'ProductController@edit_product');
    Route::get('search-product', 'ProductController@search_product');
    Route::post('save-product', 'ProductController@save_product');
    Route::post('view-product', 'ProductController@view_product');
    Route::post('get-product-data', 'ProductController@getProductData');
    Route::patch('update-product/{id}',['as'=>'update-product','uses'=>'ProductController@update_product']);
    Route::delete('delete-product/{id}',['as'=>'delete-product','uses'=>'ProductController@delete_product']);







});






