<?php
/**
 * 机构评论路由
 */
$router->group(['prefix' => 'commentcourse'], function($router){
	$router->get('ajaxIndex', 'CommentCourseController@ajaxIndex');
	$router->get('sort', 'CommentCourseController@sort');
	$router->get('/{id}/mark/{status}', 'CommentCourseController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
});

$router->resource('commentcourse', 'CommentCourseController');