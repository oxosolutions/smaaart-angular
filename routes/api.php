<?php

use Illuminate\Http\Request;

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

		// main\dataset\view-dataset/view-dataset.controller.js  (ViewDatasetController)
		Route::get('/dataset/view/{id}',['as'=>'list','uses'=>'Services\DatasetsController@getDatasets']);

		Route::get('/department/list',['as'=>'department.list','uses'=>'Services\DepartmentApiController@departmentList']);
		Route::get('/department/{id}',['as'=>'department.single','uses'=>'Services\DepartmentApiController@singleDepartment']);
		Route::get('/ministry/list',['as'=>'ministry.list','uses'=>'Services\MinistryApiController@ministryList']);
		Route::get('/ministry/{id}',['as'=>'ministry.single','uses'=>'Services\MinistryApiController@singleMinistry']);
		Route::get('/goals/list',['as'=>'goals.list','uses'=>'Services\GoalApiController@goalsList']);
		Route::get('/goals/{id}',['as'=>'goal.single','uses'=>'Services\GoalApiController@singleGoal']);
		Route::get('/dataset/export/{id}',['as'=>'dataset.export','uses'=>'Services\ExportDatasetController@export']);
		Route::get('/schema',['as'=>'Services\SchemaApiController','uses'=>'Services\SchemaApiController@allSchema']);
		// main\goal\view-goal\view-goal.controller.js (line 60)
		Route::get('/goalData/{id}','Services\GoalApiController@goalData');
		Route::post('/store/visual',['as'=>'visualization.store','uses'=>'Services\VisualizationController@store']);
		Route::get('/visual/list',['as'=>'visualization.list','uses'=>'Services\VisualizationController@visualList']);
		Route::get('/visual/{id}',['as'=>'visualization.single','uses'=>'Services\VisualizationController@visualByID']);
		Route::get('/indicators',['as'=>'indicators','uses'=>'Services\IndicatorsController@indicators']);
		// main\page\page.controller.js (line 30)
		Route::get('/pages',['as'=>'pages.list','uses'=>'Services\PagesApiController@getAllPages']);
		Route::get('/pages/{page_slug}',['as'=>'pages.by_slug','uses'=>'Services\PagesApiController@getPageBySlug']);
		Route::get('/dataset/chartdata/{id}',['as'=>'list','uses'=>'Services\DatasetsController@getFormatedDataset']);
		Route::get('/dataset/validate/columns/{id}',['as'=>'validate.columns','uses'=>'Services\ImportdatasetController@getColumns']);
		Route::post('/visual/settings',['as'=>'store.visual.settings','uses'=>'Services\VisualizationController@storeVisualOptionsAndSettings']);
		Route::post('/dataset/savevalidatecolumns',['as'=>'validate.columns','uses'=>'Services\DatasetsController@SavevalidateColumns']);
		Route::get('/dataset/delete/{id}',['as'=>'validate.columns','uses'=>'Services\DatasetsController@deleteDataset']);
		Route::get('/visual/delete/{id}',['as'=>'validate.columns','uses'=>'Services\VisualizationController@deleteVisual']);
		// API routes
		Route::get('routes',function(){
			return view('roles.index');
		});

	});
});

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/
