<?php

namespace App\Http\Controllers\Admin;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeOrg;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use OrderRepository;
use PermissionRepository;
use RoleRepository;
use App\Http\Requests\OrderRequest;

use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
	/**
     * 提现列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.order.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = OrderRepository::ajaxIndex();
        return response()->json($data);
    }

    public function check()
    {
        return view('admin.signup.check');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxCheck()
    {
        $data = OrderRepository::ajaxCheck();
        return response()->json($data);
    }

    /**
     * 添加机构视图
     * @author 晚黎
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $orgs = BankeOrg::where('status', 1)->get(['id', 'name']);
        return view('admin.order.create')->with(compact(['orgs']));
    }

    /**
     * 添加机构
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(Requests\OrderRequest $request)
    {
        OrderRepository::store($request);
        return redirect('admin/order');
    }

    /**
     * 修改机构视图
     * @author shaolei
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $order = BankeCashBackUser::find($id);
        $orgs = BankeOrg::where('status', 1)->get(['id', 'name']);
        return view('admin.order.edit')->with(compact(['order','orgs']));
    }
    /**
     * 修改机构资料
     * @author shaolei
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */

    public function update(OrderRequest $request,$id)
    {
        OrderRepository::update($request,$id);
        return redirect('admin/order');

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

        OrderRepository::mark($id,$status);
        return redirect('admin/order');

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

        OrderRepository::destroy($id);
        return redirect('admin/order');

    }

    /**
     * 查看机构信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {

        $org = OrderRepository::show($id);
        return view('admin.order.show')->with(compact('order'));

    }
}
