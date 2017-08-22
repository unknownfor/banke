<?php
/**
* 活动控制器
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use MarketingAmbassadorRepository;
use App\Models\Banke\BankeCourse;
use Illuminate\Http\Request;
use App\Http\Requests\MarketingAmbassadorRequest;
use BusinessCityRepository;
use Flash;

class MarketingAmbassadorController extends Controller {


    /**
     * 列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.marketingambassador.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data =MarketingAmbassadorRepository::ajaxIndex();
        return response()->json($data);
    }


    /**
     * 修改活动视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $marketingambassador =MarketingAmbassadorRepository::edit($id);
        return view('admin.marketingambassador.edit')->with(compact(['marketingambassador']));
    }
    /**
     * 修改活动资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(MarketingambassadorRequest $request,$id)
    {
        MarketingAmbassadorRepository::update($request,$id);
        $this->updateJoinInCourse($id,$request);
        return redirect('admin/marketingambassador');
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
        MarketingAmbassadorRepository::destroy($id);
        return redirect('admin/marketingambassador');
    }

    /**
     * 修改认证状态
     * @author shaolei
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function certificate($id,$status)
    {
        MarketingAmbassadorRepository::certificate($id,$status);
        return redirect('admin/marketingambassador');
    }
}
