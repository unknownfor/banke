<?php


Route::get('/', 'HomeController@index');

//微信
Route::group(['prefix'=>"share"],function(){
    //机构详情分享
    Route::get('org/{id}', 'ShareController@share_org');
    //课程
    Route::get('course/{org_id}', 'ShareController@share_course');
});










