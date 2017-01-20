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
            <span class="save-img"></span>
            <span class="save-num">{{$course['discount']}}%</span>
        </div>
    </div>
    <div class="head-right">
        <div class="price"><span class="price-info">参考价</span><span id="price-num">￥{{$course['price']}}</span></div>
        <div class="real-price"><span class="price-info">最终成交价</span><span id="price-real-num">￥{{$course['real_price']}}</span></div>
    </div>
</div>
<!--返现规则-->
<div class="pay-rule container">
    <div class="container-head">
        <span>返现规则</span>
    </div>
    <div class="pay-rule-box container-box">
        <div class="tips"><span>在机构付费时预计将减免10%的学费；</span></div>
        <div class="tips"><span>剩余学费将会以每日打卡的形式返还到您的小金库余额里，每日打卡将获得1000-1不等的学费返现；</span></div>
        <div class="tips"><span>最终解释权由本平台所有。</span></div>
    </div>
</div>
<!--机构地址-->
<div class="address container">
    <div class="container-head">
        <span>机构地址</span>
    </div>
    <div class="address-box container-box">
        <div class="address">
            <div class="address-img"></div>
            <div class="address-detail">{{$course['org']['address']}}</div>
        </div>
        <div class="address-call">
            <a href="tel:{{$course['org']['tel_phone']}}">
                <div id="address-call-box">
                    <div id="img">
                    </div>
                </div>
            </a>
        </div>
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
</body>
</html>