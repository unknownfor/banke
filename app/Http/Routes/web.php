<?php


Route::get('/', 'HomeController@index');

//分享
Route::group(['prefix'=>"share"],function(){
    //机构详情分享
    Route::get('org/{id}', 'ShareController@share_org');
    //课程
    Route::get('course/{id}', 'ShareController@share_course');

    Route::get('rule', 'ShareController@share_rule');

});

//邀请
Route::group(['prefix'=>"invitation"],function(){

    //requestSmsCode
    Route::post('requestSmsCode', 'ShareController@requestSmsCode');

    //Create a test user, you don't need this if you already have.
    Route::post('register','ShareController@register');

    Route::get('/{welcome}', 'ShareController@invitation');
});


//app内页面
Route::group(['prefix'=>"web"],function(){
    //机构详情分享
    Route::get('org/{id}', 'ShareController@org');
    //课程
    Route::get('course/{id}', 'ShareController@course');

    //动态
    Route::get('news/{id}', 'ShareController@news');

    Route::get('privacy', 'ShareController@privacy');

    Route::get('rule', 'ShareController@rule');

    Route::get('download', 'ShareController@download');

});

//半课官网调用
Route::group(['prefix'=>"bankehome"],function(){

    //媒体报道
    Route::get('reports', 'ShareController@getMediaReport');
});

Route::group(['prefix'=>"smstest"],function(){
    Route::get('test1', 'TestController@test1');
    Route::get('test2', 'TestController@test2');
    Route::get('test3', 'TestController@test3');
});







