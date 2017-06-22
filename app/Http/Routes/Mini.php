<?php

/**微信小程序*/

//1.0
Route::group(['prefix'=>"mini",'namespace'=>'Mini'],function(){

    Route::post('login','UserController@getToken');
});

Route::group(['prefix'=>"mini/v1.0",'namespace'=>'Mini'],function(){

    //基本信息
    Route::get('basicinfo/{id}','OrgController@getOrgBasicInfoById');

    //统计信息
    Route::get('statistic/{id}','OrgController@getOrgStatisticInfoById');

    //打卡详情
    Route::get('checkin/{id}/{pageIndex}/{perCounts}','OrgController@getDetailCheckinInfoByOrgId');

    //开团详情
    Route::get('groupbuying/{id}/{pageIndex}/{perCounts}','OrgController@getDetailGroupbuyingInfoByOrgId');
});








