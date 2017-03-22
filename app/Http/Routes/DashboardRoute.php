<?php
/**
 * 仪表盘路由
 */
$router->group(['prefix' => 'dashboard'], function($router){
	$router->get('gettotaldata', 'DashboardController@gettotaldata');
	$router->get('getchartdata', 'DashboardController@getchartdata');
});

$router->resource('dashboard', 'DashboardController');