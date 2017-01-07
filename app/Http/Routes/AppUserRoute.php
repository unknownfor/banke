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
	//认证申请
	$router->get('certification','AppUserController@certification');
	$router->get('ajaxCertification', 'AppUserController@ajaxCertification');
	$router->get('/{id}/certificate/{status}', 'AppUserController@certificate')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.certification_status.trash').'|'.
				config('admin.global.certification_status.audit').'|'.
				config('admin.global.certification_status.active')
		]);

	$router->post('reset','AppUserController@resetPassword');

	//管理员修改信息
	$router->get('/change/{id}','AppUserController@changeAdminInfo')->where(['id' => '[0-9]+']);
	//管理员信息修改
	$router->post('/post_info','AppUserController@postAdminInfo');
});

$router->resource('app_user', 'AppUserController');