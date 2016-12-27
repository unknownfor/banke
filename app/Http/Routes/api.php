<?php


Route::get('/',function(){
//	return redirect(url('api/docs'));
	return redirect(url('admin'));
});

Route::group(['prefix'=>"v1",'namespace'=>'Api'],function(){
    Route::post('/pay','WechatController@wechatPay');
    Route::get('/','WechatController@wechatPay');
    Route::any('/test','WechatController@test');
});

