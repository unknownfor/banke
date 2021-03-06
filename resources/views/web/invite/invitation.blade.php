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
    <title>邀请注册</title>
</head>
<body>
{!! csrf_field() !!}
<input type="hidden" name="welcome" value="{{$welcome}}"/>
<div id="wrapper">
    <!--顶部图片-->
    <div class="head">
        <img src="/front/assets/img/invitation/bg_top.png" />
    </div>
    <!--手机注册-->
    <div class="register">
        <div class="register-box phone">
            <div class="register-img phone-img"></div>
            <input class="register-code" id="phone-num" placeholder="输入手机号"/>
            <hr color="#FFE747" />
            <input class="code-btn disabled" type="button" id="phone-code-btn" value="获取验证码"/>
        </div>
        <div class="register-box code">
            <div class="register-img code-img"></div>
            <input class="register-code" id="user-code" placeholder="验证码" />
        </div>

        <div class="btn">注册获得20元现金</div>
    </div>
    <!--领取优惠券-->
    <div class="coupon hide">
        <div class="coupon-box">
            <img class="ticket" id="one" src="/front/assets/img/invitation/20.png" />
            <img class="ticket" id="two" src="/front/assets/img/invitation/50.png">
            <div class="coupon-count">奖励已放至账户<span></span></div>
            <a href="{{env('APP_DOWNLOAD_URL')}}" >
                <div class="btn-active">下载半课领取</div>
            </a>
        </div>
    </div>
    <!--朋友获得奖励-->
    <div class="reward hide">
        <div class="second-title reward-title"><span>哪些朋友获得了奖励</span></div>
        <div class="reward-box">
            <img class="reward-img"  src="/front/assets/img/invitation/avatar/banke-u-2017012216305502.png"/>
            <span class="reward-name">李小婷</span>
            <div class="reward-time-box">
                <span class="reward-time">2017-01-18</span>
            </div>
        </div>
        <div class="reward-box">
            <img class="reward-img"  src="/front/assets/img/invitation/avatar/banke-u-2017012216305572.png"/>
            <span class="reward-name">王凯</span>
            <div class="reward-time-box">
                <span class="reward-time">2017-01-19</span>
            </div>
        </div>
        <div class="reward-box">
            <img class="reward-img"  src="/front/assets/img/invitation/avatar/banke-u-2017012216305524.png"/>
            <span class="reward-name">谢永明</span>
            <div class="reward-time-box">
                <span class="reward-time">2017-01-20</span>
            </div>
        </div>
        <div class="reward-box">
            <img class="reward-img"  src="/front/assets/img/invitation/avatar/banke-u-2017012216305519.png"/>
            <span class="reward-name">周子棋</span>
            <div class="reward-time-box">
                <span class="reward-time">2017-01-22</span>
            </div>
        </div>
        <div class="reward-box">
            <img class="reward-img"  src="/front/assets/img/invitation/avatar/banke-u-2017012216305582.png"/>
            <span class="reward-name">叶佳</span>
            <div class="reward-time-box">
                <span class="reward-time">2017-01-23</span>
            </div>
        </div>
    </div>
    <!--活动细则-->
    <div class="activity">
        <div class="second-title activity-head"><span>活动细则</span></div>
        <img src="/front/assets/img/invitation/bg_down.png" />
        <div class="activity-txt">
            <div class="txt">1.新用户通过此页面注册会获得20元现金；</div>
            <div class="txt">2.需下载半课app，登陆并认证；</div>
            <div class="txt">3.提现流程参见半课app；</div>
            <div class="txt">4.参加学习计划最高可获得学费50%奖励；</div>
            <div class="txt">5.半课保留法律范围内允许的对活动的解释权。</div>
        </div>
    </div>
    <!--遮罩-->
    <div class="mask"></div>
</div>
@include('web.layout.downloadbar')
</body>
<script src="/front/assets/scripts/invitaion/invitaion.js" type="text/javascript"></script>
</html>