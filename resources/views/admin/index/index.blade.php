@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/dashboard/fonticon/iconfont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/dashboard/dashboard.css')}}">
@endsection

@section('content')
<input type="hidden" name="_method" value="PATCH">
<form role="form" class="form-horizontal order-info-box" method="POST" action="{{url('admin/order')}}">
    {!! csrf_field() !!}>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('admin')}}">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>控制台</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->

<div>
    <div class="table-box">
        <div class="head-title">
            <i class="iconfont icon-itotal"></i>
            <span>基本概括</span>
        </div>
        <div class="table-main">
            <div class="total-box">
                <div>
                    <div>总用户数</div>
                    <div class="total-val">****</div>
                </div>
                <div>
                    <div>总预约人数</div>
                    <div class="total-val">***</div>
                </div>
                <div>
                    <div>总报名人数</div>
                    <div class="total-val">**</div>
                </div>
                <div>
                    <div>总打卡次数</div>
                    <div class="total-val">*</div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-box">
        <div class="head-title">
            <i class="iconfont icon-register"></i>
            <span>今日数据</span>
        </div>
        <div class="table-main">
            <table class="table table-striped table-hover table-checkable dataTable no-footer">
                <thead>
                    <th class="col-md-2"></th>
                    <th class="col-md-2">新增注册人数</th>
                    <th class="col-md-2">预约人数</th>
                    <th class="col-md-2">报名人数</th>
                    <th class="col-md-2">打卡人数</th>
                </thead>
                <tbody>
                    <tr class="today-tr">
                        <td>今日</td>
                        <td>****</td>
                        <td>***</td>
                        <td>**</td>
                        <td>*</td>
                    </tr>
                    <tr class="yesterday-tr">
                        <td>昨日</td>
                        <td>****</td>
                        <td>***</td>
                        <td>**</td>
                        <td>*</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="echart-box">
        <div class="table-box echart-main-box">
            <div class="head-title">
            <i class="iconfont icon-data"></i>
            <span>注册人数</span>
        </div>
            <div class="table-main">
                <div id="main-register" class="echart-main-content"></div>
            </div>
        </div>
        <div class="table-box echart-main-box">
                <div class="head-title">
                    <i class="iconfont icon-data"></i>
                    <span>报名人数</span>
                </div>
                <div class="table-main">
                    <div id="main-signin" class="echart-main-content"></div>
                </div>
            </div>
        <div class="table-box echart-main-box">
            <div class="head-title">
                <i class="iconfont icon-data"></i>
                <span>打卡人数</span>
            </div>
            <div class="table-main">
                <div id="main-clock" class="echart-main-content"></div>
            </div>
        </div>
        <div class="table-box echart-main-box">
            <div class="head-title">
                <i class="iconfont icon-data"></i>
                <span>徦的数据</span>
            </div>
            <div class="table-main">
                <div id="main" class="echart-main-content"></div>
            </div>
        </div>
    </div>

    {{--<div class="echart-box">--}}
        {{--<div class="table-box echart-main-box">--}}
            {{--<div class="head-title">--}}
                {{--<i class="iconfont icon-data"></i>--}}
                {{--<span>打卡人数</span>--}}
            {{--</div>--}}
            {{--<div class="table-main">--}}
                {{--<div id="main-clock" class="echart-main-content"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="table-box echart-main-box">--}}
            {{--<div class="head-title">--}}
                {{--<i class="iconfont icon-data"></i>--}}
                {{--<span>徦的数据</span>--}}
            {{--</div>--}}
            {{--<div class="table-main">--}}
                {{--<div id="main" class="echart-main-content"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


</div>
</form>

@endsection

@section('js')
<script src="{{asset('backend/plugins/echarts/echarts.min.js')}}"></script>
<script src="{{asset('backend/js/dashboard/index.js')}}"></script>
@endsection

