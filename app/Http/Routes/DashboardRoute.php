<?php
/**
 * 仪表盘路由
 */
$router->group(['prefix' => 'dashboard'], function($router){
	$router->get('gettotaldata', 'DashboardController@gettotaldata');
});

$router->resource('dashboard', 'DashboardController');