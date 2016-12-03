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

Route::group(['prefix' => 'v1'], function () {
	Route::group(['middleware'=>['auth:api','cors']], function(){
		Route::get('/user', function (Request $request) {
		    return $request->user();
		});
		Route::post('/dataset/import',['as'=>'import','uses'=>'ImportdatasetController@uploadDataset']);
		Route::get('/csv',['as'=>'csv','uses'=>'ImportdatasetController@checkCSV']);
	});
});

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/

