<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use FaqRepository;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    /**
     * 删除用户
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        FaqRepository::destroy($id);
        return redirect('admin/faq');
    }

    /**
     * 查看所有的统计信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function gettotaldata()
    {
        Log::info('-------------------------show faq---------------');
        $data = CourseRepository::getTotalData();
        return response()->json($data);
    }
}
