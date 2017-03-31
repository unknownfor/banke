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
    <link href="/front/assets/css/invitation/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>邀请注册</title>
</head>
<body>
{!! csrf_field() !!}
<input type="hidden" name="welcome" value="{{$welcome}}"/>
<div id="invitation">
    <p class="slogen">注册即刻领取20元现金奖励</p>
    <p class="detail">接受好友邀请,上半课报名学习可省5000元学费</p>
    <img class="bg" src="/front/assets/img/invitation/bg_1.png" />
    <form class="register">
        {{--手机号--}}
        <div class="register-box">
            <i class="iconfont register-img">&#xe659;</i>
            <input class="register-code" id="phone-num" placeholder="输入手机号"/>
        </div>
        {{--验证码--}}
        <div class="register-box">
            <i class="iconfont register-img">&#xe6a0;</i>
            <input class="register-code" id="user-code" placeholder="验证码"/>
            <hr color="#9b9b9b" />
            <input class="code-btn disabled" type="button" id="phone-code-btn" value="获取验证码"/>
        </div>
        {{--密码--}}
        <div class="register-box">
            <i class="iconfont register-img">&#xe655;</i>
            <input class="register-code" id="password-num" placeholder="密码"/>
        </div>
        <button class="btn">领取奖励</button>
    </form>
    <div class="down">
        <span>
           <i class="iconfont down-btn">&#xe7a5;</i>
        </span>
    </div>
    <img class="bg second" src="/front/assets/img/invitation/bg_2.png" />
</div>
{{--@include('web.layout.downloadbar')--}}
</body>
<script src="/front/assets/scripts/invitaion/invitaion.js" type="text/javascript"></script>
</html>