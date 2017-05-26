<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Resource-type" content="Document">
    <!--禁止缩放-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--禁止数字识别为手机号-->
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <link type="text/css" href="/front/assets/css/course/v1.2/course.css" rel="stylesheet">
    <title>课程详情</title>
</head>
<body>
<!--课程头部-->
<div class="head container">
    <div class="head-left">
        <img src="{{$course['cover']}}@70h_70w_2e" />
    </div>
    <div class="head-middle">
        <div class="name">{{$course['name']}}</div>
        <div class="save">
            <span class="save-num">-{!! $course['price'] * $course['checkin_award']/100!!}</span>
            <span class="save-precent">报名后返{{$course['checkin_award']}}%</span>
        </div>
    </div>
    <div class="head-right">
        <div class="price">
            <span id="price-num">￥{{$course['price']}}</span>
        </div>
    </div>
</div>
<!--返现规则-->
<div class="pay-rule container">
    <div class="container-head">
        <span>返现规则</span>
    </div>
    <div class="pay-rule-box container-box">
        <div class="tips"><span>每日打卡领取当日奖励，学习结束时共返现学费{{$course['checkin_award']}}%</span></div>
        <div class="tips"><span>分享任务返现学费{{$course['share_award']}}%</span></div>
        <div class="tips"><span>开团完成任务返现学费{{$course['group_buying_award']}}%</span></div>
    </div>
</div>
{{--机构简介--}}
<div class="org-detail container">
    <div class="head-left">
        <img src="{{$course['cover']}}@70h_70w_2e" />
    </div>
    <div class="head-middle">
        <div class="head-name">{{$org['name']}}</div>
        <div class="head-tips">
            {{--优势标签--}}
            @foreach($org->tags as $val)
                <span>{{$val['name']}}</span>
            @endforeach
        </div>
    </div>
    <div class="address-call call-box" >
        <div class="address-call-box">
            <span class="img"></span>
        </div>
    </div>
</div>
<!--课程介绍-->
@if($course['details'])
<div class="class-info container">
    <div class="container-head">
        <span>课程介绍</span>
    </div>
    <div class="class-info-box container-box">
        {!! $course['details'] !!}
    </div>
</div>
@endif
<div class="call-mask hide">
    <div class="call-container">
        @if($org['tel_phone'])
        <div class="call-box"><a class="" href="tel:{{$org['tel_phone']}}">{{$org['tel_phone']}}</a></div>
        @endif
        {{--假设机构只有一个电话--}}
        @if($org['tel_phone2'])
        <div class="call-box"><a class="" href="tel:{{$org['tel_phone2']}}">{{$org['tel_phone2']}}</a></div>
        @endif
        <p class="quite">取消</p>
    </div>
</div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/course/course-v1.2.js" type="text/javascript"></script>
</html>