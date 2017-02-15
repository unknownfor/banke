<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use RoleRepository;
use DashboardRepository;
use PermissionRepository;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * 查看所有的统计信息
     * @author jimmmy
     * @date   2017-02-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function getTotalData()
    {
        $data = DashboardRepository::getTotalData();
        $data1=DashboardRepository::getRecentlyData("today");
        $data2=DashboardRepository::getRecentlyData("yesterday");

        $arr = array(
            array('total'=>$data),
            array('today'=>$data1),
            array('yesterday'=>$data2)
        );
        return response()->json($arr);
    }
}
