<?php
/**
 * 用户路由
 */
$router->group(['prefix' => 'app_user'], function($router){
	$router->get('ajaxIndex', 'AppUserController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'AppUserController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
	$router->get('/{id}/reset','AppUserController@changePassword')->where(['id' => '[0-9]+']);
	$router->post('reset','AppUserController@resetPassword');

	//管理员修改信息
	$router->get('/change/{id}','AppUserController@changeAdminInfo')->where(['id' => '[0-9]+']);
	//管理员信息修改
	$router->post('/post_info','AppUserController@postAdminInfo');
});

$router->resource('user', 'AppUserController');