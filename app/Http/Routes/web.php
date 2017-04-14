<?php


Route::get('/', 'HomeController@index');



//1.2
Route::group(['prefix'=>"v1.2/share",'namespace'=>'web'],function(){

    //v1.2 以及之后的
    //机构详情分享
    Route::get('/org/{id}', 'OrgController@share_org_v1_2');
    //课程
    Route::get('/course/{id}', 'CourseController@share_course_v1_2');

    //微信注册
    Route::get('/invitation/{welcome}', 'InvitationController@invitation');

    Route::post('/register','InvitationController@register');

});

Route::group(['prefix'=>"v1.2/web",'namespace'=>'web'],function(){

    //v1.2 以及之后的
    //机构详情分享
    Route::get('/org/{id}', 'OrgController@org_v1_2');
    //课程
    Route::get('/course/{id}', 'CourseController@course_v1_2');

});





//邀请
Route::group(['prefix'=>"invitation"],function(){

    //requestSmsCode
    Route::post('requestSmsCode', 'ShareController@requestSmsCode');

    //Create a test user, you don't need this if you already have.
    Route::post('register','ShareController@register');

    Route::post('re','ShareController@re');

    Route::get('/{welcome}', 'ShareController@invitation');
});


//分享
Route::group(['prefix'=>"share"],function(){
    //机构详情分享  v1.1
    Route::get('org/{id}', 'ShareController@share_org');
    //课程 v1.1
    Route::get('course/{id}', 'ShareController@share_course');

    Route::get('rule', 'ShareController@share_rule');

});


//app内页面
Route::group(['prefix'=>"web"],function(){
    //机构详情 v1.1
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

    //精选机构
    Route::get('orgs', 'ShareController@getChoicenessOrgs');

    //机构详情
    Route::get('org/{id}', 'ShareController@getOrgDetail');

    //申请机构
    Route::post('addorgapplyfor', 'ShareController@addOrgApplyFor');

});

Route::group(['prefix'=>"smstest"],function(){
    Route::get('test1', 'TestController@test1');
    Route::get('test2', 'TestController@test2');
    Route::get('test3', 'TestController@test3');
});







