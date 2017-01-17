<?php


Route::get('/', 'HomeController@index');

//分享
Route::group(['prefix'=>"share"],function(){
    //机构详情分享
    Route::get('org/{id}', 'ShareController@share_org');
    //课程
    Route::get('course/{org_id}', 'ShareController@share_course');

    Route::get('invitation/{id}', 'ShareController@invitation');
});

//微信
Route::group(['prefix'=>"invitation"],function(){

    //requestSmsCode
    Route::post('requestSmsCode', 'ShareController@requestSmsCode');

    //Create a test user, you don't need this if you already have.
    Route::post('register','ShareController@register');

    Route::get('invitation/{welcome}', 'ShareController@invitation');
});










