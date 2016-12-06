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
Route::post('/auth','Services\ApiauthController@Authenicates');
Route::post('/register','Services\ApiauthController@Register');


});


Route::group(['prefix' => 'v1'], function () {
	Route::group(['middleware'=>['auth:api','cors']], function(){
		Route::get('/user', function (Request $request) {
		    return $request->user();
		});
		

		Route::post('/dataset/import',['as'=>'import','uses'=>'Services\ImportdatasetController@uploadDataset']);
		Route::get('/dataset/list',['as'=>'list','uses'=>'Services\DatasetsController@getDatasetsList']);
		Route::get('/dataset/view/{id}',['as'=>'list','uses'=>'Services\DatasetsController@getDatasets']);
		Route::get('/department/list',['as'=>'department.list','uses'=>'Services\DepartmentApiController@departmentList']);
		Route::get('/department/{id}',['as'=>'department.single','uses'=>'Services\DepartmentApiController@singleDepartment']);
		Route::get('/ministry/list',['as'=>'ministry.list','uses'=>'Services\MinistryApiController@ministryList']);
		Route::get('/ministry/{id}',['as'=>'ministry.single','uses'=>'Services\MinistryApiController@singleMinistry']);
		Route::get('/goals/list',['as'=>'goals.list','uses'=>'Services\GoalApiController@goalsList']);
		Route::get('/goals/{id}',['as'=>'goal.single','uses'=>'Services\GoalApiController@singleGoal']);
		Route::get('/csv',['as'=>'csv','uses'=>'Services\ImportdatasetController@checkCSV']);
	});
});

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/

