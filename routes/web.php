<?php



Route::group(['middleware'=>['auth']], function(){

	// permisson
	Route::get('/permisson/create',['as'=>'permisson.create', 'uses'=>'PermissonController@create']);
	Route::post('/permisson/store', ['as'=>'permisson.store', 'uses'=>'PermissonController@store']);
	Route::get('/permisson', ['as'=>'permisson.list', 'uses'=>'PermissonController@index']);
	Route::get('/list_permisson', ['as'=>'permisson.list_role.ajax', 'uses'=>'PermissonController@list_permisson']);
	Route::get('/permisson/edit/{id}',['as'=>'permisson.edit', 'uses'=>'PermissonController@edit']);
	Route::patch('/permisson/update/{id}', ['as'=>'permisson.update', 'uses'=>'PermissonController@update']);
	Route::get('/permisson/delete/{id}', ['as'=>'permisson.delete', 'uses'=>'PermissonController@destroy']);

	//Role for user
	Route::get('/role/create',['as'=>'role.create', 'uses'=>'RoleController@create']);
	Route::post('/role/store', ['as'=>'role.store', 'uses'=>'RoleController@store']);
	Route::get('/roles', ['as'=>'role.list', 'uses'=>'RoleController@index']);
	Route::get('/list_roles', ['as'=>'role.list_role.ajax', 'uses'=>'RoleController@list_role']);
	Route::get('/role/edit/{id}',['as'=>'role.edit', 'uses'=>'RoleController@edit']);
	Route::patch('/role/update/{id}', ['as'=>'role.update', 'uses'=>'RoleController@update']);
	Route::get('/role/delete/{id}', ['as'=>'role.delete', 'uses'=>'RoleController@destroy']);

	//Role permisson Setting  'middleware' => 'roles',
	Route::get('/setting/create',['as'=>'setting.create', 'uses'=>'SettingController@create']);
	Route::post('/setting/store', ['as'=>'setting.store', 'uses'=>'SettingController@store']);
	Route::get('/setting', ['as'=>'setting.list', 'uses'=>'SettingController@index']);
	Route::get('/list_setting', ['as'=>'setting.list_setting', 'uses'=>'SettingController@list_setting']);
	Route::get('/setting/view/{id}', ['as'=>'setting.view', 'uses'=>'SettingController@view']);
	Route::get('/setting/edit/{id}',['as'=>'setting.edit', 'uses'=>'SettingController@edit']);
	Route::post('/setting/update', ['as'=>'setting.update', 'uses'=>'SettingController@update']);

	// ROLE SYSTEM
	//Route::group(['middleware'=>['roles']], function(){

		Route::get('/', ['as'=>'home', 'uses'=>'DashboardController@index']);

		/*Routes of Department Operations*/
		Route::get('/departments',['as'=>'department.list', 'uses'=>'DepartmentController@index']);
		Route::get('/departments/create',['as'=>'department.create', 'uses'=>'DepartmentController@create']);
		Route::post('/department/store',['as'=>'department.store', 'uses'=>'DepartmentController@store']);
		Route::get('/department/delete/{id}',['middleware'=>'roles','as'=>'department.delete', 'uses'=>'DepartmentController@destroy']);
		Route::get('/list_depart',['as'=>'department.ajax', 'uses'=>'DepartmentController@get_departments']);
		Route::get('/department/edit/{id}',['middleware'=>'roles','as'=>'department.edit', 'uses'=>'DepartmentController@edit']);
		Route::patch('/department/update/{id}',['as'=>'department.update', 'uses'=>'DepartmentController@update']);

		/*Routes of Designations Operations*/
		Route::get('/designations',['middleware'=>'roles','as'=>'designations.list', 'uses'=>'DesignationController@index']);
		Route::get('/list_desig',['as'=>'designation.ajax', 'uses'=>'DesignationController@indexData']);
		Route::get('/designations/create',['middleware'=>'roles','as'=>'designations.create', 'uses'=>'DesignationController@create']);
		Route::post('/designations/store',['as'=>'designations.store', 'uses'=>'DesignationController@store']);
		Route::get('/designations/delete/{id}',['middleware'=>'roles','as'=>'designations.delete', 'uses'=>'DesignationController@destroy']);
		Route::get('/designations/edit/{id}',['middleware'=>'roles','as'=>'designations.edit', 'uses'=>'DesignationController@edit']);
		Route::patch('/designations/update/{id}',['as'=>'designations.update', 'uses'=>'DesignationController@update']);

		/*Routes for ministries operations*/
		Route::get('/ministries',['as'=>'ministries.list','uses'=>'MinistriesController@index']);
		Route::get('/list_minist',['as'=>'ministries.ajax', 'uses'=>'MinistriesController@get_ministries']);
		Route::get('/ministries/create',['as'=>'ministries.create', 'uses'=>'MinistriesController@create']);
		Route::post('/ministries/store',['as'=>'ministries.store', 'uses'=>'MinistriesController@store']);
		Route::get('/ministries/delete/{id}',['as'=>'ministries.delete', 'uses'=>'MinistriesController@destroy']);
		Route::get('/ministries/edit/{id}',['as'=>'ministries.edit', 'uses'=>'MinistriesController@edit']);
		Route::patch('/ministries/update/{id}',['as'=>'ministries.update', 'uses'=>'MinistriesController@update']);

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
		Route::get('user_detail/{id}',['as'=>'api.user_detail', 'uses'=>'ApiusersController@userDetail']);


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
		Route::get('/pages',['as'=>'pages.list','uses'=>'PagesController@index']);
		Route::get('/pages_list',['as'=>'pages.list.ajax','uses'=>'PagesController@indexData']);
		Route::get('/pages/create',['as'=>'pages.create','uses'=>'PagesController@create']);
		Route::post('/pages/store',['as'=>'pages.store','uses'=>'PagesController@store']);
		Route::get('/pages/delete/{id}',['as'=>'pages.delete', 'uses'=>'PagesController@destroy']);
		Route::get('/pages/edit/{id}',['as'=>'pages.edit', 'uses'=>'PagesController@edit']);
		Route::patch('/pages/update/{id}',['as'=>'pages.update', 'uses'=>'PagesController@update']);

		/*Routes For indicators resources*/
		Route::get('/visualisation',['as'=>'visualisation.list','uses'=>'VisualisationController@index']);
		Route::get('/visualisation_list',['as'=>'visualisation.list.ajax','uses'=>'VisualisationController@indexData']);
		Route::get('/visualisation/create',['as'=>'visualisation.create','uses'=>'VisualisationController@create']);
		Route::post('/visualisation/store',['as'=>'visualisation.store','uses'=>'VisualisationController@store']);
		Route::get('/visualisation/delete/{id}',['as'=>'visualisation.delete', 'uses'=>'VisualisationController@destroy']);
		Route::get('/visualisation/edit/{id}',['as'=>'visualisation.edit', 'uses'=>'VisualisationController@edit']);
		Route::patch('/visualisation/update/{id}',['as'=>'visualisation.update', 'uses'=>'VisualisationController@update']);

		/*Routes For datasets resources*/
		Route::get('/dataset',['as'=>'datasets.list','uses'=>'DataSetsController@index']);
		Route::get('/dataset_list',['as'=>'datasets.list.ajax','uses'=>'DataSetsController@indexData']);
		Route::get('/dataset/create',['as'=>'dataset.create','uses'=>'DataSetsController@create']);
		Route::post('/dataset/store',['as'=>'dataset.store','uses'=>'DataSetsController@store']);
		Route::get('/dataset/delete/{id}',['as'=>'datasets.delete', 'uses'=>'DataSetsController@destroy']);
		Route::get('/dataset/edit/{id}',['as'=>'datasets.edit', 'uses'=>'DataSetsController@edit']);
		Route::patch('/dataset/update/{id}',['as'=>'datasets.update', 'uses'=>'DataSetsController@update']);

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
	//});



});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
