<?php
/**
 * 教育分类
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use TrainCategoryRepository;
use App\Http\Requests\TrainCategoryRequest;

class TrainCategoryController extends Controller {

    /**
     * 教育分类 列表
     */
    public function index()
    {
        return view("admin.traincategory.list");
    }

    /**
     * datatable 获取教育分类 列表
     * @author shaolei
     * @date   2016-12-26T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = TrainCategoryRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 添加教育分类
     * @author shaolei
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $categories = TrainCategoryRepository::getAllTopCategory();
        return view('admin.traincategory.create')->with(compact(['categories']));
    }

    /**
     * 添加教育分类
     * @author shaolei
     * @date   2016-04-13T11:26:35+0800
     * @param  DictRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(TrainCategoryRequest $request)
    {
        TrainCategoryRepository::store($request);
        return redirect('admin/traincategory');
    }

    /**
     * 修改教育分类
     * @author shaolei
     * @date   2016-04-13T11:26:42+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $traincategory = TrainCategoryRepository::edit($id);
        $categories = TrainCategoryRepository::getAllTopCategory();
        return view('admin.traincategory.edit')->with(compact(['traincategory','categories']));
    }
    /**
     * 修改教育分类
     * @author shaolei
     * @date   2016-04-13T11:26:57+0800
     * @param  DictRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(TrainCategoryRequest $request,$id)
    {
        TrainCategoryRepository::update($request,$id);
        return redirect('admin/traincategory');
    }

    /**
     * 修改教育分类状态
     * @author shaolei
     * @date   2016-04-13T11:27:23+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        TrainCategoryRepository::mark($id,$status);
        return redirect('admin/traincategory');
    }

    /**
     * 删除教育分类
     * @author shaolei
     * @date   2016-04-13T11:27:34+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        TrainCategoryRepository::destroy($id);
        return redirect('admin/traincategory');
    }

    /**
     * 根据一级获得全部二级分类
     * @author shaolei
     * @date   2016-04-13T11:27:34+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function search_by_pid()
    {
        $data = TrainCategoryRepository::getAllSecondCategoryByPid();
        return response()->json($data);
    }
}