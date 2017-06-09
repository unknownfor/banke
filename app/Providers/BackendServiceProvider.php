<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use MenuRepository;
use Auth;
class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view) {
            //共享菜单数据
            $menus = MenuRepository::index();
            $view->with('menus',$menus);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('UserRepository', function($app){
            return new \App\Repositories\admin\UserRepository();
        });

        $this->app->singleton('PermissionRepository', function($app){
            return new \App\Repositories\admin\PermissionRepository();
        });
        $this->app->singleton('RoleRepository', function($app){
            return new \App\Repositories\admin\RoleRepository();
        });
        $this->app->singleton('MenuRepository', function($app){
            return new \App\Repositories\admin\MenuRepository();
        });
        //图片
        $this->app->singleton('ImageRepository', function($app){
            return new \App\Repositories\admin\ImageRepository();
        });
        //配置
        $this->app->singleton('DictRepository', function($app){
            return new \App\Repositories\admin\DictRepository();
        });
        //机构
        $this->app->singleton('OrgRepository', function($app){
            return new \App\Repositories\admin\OrgRepository();
        });

        //机构总表
        $this->app->singleton('OrgSummaryRepository', function($app){
            return new \App\Repositories\admin\OrgSummaryRepository();
        });
        //课程
        $this->app->singleton('CourseRepository', function($app){
            return new \App\Repositories\admin\CourseRepository();
        });

        $this->app->singleton('AppUserRepository', function($app){
            return new \App\Repositories\admin\AppUserRepository();
        });
        //动态
        $this->app->singleton('NewsRepository', function($app){
            return new \App\Repositories\admin\NewsRepository();
        });

        //预约报名
        $this->app->singleton('EnrolRepository', function($app){
            return new \App\Repositories\admin\EnrolRepository();
        });

        //提现
        $this->app->singleton('CashRepository', function($app){
            return new \App\Repositories\admin\CashRepository();
        });

        //报名
        $this->app->singleton('OrderRepository', function($app){
            return new \App\Repositories\admin\OrderRepository();
        });

        //反馈
        $this->app->singleton('FeedbackRepository', function($app){
            return new \App\Repositories\admin\FeedbackRepository();
        });

        //邀请列表
        $this->app->singleton('InvitationRepository', function($app){
            return new \App\Repositories\admin\InvitationRepository();
        });

        //常见问题列表
        $this->app->singleton('FaqRepository', function($app){
            return new \App\Repositories\admin\FaqRepository();
        });

        //签到列表
        $this->app->singleton('CheckinRepository', function($app){
            return new \App\Repositories\admin\CheckinRepository();
        });

        //提现列表
        $this->app->singleton('WithdrawRepository', function($app){
            return new \App\Repositories\admin\WithdrawRepository();
        });

        //版本列表
        $this->app->singleton('AppUpdateRepository', function($app){
            return new \App\Repositories\admin\AppUpdateRepository();
        });

        //仪表盘
        $this->app->singleton('DashboardRepository', function($app){
            return new \App\Repositories\admin\DashboardRepository();
        });

        //媒体报道
        $this->app->singleton('ReportRepository', function($app){
            return new \App\Repositories\admin\ReportRepository();
        });

        //机构申请
        $this->app->singleton('OrgApplyForRepository', function($app){
            return new \App\Repositories\admin\OrgApplyForRepository();
        });

        //机构返款
        $this->app->singleton('OrgRebatesRepository', function($app){
            return new \App\Repositories\admin\OrgRebatesRepository();
        });

        //学生退款
        $this->app->singleton('DrawbackRepository', function($app){
            return new \App\Repositories\admin\DrawbackRepository();
        });

        //banner
        $this->app->singleton('BannerRepository', function($app){
            return new \App\Repositories\admin\BannerRepository();
        });

        //教育分类
        $this->app->singleton('TrainCategoryRepository', function($app){
            return new \App\Repositories\admin\TrainCategoryRepository();
        });

        //机构评论分类
        $this->app->singleton('CommentOrgRepository', function($app){
            return new \App\Repositories\admin\CommentOrgRepository();
        });

        //课程评论分类
        $this->app->singleton('CommentCourseRepository', function($app){
            return new \App\Repositories\admin\CommentCourseRepository();
        });

        //开团分享
        $this->app->singleton('GroupbuyingRepository', function($app){
            return new \App\Repositories\admin\GroupbuyingRepository();
        });

        //开团语
        $this->app->singleton('GroupbuyingWordsRepository', function($app){
            return new \App\Repositories\admin\GroupbuyingWordsRepository();
        });
    }
}
