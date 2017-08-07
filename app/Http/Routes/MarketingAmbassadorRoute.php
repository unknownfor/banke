<?php
/**
 * 活动路由
 */
$router->group(['prefix' => 'marketingambassador'], function($router){
	$router->get('ajaxIndex', 'MarketingAmbassadorController@ajaxIndex');
	$router->get('sort', 'MarketingAmbassadorController@sort');
	$router->get('/{id}/mark/{status}', 'MarketingAmbassadorController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
	$router->get('/{id}/certificate/{status}', 'MarketingAmbassadorController@certificate')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.certification_status.trash').'|'.
				config('admin.global.certification_status.audit').'|'.
				config('admin.global.certification_status.active')
		]);
});

$router->resource('marketingambassador', 'MarketingAmbassadorController');