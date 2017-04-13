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
    <link type="text/css" href="/front/assets/css/course/course.css" rel="stylesheet">
    <title>课程详情</title>
</head>
<body>
<!--课程头部-->
<div class="head container">
    <div class="head-left">
        <img src="{{$course['cover']}}" />
    </div>
    <div class="head-middle">
        <div class="name">{{$course['name']}}</div>
        <div class="save">
            <span class="save-num">-{{$course['price']}}</span>
            <span class="save-precent">报名后返{{$course['discount']}}%</span>
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
        <div class="tips"><span>在任务中心领取剩余{{$course['task_award']}}%奖励</span></div>
    </div>
</div>
{{--机构简介--}}
<div class="org-detail container">
    <div class="head-left">
        <img src="{{$course['cover']}}" />
    </div>
    <div class="head-middle">
        <div class="head-name">武汉天虎设计培训</div>
        <div class="head-tips"><span>保就业</span><span>环境好好好</span><span>环境好</span><span>环境好</span><span>师资雄厚</span></div>
    </div>
    <div class="address-call">
        <a href="tel:{{$course['org']['tel_phone']}}">
            <div class="address-call-box">
                <span class="img"></span>
            </div>
        </a>
    </div>
</div>
<!--课程介绍-->
<div class="class-info container">
    <div class="container-head">
        <span>课程介绍</span>
    </div>
    <div class="class-info-box container-box">
        {!! $course['details'] !!}
    </div>
</div>
@include('web.layout.downloadbar')
</body>
</html>