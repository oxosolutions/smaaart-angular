<?php




	Route::get('/viewemail',function(){
		return view('mail.layout.email',
		['username' => 'sgssandhu'],
		['user_name' => 'SGS Sandhu']
		); 
	});

	

	Route::get('/correctCsv',['as'=>'datasets.list','uses'=>'DataSetsController@correctCsv']);


	Route::get ('/export/dataset/{id}',['as'=>'export.dataset', 'uses'=>'DataSetsController@apiExportDataset']);

	Route::get('checkLog',['as' => 'log' , 'uses' => 'LogsystemController@CheckForLog']);

	Route::group(['middleware'=>['auth','approve']], function(){
		Route::get('/view_log',['as'=>'log.view','uses'=>'LogsystemController@viewLog']);	
		Route::get('/search_log',['as'=>'log.search','uses'=>'LogsystemController@search_log']);	

	});

	Route::group(['middleware'=>['auth','approve','log']], function(){

		Route::get('maps',['as'=>'map.list' , 'uses'=>'MapController@index' ]);
		Route::get('mapData',['as'=>'map.data' , 'uses'=>'MapController@indexData' ]);
		Route::get('map/edit/{id}',['as'=>'map.edit' , 'uses'=>'MapController@edit' ]);
		Route::post('/map/update/{id}',['as'=>'map.update' , 'uses'=>'MapController@update' ]);
		Route::get('/map/enable/{id}',['as'=>'map.enable' , 'uses'=>'MapController@statusEnable' ]);
		Route::get('/map/disable/{id}',['as'=>'map.disable' , 'uses'=>'MapController@statusDisable' ]);


		Route::get('map/create',['as'=>'map.create' , 'uses'=>'MapController@create' ]);
		Route::post('map/save',['as'=>'map.save' , 'uses'=>'MapController@save' ]);

		Route::get('/fact_create',['as'=>'fact.create','uses'=>'FactController@create' ,'route_name'=>  'Create Facts']);
		Route::post('/fact_store',['as'=>'fact.store','uses'=>'FactController@store' ,'route_name'=>'Save Fact']);
		Route::get('/facts',['as'=>'fact.list','uses'=>'FactController@index', 'route_name'=>  'View Fact List']);
		Route::get('/fact_data',['as'=>'fact.indexdata','uses'=>'FactController@indexData' ]);
		Route::get('/fact/edit/{id}',['as'=>'fact.edit','uses'=>'FactController@edit' ,'route_name'=>  'Edit Fact']);
		Route::post('/fact/update/{id}',['as'=>'fact.update','uses'=>'FactController@update','route_name'=>  'Update Fact ']);

		Route::get('/fact/delete/{id}',['as'=>'fact.delete','uses'=>'FactController@delete','route_name'=>  'Delete Fact']);

		//dashboard
		Route::get('/', ['as'=>'home', 'uses'=>'DashboardController@index' ,'route_name'=>  'View Dashboard']);
	//Api user
	Route::get('/api_users/del_all', ['as'=>'user.del', 'uses'=>'ApiusersController@delAllUser' ,'route_name'=>  'Delete User']);

		Route::get('/api_users', ['as'=>'api.users', 'uses'=>'ApiusersController@index']);
		Route::get('/api_users/create', ['as'=>'api.create_users', 'uses'=>'ApiusersController@create']);
		Route::get('/api_users/edit/{id}', ['as'=>'api.edit_users', 'uses'=>'ApiusersController@edit']);
		Route::post('/api_users/update/{id}', ['as'=>'apiuser.update', 'uses'=>'ApiusersController@update']);
		Route::get('/api_users/approved/{id}', ['as'=>'apiuser.approved', 'uses'=>'ApiusersController@approved']);
		Route::get('/api_users/unapproved/{id}', ['as'=>'apiuser.unapproved', 'uses'=>'ApiusersController@unapproved']);
		Route::get('/api_users/editmeta/{id}', ['as'=>'apiuser.editmeta', 'uses'=>'ApiusersController@editmeta']);
		Route::post('/api_users/updatemeta/{id}', ['as'=>'apiuser.updatemeta', 'uses'=>'ApiusersController@updatemeta']);
		Route::get('/api_users/delete/{id}', ['as'=>'apiuser.delete', 'uses'=>'ApiusersController@delete']);


	//Pages
		
		Route::get('/pages/deleteall',['middleware'=>'log','as'=>'pages.del','uses'=>'PagesController@delAllPages']);

		Route::get('/pages',['middleware'=>'log','as'=>'pages.list','uses'=>'PagesController@index']);
		Route::get('/pages/create',['middleware'=>'log','as'=>'pages.create','uses'=>'PagesController@create']);
		Route::get('/pages/delete/{id}',['middleware'=>'log','as'=>'pages.delete', 'uses'=>'PagesController@destroy']);
	//Designation
		Route::get('/designations',['as'=>'designations.list', 'uses'=>'DesignationController@index']);
		Route::get('/designations/create',['as'=>'designations.create', 'uses'=>'DesignationController@create']);
		Route::get('/designations/delete/{id}',['as'=>'designations.delete', 'uses'=>'DesignationController@destroy']);
	//Dataset
		Route::get('/export/{type}/table/{table}',['as'=>'export.data' , 'uses'=>'DataSetsController@exportTable']);
		Route::get('/dataset',['as'=>'datasets.list','uses'=>'DataSetsController@index']);
		Route::get('/dataset/create',['as'=>'dataset.create','uses'=>'DataSetsController@create']);
		Route::get('/dataset/delete/{id}',['as'=>'datasets.delete', 'uses'=>'DataSetsController@destroy']);
	//Ministrie
		Route::get('/ministries',['as'=>'ministries.list','uses'=>'MinistriesController@index']);
		Route::get('/ministries/create',['as'=>'ministries.create', 'uses'=>'MinistriesController@create']);
		Route::get('/ministries/delete/{id}',['as'=>'ministries.delete', 'uses'=>'MinistriesController@destroy']);
	//Department
		Route::get('/departments',['as'=>'department.list', 'uses'=>'DepartmentController@index']);
		Route::get('/departments/create',['as'=>'department.create', 'uses'=>'DepartmentController@create']);
		Route::get('/department/delete/{id}',['as'=>'department.delete', 'uses'=>'DepartmentController@destroy']);
	//Goals
		Route::get('/goals',['as'=>'goals.list','uses'=>'GoalsController@index']);
		Route::get('/goals/create',['as'=>'goals.create','uses'=>'GoalsController@create']);
		Route::get('/goals/delete/{id}',['as'=>'goals.delete', 'uses'=>'GoalsController@destroy']);
		Route::get('goals/deleteall',['as' => 'delMulGoals' , 'uses' => 'GoalsController@delMulGoals']);
	//Scheme
		Route::get('/schema',['as'=>'schema.list','uses'=>'GoalsSchemaController@index']);
		Route::get('/schema/create',['as'=>'schema.create','uses'=>'GoalsSchemaController@create']);
		Route::get('/schema/delete/{id}',['as'=>'schema.delete', 'uses'=>'GoalsSchemaController@destroy']);
	//Indicator
		Route::get('/indicators',['as'=>'indicators.list','uses'=>'IndicatorsController@index']);
		Route::get('/indicators/create',['as'=>'indicators.create','uses'=>'IndicatorsController@create']);
		Route::get('/indicators/delete/{id}',['as'=>'indicators.delete', 'uses'=>'IndicatorsController@destroy']);
	//Target
		Route::get('/target',['as'=>'target.list','uses'=>'GoalsTargetController@index']);
		Route::get('/target/create',['as'=>'target.create','uses'=>'GoalsTargetController@create']);
		Route::get('/target/delete/{id}',['as'=>'target.delete', 'uses'=>'GoalsTargetController@destroy']);
	//Intervention
		Route::get('/intervention',['as'=>'intervention.list','uses'=>'GoalsInterventionController@index']);
		Route::get('/intervention/create',['as'=>'intervention.create','uses'=>'GoalsInterventionController@create']);
		Route::get('/intervention/delete/{id}',['as'=>'intervention.delete', 'uses'=>'GoalsInterventionController@destroy']);
	//role
		Route::get('/roles', ['as'=>'role.list', 'uses'=>'RoleController@index']);
		Route::get('/role/create',['as'=>'role.create', 'uses'=>'RoleController@create']);
		Route::get('/role/delete/{id}', ['as'=>'role.delete', 'uses'=>'RoleController@destroy']);
	//Permisson
		Route::get('/permisson/create',['as'=>'permisson.create', 'uses'=>'PermissionController@create']);
		Route::get('/permisson', ['as'=>'permisson.list', 'uses'=>'PermissionController@index']);
		Route::get('/permisson/delete/{id}', ['as'=>'permisson.delete', 'uses'=>'PermissionController@destroy']);
	//visualisation
		Route::get('/visualisation',['as'=>'visualisation.list','uses'=>'VisualisationController@index']);
		Route::get('/visualisation/create',['as'=>'visualisation.create','uses'=>'VisualisationController@create']);
		Route::get('/visualisation/delete/{id}',['as'=>'visualisation.delete', 'uses'=>'VisualisationController@destroy']);

	/*API Config Routes*/
		Route::get('/config',['as'=>'api.config','uses'=>'ApiConfigController@index']);

	// permisson
		Route::get('/permisson/delete_route/{id}', ['as'=>'permisson.delete_route', 'uses'=>'PermissionController@delete_permisson_route']);

		Route::post('/permisson/store', ['as'=>'permisson.store', 'uses'=>'PermissionController@store']);
		Route::get('/list_permisson', ['as'=>'permisson.list_role.ajax', 'uses'=>'PermissionController@list_permisson']);
		Route::get('/permisson/edit/{id}',['as'=>'permisson.edit', 'uses'=>'PermissionController@edit']);
		Route::patch('/permisson/update/{id}', ['as'=>'permisson.update', 'uses'=>'PermissionController@update']);

	//Role for user
		Route::post('/role/store', ['as'=>'role.store', 'uses'=>'RoleController@store']);
		Route::get('/list_roles', ['as'=>'role.list_role.ajax', 'uses'=>'RoleController@list_role']);
		Route::get('/role/edit/{id}',['as'=>'role.edit', 'uses'=>'RoleController@edit']);
		Route::patch('/role/update/{id}', ['as'=>'role.update', 'uses'=>'RoleController@update']);

	//Role permisson Setting  'middleware' => 'roles',
		Route::get('/setting/create',['as'=>'setting.create', 'uses'=>'SettingController@create']);
		Route::post('/setting/store', ['as'=>'setting.store', 'uses'=>'SettingController@store']);
		Route::get('/setting', ['as'=>'setting.list', 'uses'=>'SettingController@index']);
		Route::get('/list_setting', ['as'=>'setting.list_setting', 'uses'=>'SettingController@list_setting']);
		Route::get('/setting/view/{id}', ['as'=>'setting.view', 'uses'=>'SettingController@view']);
		Route::get('/setting/edit/{id}',['as'=>'setting.edit', 'uses'=>'SettingController@edit']);
		Route::post('/setting/update', ['as'=>'setting.update', 'uses'=>'SettingController@update']);


	/*Routes of Department Operations*/
		Route::post('/department/store',['as'=>'department.store', 'uses'=>'DepartmentController@store']);
		Route::get('/list_depart',['as'=>'department.ajax', 'uses'=>'DepartmentController@get_departments']);
		Route::get('/department/edit/{id}',['as'=>'department.edit', 'uses'=>'DepartmentController@edit']);
		Route::patch('/department/update/{id}',['as'=>'department.update', 'uses'=>'DepartmentController@update']);

	/*Routes of Designations Operations*/
		Route::get('/list_desig',['as'=>'designation.ajax', 'uses'=>'DesignationController@indexData']);
		Route::post('/designations/store',['as'=>'designations.store', 'uses'=>'DesignationController@store']);
		Route::get('/designations/edit/{id}',['as'=>'designations.edit', 'uses'=>'DesignationController@edit']);
		Route::patch('/designations/update/{id}',['as'=>'designations.update', 'uses'=>'DesignationController@update']);

	/*Routes for ministries operations*/
		Route::get('/list_minist',['as'=>'ministries.ajax', 'uses'=>'MinistriesController@get_ministries']);
		Route::post('/ministries/store',['as'=>'ministries.store', 'uses'=>'MinistriesController@store']);
		Route::get('/ministries/edit/{id}',['as'=>'ministries.edit', 'uses'=>'MinistriesController@edit']);
		Route::patch('/ministries/update/{id}',['as'=>'ministries.update', 'uses'=>'MinistriesController@update']);

	/*Routes for goals operations*/
		Route::get('/list_goals',['as'=>'goals.list.ajax','uses'=>'GoalsController@goalsList']);
		Route::post('/goals/store',['as'=>'goals.store','uses'=>'GoalsController@store']);
		Route::get('/goals/edit/{id}',['as'=>'goals.edit', 'uses'=>'GoalsController@edit']);
		Route::patch('/goals/update/{id}',['as'=>'goals.update', 'uses'=>'GoalsController@update']);

	/*Routes of API users*/
		Route::get('/get_users', ['as'=>'api.get_users', 'uses'=>'ApiusersController@get_users']);
		Route::post('/api_users/store', ['as'=>'api.store_users', 'uses'=>'ApiusersController@store']);
		Route::get('/api_users_meta/create/{id}', ['as'=>'api.create_users_meta', 'uses'=>'ApiusersController@createUserMeta']);
		Route::post('/api_users_meta/store', ['as'=>'api.store_users_meta', 'uses'=>'ApiusersController@storeUserMeta']);
		Route::get('user_detail/{id}',['as'=>'api.user_detail', 'uses'=>'ApiusersController@userDetail']);
		Route::get('editUserDetails/{id}',['as'=>'api.editUserDetails', 'uses'=>'ApiusersController@editUserDetails']);
		Route::POST('/updateProfile', ['as' => 'updateProfile' , 'uses' => 'ApiusersController@updateProfile']);


	/*Routes For API goal schema*/
		Route::get('/schema_list',['as'=>'schema.list.ajax','uses'=>'GoalsSchemaController@indexData']);
		Route::post('/schema/store',['as'=>'schema.store','uses'=>'GoalsSchemaController@store']);
		Route::get('/schema/edit/{id}',['as'=>'schema.edit', 'uses'=>'GoalsSchemaController@edit']);
		Route::patch('/schema/update/{id}',['as'=>'schema.update', 'uses'=>'GoalsSchemaController@update']);

	/*Routes For goal Targets*/
		Route::get('/target_list',['as'=>'target.list.ajax','uses'=>'GoalsTargetController@indexData']);
		Route::post('/target/store',['as'=>'target.store','uses'=>'GoalsTargetController@store']);
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
		Route::get('/indicators_list',['as'=>'indicators.list.ajax','uses'=>'IndicatorsController@indexData']);
		Route::post('/indicators/store',['as'=>'indicators.store','uses'=>'IndicatorsController@store']);
		Route::get('/indicators/edit/{id}',['as'=>'indicators.edit', 'uses'=>'IndicatorsController@edit']);
		Route::patch('/indicators/update/{id}',['as'=>'indicators.update', 'uses'=>'IndicatorsController@update']);

	/*Routes For indicators resources*/
		Route::get('/pages_list',['middleware'=>'log','as'=>'pages.list.ajax','uses'=>'PagesController@indexData']);
		Route::post('/pages/store',['middleware'=>'log','as'=>'pages.store','uses'=>'PagesController@store']);
		Route::get('/pages/edit/{id}',['middleware'=>'log','as'=>'pages.edit', 'uses'=>'PagesController@edit']);
		Route::patch('/pages/update/{id}',['middleware'=>'log','as'=>'pages.update', 'uses'=>'PagesController@update']);

	/*Routes For indicators resources*/
		Route::get('/visualisation_list',['as'=>'visualisation.list.ajax','uses'=>'VisualisationController@indexData']);
		Route::post('/visualisation/store',['as'=>'visualisation.store','uses'=>'VisualisationController@store']);
		Route::get('/visualisation/edit/{id}',['as'=>'visualisation.edit', 'uses'=>'VisualisationController@edit']);
		Route::patch('/visualisation/update/{id}',['as'=>'visualisation.update', 'uses'=>'VisualisationController@update']);

	/*Routes For datasets resources*/
		Route::get('/dataset_list',['as'=>'datasets.list.ajax','uses'=>'DataSetsController@indexData']);
		Route::post('/dataset/store',['as'=>'dataset.store','uses'=>'DataSetsController@store']);
		Route::get('/dataset/edit/{id}',['as'=>'datasets.edit', 'uses'=>'DataSetsController@edit']);
		Route::patch('/dataset/update/{id}',['as'=>'datasets.update', 'uses'=>'DataSetsController@update']);

	/*Routes For API goal intervention*/
		Route::get('/intervention_list',['as'=>'intervention.list.ajax','uses'=>'GoalsInterventionController@indexData']);
		Route::post('/intervention/store',['as'=>'intervention.store','uses'=>'GoalsInterventionController@store']);
		Route::get('/intervention/edit/{id}',['as'=>'intervention.edit', 'uses'=>'GoalsInterventionController@edit']);
		Route::patch('/intervention/update/{id}',['as'=>'intervention.update', 'uses'=>'GoalsInterventionController@update']);

	//Global Settings
		Route::get('/settings',['as'=>'global.settings','uses'=>'GlobalSettingsController@index']);
		Route::patch('/settings/store/register',['as'=>'register.settings','uses'=>'GlobalSettingsController@saveNewUserRegisterSettings']);
		Route::patch('/settings/store/forget',['as'=>'forget.settings','uses'=>'GlobalSettingsController@saveForgetEmailSettings']);
		Route::patch('/settings/store/adminreg',['as'=>'adminreg.settings','uses'=>'GlobalSettingsController@saveAdminRegEmailSettings']);
		Route::patch('/settings/store/userapprove',['as'=>'aprroveuser.settings','uses'=>'GlobalSettingsController@saveApproveUserSettings']);
		Route::patch('/settings/store/datasetNumRow',['as'=>'dataset.settings','uses'=>'GlobalSettingsController@datasetNumRowSetting']);
		Route::patch('/settings/store/sitevalue',['as'=>'sitevalue.settings','uses'=>'GlobalSettingsController@siteValue']);

	//Create Visual
		Route::get('/visual', ['as'=>'list.visual','uses'=>'VisualController@index']);
		Route::get('/visual/create', ['as'=>'create.visual','uses'=>'VisualController@create']);
		Route::get('/dataset/columns/{id}/{type?}/{chart?}', ['as'=>'dataset.columns','uses'=>'VisualController@getDatasetColumns']);
		Route::post('/visual/savecolumns',['as'=>'save.dataset.columns','uses'=>'VisualController@saveVisualColumns']);
		Route::get('/getVisual',['as'=>'visual.ajax','uses'=>'VisualController@getData']);
		Route::get('/delete/visual/{id}',['as'=>'visual.delete','uses'=>'VisualController@deleteVisual']);
		Route::get('/visual/edit/{id}',['as'=>'visual.edit','uses'=>'VisualController@edit']);
		Route::patch('/visual/update/{id}',['as'=>'visual.update','uses'=>'VisualController@update']);

	//Generated Visuals Queries
		Route::get('/visual/queries',['as'=>'visual.queries','uses'=>'VisualQueryController@index']);
		Route::get('/getQueries',['as'=>'query.ajax','uses'=>'VisualQueryController@getQueryList']);
		Route::get('/visual/query/create/{id?}',['as'=>'visual.query.create','uses'=>'VisualQueryController@create']);
		Route::post('/visual/query/getColValue',['as'=>'visual.query.ajax','uses'=>'VisualQueryController@getColData']);
		Route::post('/visual/query/store',['as'=>'store.visual.query','uses'=>'VisualQueryController@store']);
	});

Auth::routes();
Route::group(['middleware'=>['log']], function(){
		Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

});

Route::get('/approve/{from?}/{api_token?}', ['as'=>'approve','uses'=>'ApiusersController@approveUser']);
