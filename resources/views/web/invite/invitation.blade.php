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
    <link href="/front/assets/css/invitation/invitation.css" rel="stylesheet" type="text/css"/>
    {{--字体图标--}}
    <link href="/front/assets/css/invitation/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>邀请注册</title>
</head>
<body>
{!! csrf_field() !!}
<input type="hidden" name="welcome" value="{{$welcome}}"/>
<div id="invitation">
    <div class="page">
        <div class="txt slogen">注册即刻领取20元现金奖励</div>
        <div class="txt detail">接受好友邀请,上半课报名学习可省5000元学费</div>
        <img class="bg" src="/front/assets/img/invitation/bg_1.png" />
        <form class="register">
            <div class="register-box">
                <i class="iconfont register-img">&#xe659;</i>
                <input class="register-code" id="phone-num" placeholder="输入手机号"/>
            </div>
            <div class="register-box">
                <i class="iconfont register-img">&#xe6a0;</i>
                <input class="register-code" id="user-code" placeholder="验证码"/>
                <hr color="#9b9b9b" />
                <input class="code-btn disabled" type="button" id="phone-code-btn" value="获取验证码"/>
            </div>
            <div class="register-box">
                <i class="iconfont register-img">&#xe655;</i>
                <input class="register-code" id="password-num" placeholder="密码"/>
            </div>
            <button class="btn gift">领取奖励</button>
        </form>
        <div class="arrow">
            <i class="iconfont down-btn">&#xe7a5;</i>
        </div>
    </div>
    <div class="page">
        <img class="bg second" src="/front/assets/img/invitation/bg_2.png" />
        <div class="txt txt-one">上半课报名学习</div>
        <div class="txt txt-two">最高可领取50%学费返现</div>
        <button class="btn download">下载半课，体验学费返现</button>
        <div class="arrow">
            <i class="iconfont down-btn">&#xe7a5;</i>
        </div>
    </div>
    <div class="page">
        <img class="bg second" src="/front/assets/img/invitation/bg_3.png" />
        <div class="txt txt-one">坚持每日打卡</div>
        <div class="txt txt-two">每天开心领学费</div>
        <button class="btn download">下载半课，体验学费返现</button>
        <div class="arrow">
            <i class="iconfont down-btn">&#xe7a5;</i>
        </div>
    </div>
    <div class="page">
        <img class="bg second" src="/front/assets/img/invitation/bg_4.png" />
        <div class="txt txt-one">完成指定任务</div>
        <div class="txt txt-two">领取任务奖励</div>
        <button class="btn download">下载半课，体验学费返现</button>
        <div class="arrow">
            <i class="iconfont down-btn">&#xe7a5;</i>
        </div>
    </div>
</div>
{{--@include('web.layout.downloadbar')--}}
</body>
<script src="/front/assets/plugins/zepto_modify.js"></script>
<script src="/front/assets/plugins/PageSlider.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/invitaion/invitaion.js" type="text/javascript"></script>
<script>
    new PageSlider({
        pages: $('#invitation .page')
    });
</script>
</html>