<?php


Route::get('/', 'HomeController@index');


//邀请
Route::group(['prefix'=>"invitation"],function(){

    //requestSmsCode
    Route::post('requestSmsCode', 'ShareController@requestSmsCode');

    //Create a test user, you don't need this if you already have.
    Route::post('register','ShareController@register');


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
Route::group(['prefix'=>"bankehome",'namespace'=>'Web'],function(){

    //媒体报道
    Route::get('reports', 'ReportController@getMediaReport');

    //token
    Route::get('token', 'CommonController@getToken');

    //精选机构
    Route::get('orgs', 'OrgController@getChoicenessOrgs');

    //机构详情
    Route::get('org/{id}', 'OrgController@getOrgDetail');

    //申请机构
    Route::post('addorgapplyfor', 'OrgController@addOrgApplyFor');

    //预约半课
    Route::post('appoint', 'InvitationController@doEnrol_v1_6');
});

//1.2
Route::group(['prefix'=>"v1.2/share",'namespace'=>'Web'],function(){

    //v1.2 以及之后的
    //机构详情分享
    Route::get('/org/{id}', 'OrgController@share_org_v1_2');
    //课程
    Route::get('/course/{id}', 'CourseController@share_course_v1_2');

    //微信注册
    Route::get('/invitation/{welcome}', 'InvitationController@invitation');


    Route::post('/register','InvitationController@register');

    //规则页面
    Route::get('/rule', 'RuleController@share_rule_v1_2');

});

Route::group(['prefix'=>"v1.2/web",'namespace'=>'Web'],function(){

    //v1.2 以及之后的
    //机构详情分享
    Route::get('/org/{id}', 'OrgController@org_v1_2');
    //课程
    Route::get('/course/{id}', 'CourseController@course_v1_2');

    //规则页面
    Route::get('/rule', 'RuleController@rule_v1_2');

});



//1.3
Route::group(['prefix'=>"v1.3/share",'namespace'=>'Web'],function(){

    //微信预约
    Route::get('/enrol/{uid}/{cid}', 'InvitationController@enrol_v1_3');

    Route::post('/doenrol', 'InvitationController@doEnrol_v1_3');


});




//v1.5
Route::group(['prefix'=>"v1.5/share",'namespace'=>'Web'],function(){

    //更新页面浏览次数  type 1:心得分享，  2：机构评论分享  ，3：开团分享      id：记录id
    Route::post('/updateviewcounts', 'CommonController@updateViewCounts_v1_5');

    //课程分享页面
    Route::get('/course/{id}', 'CourseController@share_course_v1_5');

    //机构分享页面
    Route::get('/org/{id}', 'OrgController@share_org_v1_5');

    //机构评论分享页面
    Route::get('/commentorg/{course_id}/{uid}/{comment_id}', 'OrgController@share_comment_org_v1_5');

    //开团分享、心得分享页面 (预约页面) type 1:心得分享，  2：机构评论分享  ，3：开团分享      id：记录id
    Route::get('/enrol/{uid}/{cid}/{typeid}/{id}', 'InvitationController@enrol_v1_5');

    //规则页面
    Route::get('/rule', 'RuleController@share_rule_v1_5');


});

//1.5
Route::group(['prefix'=>"v1.5/web",'namespace'=>'Web'],function() {

    //v1.5课程
    Route::get('/course/{id}', 'CourseController@course_v1_5');

    //机构入驻申请
    Route::get('/orgapplyfor', 'OrgController@org_applyfor_v1_5');

    //规则页面
    Route::get('/rule', 'RuleController@rule_v1_5');

});




//1.6
Route::group(['prefix'=>"v1.6/web",'namespace'=>'Web'],function() {

    //v1.6课程开团
    Route::get('/course/{id}', 'CourseController@course_v1_6');

    //机构页面
    Route::get('/org/{id}', 'OrgController@org_v1_6');


});


//v1.6
Route::group(['prefix'=>"v1.6/share",'namespace'=>'Web'],function(){

    //机构宣传页面
    Route::get('/orgpublicity/{id}', 'OrgController@org_publicity_v1_6');

    Route::post('/doenrol', 'InvitationController@doEnrol_v1_6');

    //课程分享页面
    Route::get('/course/{id}', 'CourseController@share_course_v1_6');

    //机构分享页面
    Route::get('/org/{id}', 'OrgController@share_org_v1_6');

    //开团分享、心得分享页面 (预约页面)
    Route::get('/enrol/{uid}/{cid}/{typeid}/{id}', 'InvitationController@enrol_v1_6');

});



//--------------------------------- 1.7 -----------------------------------

//1.7
Route::group(['prefix'=>"v1.7/web",'namespace'=>'Web'],function() {

    //课程详情
    Route::get('/course/{id}/{uid}', 'CourseController@course_v1_7');

    //赚钱攻略文章
    Route::get('/moneystrategy/{id}', 'MoneyStrategyController@money_strategy_v1_7');

    //规则页面
    Route::get('/rule', 'RuleController@rule_v1_7');

});


//v1.7
Route::group(['prefix'=>"v1.7/share",'namespace'=>'Web'],function(){

    //课程详情分享页
    Route::get('/course/{id}','CourseController@share_course_v1_6');

    //赚钱攻略文章
    Route::get('/moneystrategy/{id}', 'MoneyStrategyController@share_money_strategy_v1_7');

    //招生老师邀请注册
    Route::get('/inviteteacher/{welcome}','InvitationController@inviteteacher_v1_7');

    //规则页面
    Route::get('/rule', 'RuleController@share_rule_v1_7');
});

//--------------------------------- 1.8 -----------------------------------

//1.8
Route::group(['prefix'=>"v1.8/web",'namespace'=>'Web'],function() {

    //机构分享页面
    Route::get('/org/{id}', 'OrgController@org_v1_8');

    //课程详情
    Route::get('/course/{id}', 'CourseController@course_v1_8');

    //教学老师
    Route::get('/teachingteacher/{id}', 'TeachingTeacherController@teachingteacher_v1_8');

    //分期详情分享
    Route::get('/installment/{id}', 'InstallmentController@installment_v1_8');

    //分期详情分享
    Route::get('/installment_oid/{id}', 'InstallmentController@installment_oid_v1_8');

    //退款详情分享
    Route::get('/refund/{id}', 'RefundController@refund_v1_8');

    //退款详情分享
    Route::get('/refund_oid/{id}', 'RefundController@refund_oid_v1_8');

    //活动详情分享
    Route::get('/activity/{id}', 'ActivityController@v1_8');

    //免费学详情分享
    Route::get('/freestudy/{id}', 'FreeStudyController@v1_8');

    //课程图片详情
    Route::get('/courseimgdetails/{id}', 'CourseController@imgdetails_course_v1_8');

    //机构特色
    Route::get('/orgfeature/{id}', 'OrgController@org_feature_v1_8');

    Route::get('/marketingambassadorintro', 'MarketingAmbassadorController@introduce_v1_8');

//    //赚钱攻略文章
//    Route::get('/moneystrategy/{id}/{record_id}/{uid}/{form_user_detail_id}', 'ArticleController@moneystrategy_share_v1_9');
//
//    //免费学文章
//    Route::get('/freestudy/{id}/{record_id}/{uid}/{form_user_detail_id}', 'ArticleController@freestudy_share_v1_9');

});

//v1.8分享
Route::group(['prefix'=>"v1.8/share",'namespace'=>'Web'],function(){

    //课程详情分享页
    Route::get('/course/{id}','CourseController@share_course_v1_8');

    //机构详情分享
    Route::get('/org/{id}', 'OrgController@share_org_v1_8');

    //活动详情分享
    Route::get('/activity/{id}', 'ActivityController@share_v1_8');

    //免费学详情分享
    Route::get('/freestudy/{id}', 'FreeStudyController@share_v1_8');

    Route::get('/ambassadordownload/{uid}', 'MarketingAmbassadorController@download_v1_8');

    //申请免费学
    Route::post('/freestudysignup','FreeStudyController@signup');
});

//--------------------------------- 1.9 -----------------------------------

//1.9
Route::group(['prefix'=>"v1.9/web",'namespace'=>'Web'],function() {
    //新版本活动详情说明
    Route::get('/newtaskrule', 'NewTaskController@rule_v1_9');

    //赚钱攻略文章
    Route::get('/moneystrategy/{id}/{record_id}/{uid}/{form_user_detail_id}', 'ArticleController@moneystrategy_share_v1_9');

    //免费学文章
    Route::get('/freestudy/{id}/{record_id}/{uid}/{form_user_detail_id}', 'ArticleController@freestudy_share_v1_9');
});


//v1.9分享
Route::group(['prefix'=>"v1.9/share",'namespace'=>'Web'],function(){

    //课程心得详情分享页
    Route::get('/commentcourse/{id}/{form_user_detail_id}','CommentCourseController@share_v1_9');

    //机构心得详情分享
    Route::get('/commentorg/{id}/{form_user_detail_id}', 'CommentOrgController@share_v1_9');

    //红包详情分享
    Route::get('/redpacket/{welcome}', 'RedPacketController@share_v1_9');

    //课程详情分享页
    Route::get('/course/{id}','CourseController@share_course_v1_9');

    //赚钱攻略文章
    Route::get('/moneystrategy/{id}/{record_id}/{uid}/{form_user_detail_id}', 'ArticleController@moneystrategy_share_v1_9');

    //免费学文章
    Route::get('/freestudy/{id}/{record_id}/{uid}/{form_user_detail_id}', 'ArticleController@freestudy_share_v1_9');

    //更新页面浏览次数  type 1:心得分享，  2：机构评论分享  ，3：开团分享      id：记录id
    Route::post('/updateviewcounts', 'CommonController@updateViewCounts_v1_9');


});









