<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use AppUserRepository;
use PermissionRepository;
use RoleRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\postAdminPasswordRequest;
use App\Http\Requests\postAdminInfoRequest;

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
        UserRepository::certificate($id,$status);
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
        $user = UserRepository::show($id);
        return view('admin.user.show')->with(compact('user'));
    }
    /**
     * 修改用户密码视图
     * @author 晚黎
     * @date   2016-04-14T11:57:42+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function changePassword($id)
    {
        return view('admin.user.reset')->with(compact('id'));
    }

    /**
     * 修改用户密码
     * @author 晚黎
     * @date   2016-04-14T11:58:13+0800
     * @return [type]                   [description]
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        UserRepository::resetPassword($request);
        return redirect('admin/user');
    }

    /**
     * 登录用户修改密码页面
     */
    public function profile($id) {

        return view('admin.user.profile')->with(compact('id'));
    }

    /**
     * 管理员资料修改
     */
    public function changeAdminInfo($id)
    {
        return view('admin.user.admin_info')->with(compact('id'));
    }

    /**
     * 修改管理员密码
     */
    public function postAdminPassword(postAdminPasswordRequest $request)
    {
        $id = $request->get('id');
        UserRepository::resetPassword($request);

        return redirect('admin/user/profile/'.$id);
    }

    /**
     * 修改管理员信息
     */
    public function postAdminInfo(postAdminInfoRequest $request)
    {
        $id = $request->get('id');
        UserRepository::changeAdminInfoById($request);
        return redirect('admin/user/change/'.$id);
    }


}
