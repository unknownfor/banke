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
    <link href="/front/assets/css/invitation/v1.6/enrol.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/css/invitation/v1.6/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>{{$course['name']}}</title>
</head>
<body>
{!! csrf_field() !!}
<div id="enrol">
    分享开团
    {{--<div class="box user"--}}
         {{--data-uid="{{$user['uid']}}"--}}
         {{--data-course-id="{{$course['id']}}"--}}
         {{--data-org-id="{{$org['id']}}"--}}
         {{--data-record-id="{{$shareInfo['record_id']}}"--}}
         {{--data-type-id="{{$shareInfo['type_id']}}"--}}
    {{-->--}}
        {{--@if($word['img_url_web'])--}}
            {{--<?php--}}
            {{--$imgs=explode(',',$word['img_url_web']);--}}
            {{--?>--}}
            {{--<img class="slogen-bg" src="{{$word['img_url_web']}}" />--}}
        {{--@else--}}
            {{--<img class="head-bg" src="{{asset('front/assets/img/org/banke-org.png')}}" />--}}
        {{--@endif--}}



        {{--<div class="user-info">--}}
            {{--<div class="info-left">--}}
                {{--<div class="user-img">--}}
                    {{--<img src="{{$user['avatar']}}@40h_40w_2e" />--}}
                {{--</div>--}}
                {{--<div class="user-title"></div>--}}
            {{--</div>--}}

            {{--<div class="info-right">--}}
                {{--<div class="user-name"><span>{{$user['name']}}</span>说:</div>--}}
            {{--</div>--}}
        {{--</div>--}}



    {{--</div>--}}
    {{--<div class="box information">--}}
        {{--<div class="box org-name">{{$org['name']}}</div>--}}
        {{--<div class="head">--}}
            {{--<div class="head-left">--}}
                {{--<a href="{{$course['link_url']}}">--}}
                {{--<img src="{{$course['cover']}}@80h_80w_2e" />--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="head-middle">--}}
                {{--<div class="name">{{$course['name']}}</div>--}}
                {{--<div class="save">--}}
                    {{--<span class="save-img"></span>--}}
                    {{--<span class="save-num">{{$course['max_award_percent']}}%</span>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="head-right">--}}
                {{--<div class="price"><span class="price-info">原价</span><span id="price-num">￥{{$course['price']}}</span></div>--}}
                {{--<div class="real-price"><span class="price-info">报名后最高返</span><span id="price-real-num">￥{{$course['max_award']}}</span></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="box line"></div>--}}
    {{--<div class="box join">--}}
        {{--<div class="join-people">--}}
            {{--<div class="leader">--}}
                {{--<div class="user-img">--}}
                    {{--<img src="{{$user['avatar']}}@40h_40w_2e" />--}}
                {{--</div>--}}
                {{--<div class="user-title"></div>--}}
            {{--</div>--}}

            {{--@if($members)--}}
                {{--@foreach($members['data'] as $v)--}}
                    {{--<div class="follower">--}}
                            {{--<img src="{{$v['avatar']}}" />--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--@else--}}
                {{--<div class="follower" style="display: none"></div>--}}
            {{--@endif--}}

            {{--<div id="more">--}}
                {{--<img src="/front/assets/img/invitation/v1.5/head.png" />--}}
            {{--</div>--}}

        {{--</div>--}}
        {{--<div class="join-slogen">已有<span>{{$members['counts']}}人</span>参团，赶快参团吧</div>--}}
        {{--<div class="join-btn">立即参团</div>--}}
        {{--<div class="join-description">--}}
            {{--<div class="title">参团须知</div>--}}
            {{--<div class="detail">团长，每参团成功一人，团长获得<span> {{$award['organizer_award']}}元返现</span></div>--}}
            {{--<div class="detail">团员，参团成功后，最高可获得<span> {{$course['max_award']}}元返现</span></div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="box line"></div>--}}
    {{--<div class="box join">--}}
        {{--<div class="join-description">--}}
            {{--<div class="title">什么是半课</div>--}}
            {{--<div class="detail">一半学费上好课，为学生提供7天担保服务，学生通过打卡获得返现，开团享受优惠，--}}
                {{--最高获得50%的返现帮助学生筛选出更具性价比的课程及机构，为学生提供终生学习的服务。</div>--}}
        {{--</div>--}}
        {{--<div class="join-rule">--}}
            {{--<a href="{{$ruleLinkUrl}}">了解返现规则</a>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="box1 process hide">--}}
        {{--<h3>报名流程</h3>--}}
        {{--<div class="rules first"><div class="num">1</div><div class="txt">留下您的联系方式</div></div>--}}
        {{--<i class="iconfont dotted">&#xe603;</i>--}}
        {{--<div class="rules"><div class="num">2</div><div class="txt">去往该培训机构缴纳学费</div></div>--}}
        {{--<i class="iconfont dotted">&#xe603;</i>--}}
        {{--<div class="rules"><div class="num">3</div><div class="txt">在机构填写信息（与平台认证信息一致）</div></div>--}}
        {{--<i class="iconfont dotted">&#xe603;</i>--}}
        {{--<div class="rules"><div class="num">4</div><div class="txt">平台核实后，在首页每日打卡领取学费</div></div>--}}
    {{--</div>--}}

    {{--<div class="box1 line hide"></div>--}}
    {{--<div class="box1 register hide">--}}
        {{--<div class="phone">--}}
            {{--<i class="iconfont register-img">&#xe659;</i>--}}
            {{--<input class="register-code" id="phone-num" placeholder="输入手机号"/>--}}
        {{--</div>--}}
        {{--<button class="btn nouse" id="register-btn"><span>确定</span></button>--}}
        {{--<p>客服将会马上联系你</p>--}}
    {{--</div>--}}

    {{--<div class="container hide" >--}}
        {{--<img class="bg second" src="http://pic.hisihi.com/2017-04-14/1492163041837846.png" />--}}
        {{--<div class="txt txt-one">早点报名，早点免学费哟！</div>--}}
        {{--<div class="txt txt-two">最高可领取<span>50%</span>学费返现</div>--}}
        {{--<div class="btn active"><a href="http://www.91banke.com/web/download">下载半课，体验学费返现</a></div>--}}
    {{--</div>--}}
</div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/invitaion/enrol.v1.6.js" type="text/javascript"></script>
</html>