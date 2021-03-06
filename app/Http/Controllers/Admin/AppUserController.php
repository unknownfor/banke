<?php

namespace App\Http\Controllers\Admin;
use App\Models\Banke\BankeOrg;
use App\Repositories\admin\WithdrawRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use AppUserRepository;
use PermissionRepository;
use RoleRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateOrgUserNewRequest;
use App\Http\Requests\CreateOrgUserOldRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Banke\BankeBalanceLogs;


class AppUserController extends Controller
{
	/**
     * 用户列表
     * @author shaolei
     * @date   2016-04-13T21:12:18+0800
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.app_user.list');
    }

    /**
     * 用户详情信息
     * @author shaolei
     * @date   2016-04-13T21:12:18+0800
     * @return [type]                   [description]
     */
    public function alldetailinfo($id=0)
    {
        $user=AppUserRepository::getUserAllDetailInfo($id);
        return view('admin.app_user.userdetail')->with(compact(['user']));
    }

    /**
     * 用户金额明细信息
     * @author shaolei
     * @date   2016-04-13T21:12:18+0800
     * @return [type]                   [description]
     */
    public function balancelogs($uid=0)
    {
        return view('admin.app_user.balancelogsdetail')->with(compact(['uid']));
    }

    public function ajaxBalancelogsData()
    {
        $uid=request('uid','');
        $data = AppUserRepository::ajaxUserBalanceLogs($uid);
        $withDrawData=WithdrawRepository::getWithdrawByUid($uid)->toJSON();
        $balance=AppUserRepository::getUserBalanceInfo($uid);
        return Array('balanceLogs'=>$data,'withDrawData'=>$withDrawData,'balance'=>$balance);
    }

    /**
     * datatable 获取数据
     * @author shaolei
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = AppUserRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 认证申请用户列表
     * @author shaolei
     * @date   2016-04-13T21:12:18+0800
     * @return [type]                   [description]
     */
    public function certification()
    {
        return view('admin.app_user.certification');
    }

    /**
     * datatable 获取认证申请数据
     * @author shaolei
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxCertification()
    {
        $data = AppUserRepository::ajaxCertification();
        return response()->json($data);
    }

    /**
     * 修改用户身份认证状态
     * @author shaolei
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function certificate($id,$status)
    {
        AppUserRepository::certificate($id,$status);
        return redirect('admin/app_user/certification');
    }

    /**
     * 修改用户状态
     * @author 晚黎
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        UserRepository::mark($id,$status);
        return redirect('admin/user');
    }

    /**
     * 删除用户
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        UserRepository::destroy($id);
        return redirect('admin/user');
    }
    /**
     * 查看用户信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        /*$user = UserRepository::show($id);
        return view('admin.user.show')->with(compact('user'));*/
    }

    /**
     * 机构用户列表
     * @author shaolei
     * @date   2016-04-13T21:12:18+0800
     * @return [type]                   [description]
     */
    public function org_account()
    {
        return view('admin.app_user.org_account');
    }

    /**
     * datatable 获取机构账户数据
     * @author shaolei
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxOrgAccount()
    {
        $data = AppUserRepository::ajaxOrgAccount();
        return response()->json($data);
    }

    /**
     * 修改机构用户状态
     * @author shaolei
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark_org_account($id,$status)
    {
        AppUserRepository::certificate($id,$status);
        return redirect('admin/app_user/mark_org_account');
    }

    /**
     * 添加机构用户视图
     * @author shaolei
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create_org_account()
    {
        $orgs = BankeOrg::where('status', 1)->get();
        return view('admin.app_user.create_org_account')->with(compact(['orgs']));
    }

    /**
     * 添加机构用户
     * @author shaolei
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store_org_account_new(CreateOrgUserNewRequest $request)
    {
        AppUserRepository::store_org_account_new($request);
        return redirect('admin/app_user/org_account');
    }

    /**
     * 添加机构用户，从已有的app账号变迁得来
     * @author shaolei
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store_org_account_old(CreateOrgUserOldRequest $request)
    {
        AppUserRepository::store_org_account_old($request);
        return redirect('admin/app_user/org_account');
    }



}
