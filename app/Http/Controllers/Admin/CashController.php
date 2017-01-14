<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use UpdateCashRequest;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use CashRepository;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;

class CashController extends Controller
{
	/**
     * 提现列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.cash.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = CashRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 修改机构视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $cash = CashRepository::edit($id);
        return view('admin.cash.edit')->with(compact('cash'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(UpdateCashRequest $request,$id)
    {
        CashRepository::update($request,$id);
        return redirect('admin/cash');
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
        CashRepository::destroy($id);
        return redirect('admin/cash');
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
        $cash = CashRepository::show($id);
        return view('admin.cash.show')->with(compact('cash'));
    }
}
