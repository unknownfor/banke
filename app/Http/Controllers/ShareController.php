<?php

namespace App\Http\Controllers;


class ShareController extends Controller
{

    /**
     * 分享机构详情
     */
    public function share_org($id){

        return view('web.org.share_org');
    }

    /**
     * 分享课程详情
     */
    public function share_course($org_id){

        return view('web.org.share_course');
    }
}
