<?php

use Illuminate\Http\Request;


	// Route::get('/userlists',['as'=>"user.list", 'uses'=>'Services\ApiauthController@listUser']);

Route::group(['prefix' => 'v1'], function () {

	Route::group(['middleware'=>['cors']], function(){
		Route::post('/auth','Services\ApiauthController@Authenicates');
		Route::post('/register',					['as'=>'register','uses'=>'Services\ApiauthController@Register']);
		Route::get('/goals/list',					['as'=>'goals.list','uses'=>'Services\GoalApiController@goalsList']);
		Route::get('/goalData/{id}',			    'Services\GoalApiController@goalData');
		Route::get('/pages',						['as'=>'pages.list','uses'=>'Services\PagesApiController@getAllPages']);
		Route::get('/pages/{page_slug}',			['as'=>'pages.by_slug','uses'=>'Services\PagesApiController@getPageBySlug']);
		Route::get('/profile/ministries',			['as'=>'ministries','uses'=>'Services\MinistryApiController@Ministries']);
		Route::get('/departments',					['as'=>'departments','uses'=>'Services\DepartmentApiController@departments']);
		Route::get('/designation/list',				['as'=>'Designation.list','uses'=>'Services\DesignationApiController@DesignitionList']);
		Route::get('/department/list',				['as'=>'department.list','uses'=>'Services\DepartmentApiController@departmentList']);
		Route::get('/department/{id}',				['as'=>'department.single','uses'=>'Services\DepartmentApiController@singleDepartment']);
		Route::get('/resources/list',				['as'=>'Resources.list','uses'=>'Services\ResourcesApiController@ResourcesList']);
		Route::get('/ministry/list',				['as'=>'ministry.list','uses'=>'Services\MinistryApiController@ministryList']);
		Route::get('/ministry/{id}',				['as'=>'ministry.single','uses'=>'Services\MinistryApiController@singleMinistry']);
		Route::get('/goals/{id}',					['as'=>'goal.single','uses'=>'Services\GoalApiController@singleGoal']);
		Route::get('/schema',						['as'=>'Services\SchemaApiController','uses'=>'Services\SchemaApiController@allSchema']);
		Route::get('/indicators',					['as'=>'indicators','uses'=>'Services\IndicatorsController@indicators']);
		Route::post('/forget',						['as'=>'forget.password','uses'=>'Services\ApiauthController@forgetPassword']);
		Route::get('/validateForgetToken/{token}',	['as'=>'forget.token.validate','uses'=>'Services\ApiauthController@validateForgetPassToken']);
		Route::post('/resetpass',					['as'=>'forget.token.validate','uses'=>'Services\ApiauthController@resetUserPassword']);
	});

	//No need to put in middleware['cors'], needs to access directly from browser
	Route::get('/dataset/download/{fileName}',  ['as'=>'dataset.download','uses'=>'Services\ExportDatasetController@downloadFile']);

	Route::group(['middleware'=>['auth:api','cors']], function(){

		Route::get('/users', function (Request $request) {
		    return $request->user();
		});
		Route::get('/userlists',['as'=>"user.list", 'uses'=>'Services\ApiauthController@listUser']);
		Route::get('/editUser/{id}',['as'=>"user.edit", 'uses'=>'Services\ApiauthController@editUser']);
		Route::get('/user/approve/{id}',['as'=>"user.approve", 'uses'=>'Services\ApiauthController@approveUser']);
		Route::get('/user/unapprove/{id}',['as'=>"user.unapprove", 'uses'=>'Services\ApiauthController@unApproveUser']);
		Route::post('/user/update',['as'=>"user.update", 'uses'=>'Services\ApiauthController@updateUser']);

		Route::get('users/list',					['as' => 'users' , 'uses' => 'Services\ApiauthController@UserList']);
		Route::post('/dataset/import',				['as'=>'import','uses'=>'Services\ImportdatasetController@uploadDataset']);
		Route::get('/dataset/list',					['as'=>'list','uses'=>'Services\DatasetsController@getDatasetsList']);
		Route::get('/dataset/view/{id}/{skip}',			['as'=>'list','uses'=>'Services\DatasetsController@getDatasets']);
		Route::get('/dataset/columns/{id}',			['as'=>'list','uses'=>'Services\DatasetsController@getDatasetsColumnsForSubset']);
		Route::get('/dataset/export/{id}',			['as'=>'dataset.export','uses'=>'Services\ExportDatasetController@export']);
		Route::post('/store/visual',				['as'=>'visualization.store','uses'=>'Services\VisualizationController@store']);
		Route::get('/visual/list',					['as'=>'visualization.list','uses'=>'Services\VisualizationController@visualList']);
		Route::get('/visual/{id}',					['as'=>'visualization.single','uses'=>'Services\VisualizationController@visualByID']);
		Route::get('/dataset/chartdata/{id}',		['as'=>'list','uses'=>'Services\DatasetsController@getFormatedDataset']);
		Route::get('/dataset/define/columns/{id}',['as'=>'validate.columns','uses'=>'Services\ImportdatasetController@getColumns']);
		Route::post('/visual/settings',				['as'=>'store.visual.settings','uses'=>'Services\VisualizationController@storeVisualOptionsAndSettings']);
		Route::post('/dataset/savevalidatecolumns',	['as'=>'validate.columns','uses'=>'Services\DatasetsController@SavevalidateColumns']);
		Route::get('/dataset/delete/{id}',			['as'=>'validate.columns','uses'=>'Services\DatasetsController@deleteDataset']);
		Route::get('/visual/delete/{id}',			['as'=>'validate.columns','uses'=>'Services\VisualizationController@deleteVisual']);
		//User Profile API
		Route::get('/profile',						['as'=>'user.profile','uses'=>'Services\ProfileApiController@getUserProfile']);
		Route::post('/profile/changepass',			['as'=>'change.password','uses'=>'Services\ProfileApiController@changePassword']);
		Route::post('dataset/saveEditedDatset',		['as'=>'dataset.save_edited','uses'=>'Services\DatasetsController@saveEditedDatset']);
		Route::post('dataset/saveSubset',			['as'=>'dataset.save_subset','uses'=>'Services\DatasetsController@saveNewSubset']);
		Route::post('update/profile',				['as'=>'profile.update','uses'=>'Services\ProfileApiController@saveProfile']);
		Route::post('update/profilePic',			['as'=>'profilePic.update','uses'=>'Services\ProfileApiController@profilePicUpdate']);
		Route::get('dataset/validate/columns/{id}', ['as'=>'dataset.column.validate', 'uses'=>'Services\DatasetsController@validateColums']);

	});
});