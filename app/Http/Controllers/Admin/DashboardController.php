<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use RoleRepository;
use DashboardRepository;
use OrderRepository;
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
        
        $witch_day = -date("w");
        $startTime=date("Y-m-d",strtotime($witch_day));
        $startTime=date("Y-m-d",strtotime($witch_day));


        $data3=UserRepository::getUserInLimitTime("yesterday");
        $data4=OrderboardRepository::getUserInLimitTime("yesterday");
        $data5=CheckinRepository::getUserInLimitTime("yesterday");

        $arr = array(
            array('total'=>$data),
            array('today'=>$data1),
            array('yesterday'=>$data2),
            array('register'=>$data3),
            array('signin'=>$data4),
            array('checkin'=>$data5)

        );
        return response()->json($arr);
    }
}
