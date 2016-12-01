<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::group(['middleware'=>'auth'], function(){

	Route::get('/', ['as'=>'home', 'uses'=>'DashboardController@index']);
	Route::get('/api_users', ['as'=>'api.users', 'uses'=>'ApiusersController@index']);
	Route::get('/get_users', ['as'=>'api.get_users', 'uses'=>'ApiusersController@get_users']);
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

/*Route::get('/home', 'HomeController@index');*/