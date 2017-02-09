<?php
/**
 * 网站功能设置
 */
namespace App\Http\Controllers\Admin;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeCourse;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use EnrolRepository;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\Log;

class EnrolController extends Controller {

    /**
     * 配置列表
     */
    public function index()
    {
        return view("admin.enrol.list");
    }

    /**
     * datatable 获取数据
     * @author shaolei
     * @date   2016-12-26T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = EnrolRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 添加视图
     * @author shaolei
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        return view('admin.enrol.create');
    }

    /**
     * 添加配置
     * @author shaolei
     * @date   2016-04-13T11:26:35+0800
     * @param  DictRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(NewsRequest $request)
    {
        EnrolRepository::store($request);
        return redirect('admin/enrol');
    }

    /**
     * 修改配置视图
     * @author shaolei
     * @date   2016-04-13T11:26:42+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $enrol = EnrolRepository::edit($id);
        $org = new BankeOrg;
        $orgs = $org->where('status', 1)->orderBy('sort', 'desc')->get(['id', 'name']);
        $course = new BankeCourse;
        $courseInfo = $course::find($enrol['course_id']);
        return view('admin.enrol.edit')->with(compact(['enrol','courseInfo','orgs']));
    }
    /**
     * 修改配置
     * @author shaolei
     * @date   2016-04-13T11:26:57+0800
     * @param  DictRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(NewsRequest $request,$id)
    {
        EnrolRepository::update($request,$id);
        return redirect('admin/enrol');
    }

    /**
     * 修改配置状态
     * @author shaolei
     * @date   2016-04-13T11:27:23+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        EnrolRepository::mark($id,$status);
        return redirect('admin/enrol');
    }

    /**
     * 删除配置
     * @author shaolei
     * @date   2016-04-13T11:27:34+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        EnrolRepository::destroy($id);
        return redirect('admin/enrol');
    }
}