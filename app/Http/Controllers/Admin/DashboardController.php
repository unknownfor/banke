<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use RoleRepository;
use DashboardRepository;
use OrderRepository;
use EnrolRepository;
use UserRepository;
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

        $seventDaysData=DashboardRepository::getPassSeventDaysData();

        $arr = array(
            array('total'=>$data),
            array('today'=>$data1),
            array('yesterday'=>$data2),
            array('register'=>$seventDaysData[0]),
            array('signin'=>$seventDaysData[1]),
            array('checkin'=>$seventDaysData[2]),
            array('enrol'=>$seventDaysData[3])

        );
        return response()->json($arr);
    }
}
