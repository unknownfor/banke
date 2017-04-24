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
    <link type="text/css" href="/front/assets/css/org/v1.2/org.css" rel="stylesheet">
    <title>机构详情</title>
</head>
<body>
<div class="head container">
    @if($org['cover'])
        <?php
            $imgs=explode(',',$org['cover']);
        ?>
        <img class="head-bg" src="{{$imgs[0]}}" />
        @else
        <img class="head-bg" src="{{asset('front/assets/img/org/banke-org.png')}}" />
    @endif
    <div class="head-img">
        <img src="{{$org['logo']}}"/>
    </div>
    <div class="head-name">{{$org['name']}}</div>
    {{--机构简介--}}
    {{--<div class="head-title">{{$org['intro']}}</div>--}}
        <div class="head-tips">
            @foreach($org->tags as $val)
                <span>{{$val['name']}}</span>
            @endforeach
        </div>
</div>
<div class="address container">
    <div class="container-head">
        <span>机构地址</span>
    </div>
    <div class="address-box container-box">
        <div class="address-info">
            <div class="address-img"></div>
            <div class="address-detail">{{$org['address']}}</div>
        </div>
        <div class="address-call">
            <a href="tel:{{$org['tel_phone']}}">
                <div id="address-call-box">
                    <div id="img"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!--课程介绍-->
@if($org['details'])
<div class="class-info-share container">
    <div class="class-info-box container-box">
        {!!$org['details']!!}
</div>
</div>
@endif
<div class="call-mask hide">
    <div class="call-container">
        <p>点击拨打电话</p>
        <div class="call-box"><a class="" href="tel:{{$org['tel_phone']}}">{{$org['tel_phone']}}</a></div>
        <div class="call-box"><a class="" href="tel:{{$org['tel_phone']}}">{{$org['tel_phone']}}</a></div>
    </div>
</div>
@include('web.layout.downloadbar')
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/org/org-v1.2.js" type="text/javascript"></script>
</html>