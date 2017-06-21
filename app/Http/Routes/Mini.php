<?php

/**微信小程序*/

//1.0
Route::group(['prefix'=>"mini",'namespace'=>'Mini'],function(){

    Route::post('login','UserController@getToken');
});

Route::group(['prefix'=>"mini/v1.0",'namespace'=>'Mini'],function(){

    Route::get('basicinfo/{oid}','OrgController@getOrgBasicInfoById');
});








