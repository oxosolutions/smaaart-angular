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

	/*Routes of Department Operations*/
	Route::get('/departments',['as'=>'department.list', 'uses'=>'DepartmentController@index']);
	Route::get('/departments/create',['as'=>'department.create', 'uses'=>'DepartmentController@create']);
	Route::post('/department/store',['as'=>'department.store', 'uses'=>'DepartmentController@store']);
	Route::get('/department/delete/{id}',['as'=>'department.delete', 'uses'=>'DepartmentController@destroy']);
	Route::get('/list_depart',['as'=>'department.ajax', 'uses'=>'DepartmentController@get_departments']);

	/*Routes for ministries operations*/
	Route::get('/ministries',['as'=>'ministries.list','uses'=>'MinistriesController@index']);
	Route::get('/list_minist',['as'=>'ministries.ajax', 'uses'=>'MinistriesController@get_ministries']);
	Route::get('/ministries/create',['as'=>'ministries.create', 'uses'=>'MinistriesController@create']);
	Route::post('/ministries/store',['as'=>'ministries.store', 'uses'=>'MinistriesController@store']);
	Route::get('/ministries/delete/{id}',['as'=>'ministries.delete', 'uses'=>'MinistriesController@destroy']);

	/*Routes for goals operations*/
	Route::get('/goals',['as'=>'goals.list','uses'=>'GoalsController@index']);
	Route::get('/list_goals',['as'=>'goals.list.ajax','uses'=>'GoalsController@goalsList']);
	Route::get('/goals/create',['as'=>'goals.create','uses'=>'GoalsController@create']);
	Route::post('/goals/store',['as'=>'goals.store','uses'=>'GoalsController@store']);
	Route::get('/goals/delete/{id}',['as'=>'goals.delete', 'uses'=>'GoalsController@destroy']);
	Route::get('/goals/edit/{id}',['as'=>'goals.edit', 'uses'=>'GoalsController@edit']);
	Route::patch('/goals/update/{id}',['as'=>'goals.update', 'uses'=>'GoalsController@update']);

	/*Routes of API users*/
	Route::get('/api_users', ['as'=>'api.users', 'uses'=>'ApiusersController@index']);
	Route::get('/get_users', ['as'=>'api.get_users', 'uses'=>'ApiusersController@get_users']);
	Route::get('/api_users/create', ['as'=>'api.create_users', 'uses'=>'ApiusersController@create']);
	Route::post('/api_users/store', ['as'=>'api.store_users', 'uses'=>'ApiusersController@store']);
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');