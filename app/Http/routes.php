<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
  
//后台路由
Route::group(['domain'=>env('ADMIN_DOMAIN'),'middleware' => ['web']],function(){
    Route::auth();
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin','middleware' => ['auth']], function ($router) {

        $router->get('/', 'IndexController@index');
        $router->get('/i18n', 'IndexController@dataTableI18n');

        /*用户*/
        require(__DIR__ . '/Routes/UserRoute.php');
        //权限
        require(__DIR__ . '/Routes/PermissionRoute.php');
        /*菜单*/
        require(__DIR__ . '/Routes/MenuRoute.php');
        // 角色
        require(__DIR__ . '/Routes/RoleRoute.php');
        // 机构
        require(__DIR__ . '/Routes/OrgRoute.php');

        // 机构
        require(__DIR__ . '/Routes/OrgSummaryRoute.php');

        // 课程
        require(__DIR__ . '/Routes/CourseRoute.php');
        //图片
        $router->get('/image/show', 'ImageController@showImageUpload');
        $router->post('/image/upload_image', 'ImageController@postImageUpload');
        $router->get('/image/select', 'ImageController@showImageSelect');
        $router->get('/image/lib', 'ImageController@showImageLib');
        $router->get('/image/image_list', 'ImageController@showImageList');
        $router->post('/image/destroy/{id}', 'ImageController@destroy');
        

        //操作日志
        $router->get('/actionlog', 'ActionLogController@actionList');
        $router->get('/action/ajax', 'ActionLogController@ajaxIndex');

        //锁屏
        $router->get('/lock','IndexController@lockScreen');
        $router->post('/unlock','IndexController@unlock');

        //设置
        $router->get('/setting/switch','SettingController@webSwitch');
        $router->get('/setting/email','SettingController@emailTemple');

        //文章
        $router->resource('article','ArticleController');

        //文章分类
        $router->resource('ae_category','ArticleCategoryController');

        //app配置
        require(__DIR__ . '/Routes/DictRoute.php');
        //app用户
        require(__DIR__ . '/Routes/AppUserRoute.php');
        //app动态
        require(__DIR__ . '/Routes/NewsRoute.php');
        //预约报名
        require(__DIR__ . '/Routes/EnrolRoute.php');
        //签到记录
        require(__DIR__ . '/Routes/CheckinRoute.php');
         //邀请记录
        require(__DIR__ . '/Routes/InvitationRoute.php');
        //报名记录
        require(__DIR__ . '/Routes/OrderRoute.php');

        //订金记录
        require(__DIR__ . '/Routes/OrderDepositRoute.php');

        //反馈记录
        require(__DIR__ . '/Routes/FeedbackRoute.php');

        //常见问题记录
        require(__DIR__ . '/Routes/FaqRoute.php');

        //提现记录
        require(__DIR__ . '/Routes/WithdrawRoute.php');

        //app升级
        require(__DIR__ . '/Routes/AppUpdateRoute.php');

        //仪表盘信息
        require(__DIR__ . '/Routes/DashboardRoute.php');

        //媒体报道信息
        require(__DIR__ . '/Routes/ReportRoute.php');

        //机构申请入驻
        require(__DIR__ . '/Routes/OrgApplyForRoute.php');

        //机构返款
        require(__DIR__ . '/Routes/OrgRebatesRoute.php');

        //学生退款
        require(__DIR__ . '/Routes/DrawbackRoute.php');

        //banner轮播图
        require(__DIR__ . '/Routes/BannerRoute.php');

        //教育分类
        require(__DIR__ . '/Routes/TrainCategoryRoute.php');

        //机构评论
        require(__DIR__ . '/Routes/CommentOrgRoute.php');

         //课程评论
        require(__DIR__ . '/Routes/CommentCourseRoute.php');

        //分享开团
        require(__DIR__ . '/Routes/GroupbuyingRoute.php');

        //开团标语
        require(__DIR__ . '/Routes/GroupbuyingWordsRoute.php');

        //招生老师
        require(__DIR__ . '/Routes/RecruiteTeacherRoute.php');

    });
});

//前台路由 包括小程序路由
Route::group(['domain'=>env('FRONT_DOMAIN'),'middleware' => ['web','bankehome','mini'] ],function($router){

    require(__DIR__ . '/Routes/web.php');

    require(__DIR__ . '/Routes/Mini.php');
});
