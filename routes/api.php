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

//Routes with auth
Route::group(['prefix' => 'v1'], function () {

	Route::group(['middleware'=>['cors']], function(){
		Route::post('/auth','Services\ApiauthController@Authenicates');
		Route::post('/register',['as'=>'register','uses'=>'Services\ApiauthController@Register']);
	});
	Route::get('/dataset/download/{fileName}',['as'=>'dataset.download','uses'=>'Services\ExportDatasetController@downloadFile']);

	Route::group(['middleware'=>['auth:api','cors']], function(){

		Route::get('/users', function (Request $request) {
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
		Route::get('/dataset/export/{id}',['as'=>'dataset.export','uses'=>'Services\ExportDatasetController@export']);
		Route::get('/schema',['as'=>'Services\SchemaApiController','uses'=>'Services\SchemaApiController@allSchema']);
		Route::get('/goalData/{id}','Services\GoalApiController@goalData');
		Route::post('/store/visual',['as'=>'visualization.store','uses'=>'Services\VisualizationController@store']);
		Route::get('/visual/list',['as'=>'visualization.list','uses'=>'Services\VisualizationController@visualList']);
		Route::get('/visual/{id}',['as'=>'visualization.single','uses'=>'Services\VisualizationController@visualByID']);
		Route::get('/indicators',['as'=>'indicators','uses'=>'Services\IndicatorsController@indicators']);
		Route::get('/pages',['as'=>'pages.list','uses'=>'Services\PagesApiController@getAllPages']);
		Route::get('/pages/{page_slug}',['as'=>'pages.by_slug','uses'=>'Services\PagesApiController@getPageBySlug']);
		Route::get('/dataset/chartdata/{id}',['as'=>'list','uses'=>'Services\DatasetsController@getFormatedDataset']);
		Route::get('/dataset/lastdataset/columns',['as'=>'last.dataset.columns','uses'=>'Services\ImportdatasetController@getColumns']);
		// API routes
		Route::get('routes',function(){
			return view('roles.index');
		});

	});
});

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/
