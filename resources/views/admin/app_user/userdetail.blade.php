@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/userdetail/fonticon/iconfont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/userdetail/userdetail.css')}}">
@endsection

@section('content')
        {!! csrf_field() !!}>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('admin')}}">首页</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>用户详情</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->

        <div class="table-box">
            <div class="head-title">
                <i class="iconfont icon-itotal"></i>
                <span>基本信息</span>
            </div>
            <form role="form" class="form-horizontal">
                <div class="form-group form-md-line-input">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="name">姓名</label>
                            <div class="col-md-9">
                                <div class="form-control form-control-static"> {{$user['name']}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="name">手机号码</label>
                            <div class="col-md-9">
                                <div class="form-control form-control-static"> {{$user['mobile']}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="name">学校</label>
                            <div class="col-md-9">
                                <div class="form-control form-control-static"> {{$user['school']}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="name">专业</label>
                            <div class="col-md-9">
                                <div class="form-control form-control-static"> {{$user['major']}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="name">支付宝号码</label>
                            <div class="col-md-9">
                                <div class="form-control form-control-static"> {{$user['zhifubao_account']}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="name">账号余额</label>
                            <div class="col-md-9">
                                <div class="form-control form-control-static"> {{$user['account_balance']}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label" for="name">待返余额</label>
                            <div class="col-md-9">
                                <div class="form-control form-control-static"> {{$user['zhifubao']}} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="table-box">
                <div class="head-title">
                    <i class="iconfont icon-register"></i>
                    <span>打卡信息</span>
                </div>
                <div class="table-main">
                    <table class="table table-striped table-hover table-checkable dataTable no-footer">
                        <thead>
                        <th class="col-md-1"></th>
                        <th class="col-md-1">新增注册人数</th>
                        <th class="col-md-1">认证人数</th>
                        <th class="col-md-1">预约人数</th>
                        <th class="col-md-1">报名人数</th>
                        <th class="col-md-1">打卡次数</th>
                        <th class="col-md-1">提现次数</th>
                        </thead>
                        <tbody>
                        <tr class="today-tr">
                            <td>今日</td>
                            <td>******</td>
                            <td>*****</td>
                            <td>****</td>
                            <td>***</td>
                            <td>**</td>
                            <td>*</td>
                        </tr>
                        <tr class="yesterday-tr">
                            <td>昨日</td>
                            <td>******</td>
                            <td>*****</td>
                            <td>****</td>
                            <td>***</td>
                            <td>**</td>
                            <td>*</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

@endsection

@section('js')
    <script src="{{asset('backend/js/user/userdetailinfo.js')}}"></script>
@endsection
