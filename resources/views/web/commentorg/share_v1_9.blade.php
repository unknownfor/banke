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
    <link type="text/css" href="/front/assets/css/redbag/v1.9/redbag.css" rel="stylesheet">
    <link type="text/css" href="/front/assets/css/org/v1.5/iconfont/iconfont.css">
    <title>开红包</title>
</head>
<body>
<div id="redBag">
    <div class="head">
        <img class="slogen" src="/front/assets/img/redbag/title.png" />
        <p class="headTitle">一大波红包等你领</p>
    </div>
    <div class="middle">
        <img class="middleBg" src="/front/assets/img/redbag/bg.png" />
        <div class="middleTxt">
            <p class="txtOne">我已经连续完成<span>2</span>天任务</p>
            <p class="txtOne">累计领取了</p>
            <p class="txtTwo">￥<span>19.9</span></p>
        </div>
    </div>
    <div class="footer">
        <img class="footerTop" src="/front/assets/img/redbag/bgTop.png">
        <form class="register">
                <div class="register-box phone">
                    <input class="register-code" id="phone-num" placeholder="输入手机号"/>
                </div>
                <div class="register-box code-num">
                    <input class="register-code" id="user-code" placeholder="验证码"/>
                    <hr color="#9b9b9b" />
                    <input class="code-btn disabled" type="button" id="phone-code-btn" value="获取验证码"/>
                </div>
                <div class="register-box password">
                    <input class="register-code" id="password-num" type="password"  placeholder="密码"/>
                </div>
                <button class="btn gift nouse"><span id="downloadBar">领取奖励</span></button>
        </form>
    </div>
</div>
{{--@include('web.layout.downloadbar')--}}
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
{{--<script src="/front/assets/scripts/org/commentOrg-v1.5.js" type="text/javascript"></script>--}}
</html>