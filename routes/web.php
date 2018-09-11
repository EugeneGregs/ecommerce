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

// Route::get('/', function () {
//     return view('welcome');
// });

//admin roots
Route::get('/','UserController@index');
Route::get('/users','UserController@getUsers');
Auth::routes();


//category roots
Route::get('/categories','CategoryController@index');
Route::get('/categories/create','CategoryController@create');
Route::post('/categories','CategoryController@store');
Route::get('/categories/edit/{id}','CategoryController@edit');
Route::get('/categories/{id}','CategoryController@show');
Route::patch('/categories/{id}','CategoryController@update');
Route::delete('/categories/{id}','CategoryController@destroy');



Route::get('/home', 'HomeController@index')->name('home');
