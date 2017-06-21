<?php

/**微信小程序*/

//1.0
Route::group(['prefix'=>"mini",'namespace'=>'MiniPrograms'],function(){

    Route::post('/login','UserController@getToken');
});

Route::group(['prefix'=>"mini/v1.0",'namespace'=>'MiniPrograms'],function(){

    Route::post('/login','UserController@getToken');
});








