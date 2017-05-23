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
    <link href="/front/assets/css/invitation/v1.3/invitation.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/css/invitation/v1.3/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>{{$course['name']}}</title>
</head>
<body>
{!! csrf_field() !!}
<div id="invitation">
    <img src="{{$word['img_url_web']}}">
    <div class="box user"
         data-uid="{{$user['uid']}}"
         data-course-id="{{$course['id']}}"
         data-org-id="{{$org['id']}}"
         data-org-name="{{$org['name']}}"
         data-record-id="{{$recordId}}"
         data-type-id="{{$typeId}}"
         data-course-name="{{$course['name']}}"
    >
        {{--机构banner图片--}}
            @if($org['cover'])
                <?php
                $imgs=explode(',',$org['cover']);
                ?>
                <img class="head-bg" src="{{$imgs[0]}}" />
            @else
                <img class="head-bg" src="{{asset('front/assets/img/org/banke-org.png')}}" />
            @endif

                @if($user['avatar'])
                    <?php
                    $imgs=explode(',',$user['avatar']);
                    ?>
                    <div class="head-img">
                        <img src="{{$imgs[0]}}@70h_70w_2e"/>
                    </div>
                @else
                    <div class="head-img">
                        <img src="{{asset('http://pic.hisihi.com/2016-10-22/1477107042521143.png@70h_70w_2e')}}" />
                    </div>
                @endif
                <div class="info-box">
                    <p class="txt-one">您的好友<span class="user-friend">{{$user['name']}}</span>已经报名</p>
                    <p class="txt-two">他帮您免去了一半学费</p>
                    <div class="org-name">{{$org['name']}}</div>
                    <div class="class">
                        <div class="class-left">
                            <a href="{{$course['link_url']}}">
                                <img src="{{$course['cover']}}@60h_60w_2e">
                            </a>
                        </div>
                        <div class="class-middle">
                            <div class="name">{{$course['name']}}</div>
                            <div class="save">
                                <span class="save-img"></span>
                                <span class="save-num">{{$course['checkin_award']}}%</span>
                            </div>
                        </div>
                        <div class="class-right">
                            <div class="price"><span class="price-info">参考价</span><span id="price-num">￥{{$course['price']}}</span></div>
                            <div class="real-price"><span class="price-info">最高奖励金额</span><span id="price-real-num">￥{!! $course['price'] * $course['checkin_award']/100!!}</span></div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="box line"></div>
    <div class="box join">
        <p class="slogen">用一半学费上好课！</p>
        <div class="btn" id="register-area">和好友一起学习</div>
        <div class="txt"><a href="{{$ruleLinkUrl}}">如何只花一半学费上好课<i class="iconfont">&#xe600;</i></a></div>
    </div>
    <div class="box1 process hide">
        <h3>报名流程</h3>
        <div class="rules first"><div class="num">1</div><div class="txt">留下您的联系方式</div></div>
        <i class="iconfont dotted">&#xe603;</i>
        <div class="rules"><div class="num">2</div><div class="txt">去往该培训机构缴纳学费</div></div>
        <i class="iconfont dotted">&#xe603;</i>
        <div class="rules"><div class="num">3</div><div class="txt">在机构填写信息（与平台认证信息一致）</div></div>
        <i class="iconfont dotted">&#xe603;</i>
        <div class="rules"><div class="num">4</div><div class="txt">平台核实后，在首页每日打卡领取学费</div></div>
    </div>
    <div class="box1 line hide"></div>
    <div class="box1 register hide">
        <div class="phone">
            <i class="iconfont register-img">&#xe659;</i>
            <input class="register-code" id="phone-num" placeholder="输入手机号"/>
        </div>
        <button class="btn nouse" id="register-btn"><span>确定</span></button>
        <p>客服将会马上联系你</p>
    </div>
    <div class="container hide">
        <img class="bg second" src="http://pic.hisihi.com/2017-04-14/1492163041837846.png" />
        <div class="txt txt-one">早点报名，早点免学费哟！</div>
        <div class="txt txt-two">最高可领取<span>50%</span>学费返现</div>
        <div class="btn active"><a href="http://www.91banke.com/web/download">下载半课，体验学费返现</a></div>
    </div>
</div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/invitaion/enrol.v1.3.js" type="text/javascript"></script>
</html>