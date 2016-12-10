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
	Route::get('/department/edit/{id}',['as'=>'department.edit', 'uses'=>'DepartmentController@edit']);
	Route::patch('/department/update/{id}',['as'=>'department.update', 'uses'=>'DepartmentController@update']);

	/*Routes of Designations Operations*/
	Route::get('/designations',['as'=>'designations.list', 'uses'=>'DesignationController@index']);
	Route::get('/list_desig',['as'=>'designation.ajax', 'uses'=>'DesignationController@indexData']);
	Route::get('/designations/create',['as'=>'designations.create', 'uses'=>'DesignationController@create']);
	Route::post('/designations/store',['as'=>'designations.store', 'uses'=>'DesignationController@store']);
	Route::get('/designations/delete/{id}',['as'=>'designations.delete', 'uses'=>'DesignationController@destroy']);
	Route::get('/designations/edit/{id}',['as'=>'designations.edit', 'uses'=>'DesignationController@edit']);
	Route::patch('/designations/update/{id}',['as'=>'designations.update', 'uses'=>'DesignationController@update']);

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
	Route::get('/api_users_meta/create', ['as'=>'api.create_users_meta', 'uses'=>'ApiusersController@createUserMeta']);
	
	Route::post('/api_users_meta/store', ['as'=>'api.store_users_meta', 'uses'=>'ApiusersController@storeUserMeta']);


	/*Routes For API goal schema*/
	Route::get('/schema',['as'=>'schema.list','uses'=>'GoalsSchemaController@index']);
	Route::get('/schema_list',['as'=>'schema.list.ajax','uses'=>'GoalsSchemaController@indexData']);
	Route::get('/schema/create',['as'=>'schema.create','uses'=>'GoalsSchemaController@create']);
	Route::post('/schema/store',['as'=>'schema.store','uses'=>'GoalsSchemaController@store']);
	Route::get('/schema/delete/{id}',['as'=>'schema.delete', 'uses'=>'GoalsSchemaController@destroy']);
	Route::get('/schema/edit/{id}',['as'=>'schema.edit', 'uses'=>'GoalsSchemaController@edit']);
	Route::patch('/schema/update/{id}',['as'=>'schema.update', 'uses'=>'GoalsSchemaController@update']);

	/*Routes For goal Targets*/
	Route::get('/target',['as'=>'target.list','uses'=>'GoalsTargetController@index']);
	Route::get('/target_list',['as'=>'target.list.ajax','uses'=>'GoalsTargetController@indexData']);
	Route::get('/target/create',['as'=>'target.create','uses'=>'GoalsTargetController@create']);
	Route::post('/target/store',['as'=>'target.store','uses'=>'GoalsTargetController@store']);
	Route::get('/target/delete/{id}',['as'=>'target.delete', 'uses'=>'GoalsTargetController@destroy']);
	Route::get('/target/edit/{id}',['as'=>'target.edit', 'uses'=>'GoalsTargetController@edit']);
	Route::patch('/target/update/{id}',['as'=>'target.update', 'uses'=>'GoalsTargetController@update']);

	/*Routes For goal resources*/
	Route::get('/resource',['as'=>'resource.list','uses'=>'GoalsResourceController@index']);
	Route::get('/resource_list',['as'=>'resource.list.ajax','uses'=>'GoalsResourceController@indexData']);
	Route::get('/resource/create',['as'=>'resource.create','uses'=>'GoalsResourceController@create']);
	Route::post('/resource/store',['as'=>'resource.store','uses'=>'GoalsResourceController@store']);
	Route::get('/resource/delete/{id}',['as'=>'resource.delete', 'uses'=>'GoalsResourceController@destroy']);
	Route::get('/resource/edit/{id}',['as'=>'resource.edit', 'uses'=>'GoalsResourceController@edit']);
	Route::patch('/resource/update/{id}',['as'=>'resource.update', 'uses'=>'GoalsResourceController@update']);

	/*Routes For indicators resources*/
	Route::get('/indicators',['as'=>'indicators.list','uses'=>'IndicatorsController@index']);
	Route::get('/indicators_list',['as'=>'indicators.list.ajax','uses'=>'IndicatorsController@indexData']);
	Route::get('/indicators/create',['as'=>'indicators.create','uses'=>'IndicatorsController@create']);
	Route::post('/indicators/store',['as'=>'indicators.store','uses'=>'IndicatorsController@store']);
	Route::get('/indicators/delete/{id}',['as'=>'indicators.delete', 'uses'=>'IndicatorsController@destroy']);
	Route::get('/indicators/edit/{id}',['as'=>'indicators.edit', 'uses'=>'IndicatorsController@edit']);
	Route::patch('/indicators/update/{id}',['as'=>'indicators.update', 'uses'=>'IndicatorsController@update']);

	/*Routes For indicators resources*/
	Route::get('/visualisation',['as'=>'visualisation.list','uses'=>'VisualisationController@index']);
	Route::get('/visualisation_list',['as'=>'visualisation.list.ajax','uses'=>'VisualisationController@indexData']);
	Route::get('/visualisation/create',['as'=>'visualisation.create','uses'=>'VisualisationController@create']);
	Route::post('/visualisation/store',['as'=>'visualisation.store','uses'=>'VisualisationController@store']);
	Route::get('/visualisation/delete/{id}',['as'=>'visualisation.delete', 'uses'=>'VisualisationController@destroy']);
	Route::get('/visualisation/edit/{id}',['as'=>'visualisation.edit', 'uses'=>'VisualisationController@edit']);
	Route::patch('/visualisation/update/{id}',['as'=>'visualisation.update', 'uses'=>'VisualisationController@update']);
	
	/*Routes For API goal intervention*/
	Route::get('/intervention',['as'=>'intervention.list','uses'=>'GoalsInterventionController@index']);
	Route::get('/intervention_list',['as'=>'intervention.list.ajax','uses'=>'GoalsInterventionController@indexData']);
	Route::get('/intervention/create',['as'=>'intervention.create','uses'=>'GoalsInterventionController@create']);
	Route::post('/intervention/store',['as'=>'intervention.store','uses'=>'GoalsInterventionController@store']);
	Route::get('/intervention/edit/{id}',['as'=>'intervention.edit', 'uses'=>'GoalsInterventionController@edit']);
	Route::patch('/intervention/update/{id}',['as'=>'intervention.update', 'uses'=>'GoalsInterventionController@update']);
	Route::get('/intervention/delete/{id}',['as'=>'intervention.delete', 'uses'=>'GoalsInterventionController@destroy']);

	/*API Config Routes*/
	Route::get('/config',['as'=>'api.config','uses'=>'ApiConfigController@index']);


});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');