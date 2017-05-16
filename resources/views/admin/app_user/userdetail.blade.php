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
            @if($user['certification_status']==2)
                <img src="http://pic.hisihi.com/2017-05-15/1494834465557478.png" id="certificated">
            @endif
            <div class="head-title">
                <i class="iconfont icon-itotal"></i>
                <span>基本信息</span>
            </div>
            <div class="table-box-main">
                <div class="form-group form-md-line-input">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-1 control-label form-control-static" for="name">姓名</label>
                        <div class="col-md-9">
                            <div class="form-control form-control-static"> {{$user['name']}} </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-1 control-label form-control-static">手机号码</label>
                        <div class="col-md-9">
                            <div class="form-control form-control-static"> {{$user['mobile']}} </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-1 control-label form-control-static">学校</label>
                        <div class="col-md-9">
                            <div class="form-control form-control-static"> {{$user['school']}} </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-1 control-label form-control-static">专业</label>
                        <div class="col-md-9">
                            <div class="form-control form-control-static"> {{$user['major']}} </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-1 control-label form-control-static">支付宝号码</label>
                        <div class="col-md-9">
                            <div class="form-control form-control-static"> {{$user['zhifubao_account']}} </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-1 control-label form-control-static">账号余额</label>
                        <div class="col-md-9">
                            <div class="form-control form-control-static"> {{$user['account_balance']}} </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-1 control-label form-control-static">打卡待返余额</label>
                            <div class="col-md-9">
                                <div class="form-control form-control-static"> {{$user['check_in_amount']}} </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>


        <div class="table-box">
                <div class="head-title">
                    <i class="iconfont icon-register"></i>
                    <span>打卡信息</span>
                </div>
            <div class="table-box-main">
                <ol>
                @foreach($course as $v)
                    <li>
                        <div class="form-group form-md-line-input">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-1 control-label form-control-static" for="name">{{$v['name']}}</label>
                                <div class="col-md-9">
                                    <div class="form-control form-control-static"> {{$user['name']}} </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ol>
            </div>
        </div>

@endsection

@section('js')
    <script src="{{asset('backend/js/user/userdetailinfo.js')}}"></script>
@endsection
