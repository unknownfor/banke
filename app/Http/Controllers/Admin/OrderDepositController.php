<?php

namespace App\Http\Controllers\Admin;
use App\Models\Banke\BankeOrderDeposit;
use App\Models\Banke\BankeOrg;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use OrderDepositRepository;
use PermissionRepository;
use RoleRepository;
use App\Http\Requests\OrderDepositRequest;

use Illuminate\Support\Facades\Log;

class OrderDepositController extends Controller
{
	/**
     * 订金列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.orderdeposit.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = OrderDepositRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 修改视图
     * @author shaolei
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $orderdeposit = OrderDepositRepository::edit($id);
        return view('admin.orderdeposit.edit')->with(compact(['orderdeposit']));
    }
    /**
     * 修改机构资料
     * @author shaolei
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */

    public function update(OrderDepositRequest $request,$id)
    {  
        OrderDepositRepository::update($request,$id);
        return redirect('admin/orderdeposit');

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
     * 查看订单信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $order = OrderRepository::show($id);
        $orgs = BankeOrg::where('status', 1)->get(['id', 'name']);
        return view('admin.order.show')->with(compact(['order','orgs']));

    }

    /**
     * 查看订单信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function search_by_mobile()
    {
        $order = OrderRepository::search_by_mobile();
        return response()->json($order);

    }
}
