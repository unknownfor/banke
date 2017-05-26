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
    <link type="text/css" href="/front/assets/css/org/v1.5/commentOrg.css" rel="stylesheet">
    <link href="/front/assets/css/org/v1.5/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>机构评论</title>
</head>
<body>
{!! csrf_field() !!}
    <div class="head container"
         data-typeId="2"
         data-id="33"
         data-uid="12071072" >
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
        <div class="head-tips">
            @foreach($org->tags as $val)
                <span>{{$val['name']}}</span>
            @endforeach
        </div>
    </div>

    <div class="box-line"></div>

    <div class="org-information hide">
        <!--课程介绍-->
        @if($org['details'])
            <div class="class-info container">
                <div class="container-head">
                    <span>机构详情</span>
                </div>
                <div class="class-info-box container-box">
                    {!!$org['details']!!}
                </div>
            </div>
        @endif

        <div class="box-line"></div>

        <div class="address container none">
            <div class="container-head">
                <span>机构地址</span>
            </div>
            <div class="address-box container-box">
                <div class="address-info">
                    <div class="address-img"></div>
                    <div class="address-detail">{{$org['address']}}</div>
                </div>
                <div class="address-call">
                    <div id="address-call-box">
                        <div class="img"></div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <div class="more-btn"><i class="iconfont icon-xialajiantou"></i></div>

    <div class="box-line"></div>

    <div class="reservation container">
        <div class="res-box">
            <input class="res-box-input" placeholder="请输入手机号" />
        </div>

        <div class="res-btn nouse"><span>领取50%返现名额</span></div>
    </div>

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

@include('web.layout.downloadbar')
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/org/commentOrgv1.5.js" type="text/javascript"></script>
</html>