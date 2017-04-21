<?php
/**
 * traincategory路由
 */
$router->group(['prefix' => 'traincategory'], function($router){
	$router->get('ajaxIndex', 'TrainCategoryController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'TrainCategoryController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);

	//根据父级找二级分类
	$router->get('search_by_pid', 'TrainCategoryController@search_by_pid');
});

$router->resource('traincategory', 'TrainCategoryController');