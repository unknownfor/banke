@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/balancelogsdetail/fonticon/iconfont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/balancelogsdetail/detail.css')}}">
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

        <div id="balancelog-detail" data-uid="{{$uid}}">
            <div class="table-box">
                <div class="head-title">
                    <i class="iconfont icon-itotal"></i>
                    <span>基本概括</span>
                </div>
                <div class="table-main">
                    <div class="total-box">
                        <div>
                            <div>当前提现</div>
                            <div class="total-val" id="amount-doing">****</div>
                        </div>
                        <div>
                            <div>已完成提现</div>
                            <div class="total-val" id="amount-finished">***</div>
                        </div>
                        <div>
                            <div>已拒绝提现</div>
                            <div class="total-val" id="amount-refuced">***</div>
                        </div>
                        <div>
                            <div>当前账号余额（不包括当前提现金额）</div>
                            <div class="total-val" id="balance">**</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="echart-box">
                <div class="table-box-col">
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-data"></i>
                            <span>打卡</span>
                            <div class="header-total">总和：￥<span id="sum-checkin"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-checkin"> </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-data"></i>
                            <span>分享开团</span>
                            <div class="header-total">总和：￥<span id="sum-groupbuying"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-groupbuying"></tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="table-box-col">
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-chart-icon"></i>
                            <span>机构评论</span>
                            <div class="header-total">总和：￥<span id="sum-comment-org"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-comment-org"> </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-data"></i>
                            <span>心得</span>
                            <div class="header-total">总和：￥<span id="sum-comment-course"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-comment-course"> </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="table-box-col">
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-data"></i>
                            <span>认证</span>
                            <div class="header-total">总和：￥<span id="sum-cetification"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-cetification"> </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-data"></i>
                            <span>好友认证</span>
                            <div class="header-total">总和：￥<span id="sum-invite-cerfitication"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-invite-cerfitication"></tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="table-box-col">
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-data"></i>
                            <span>分享好文章</span>
                            <div class="header-total">总和：￥<span id="sum-share"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-share"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-data"></i>
                            <span>好友报名</span>
                            <div class="header-total">总和：￥<span id="sum-invite-signin"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-invite-signin"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-box-col">

                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-chart-icon"></i>
                            <span>App好评</span>
                            <div class="header-total">总和：￥<span id="sum-comment-app"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-comment-app"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-box list-box">
                        <div class="head-title">
                            <i class="iconfont icon-chart-icon"></i>
                            <span>邀请推广大使</span>
                            <div class="header-total">总和：￥<span id="sum-invite-ambassador"></span></div>
                        </div>
                        <div class="table-main">
                            <table class="table table-striped table-bordered table-hover table-checkable" >
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="20%">序号</th>
                                    <th width="30%">金额 </th>
                                    <th width="50%">日期 </th>
                                </tr>
                                </thead>
                                <tbody id="main-invite-ambassador"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loding-modal">
            <i id="imgLoadingCircle" class="loadingCircle active"></i>
            <div>加载中…</div>
        </div>

@endsection

@section('js')
    <script src="{{asset('backend/js/user/balancelogsdetail.js')}}"></script>
@endsection
