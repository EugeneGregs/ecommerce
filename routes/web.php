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

//User roots
Route::get('/users','UserController@index');
Route::get('/users/{id}','UserController@show');
Route::delete('/users/{id}','UserController@destroy');

//auth routes
Auth::routes();

//category roots
Route::get('/categories','CategoryController@index');
Route::get('/categories/create','CategoryController@create');
Route::post('/categories','CategoryController@store');
Route::get('/categories/edit/{id}','CategoryController@edit');
Route::get('/categories/{id}','CategoryController@show');
Route::patch('/categories/{id}','CategoryController@update');
Route::delete('/categories/{id}','CategoryController@destroy');

//home root
Route::get('/home', 'HomeController@index')->name('home');

//feature routes
Route::get('/features','FeatureController@index');
Route::get('/features/create','FeatureController@create');
Route::post('/features','FeatureController@store');
Route::get('/features/edit/{id}','FeatureController@edit');
Route::get('/features/{id}','FeatureController@show');
Route::patch('/features/{id}','FeatureController@update');
Route::delete('/features/{id}','FeatureController@destroy');

//products routes
Route::get('/products','ProductController@index');
Route::get('/products/create','ProductController@create');
Route::post('/products','ProductController@store');
Route::get('/products/edit/{id}','ProductController@edit');
Route::get('/products/{id}','ProductController@show');
Route::patch('/products/{id}','ProductController@update');
Route::delete('/products/{id}','ProductController@destroy');

//product-feature routes
Route::get('/product_features/{product_id}','Product_featureController@index');
Route::get('/product_features/create/{product_id}','Product_featureController@create');
Route::get('/product_features/{product_id}/{feature_id}','Product_featureController@edit');
Route::post('/product_features','Product_featureController@store');
Route::patch('/product_features/{feature_id}','Product_featureController@update');
Route::delete('/product_features/{product_id}/{feature_id}','Product_featureController@destroy');

