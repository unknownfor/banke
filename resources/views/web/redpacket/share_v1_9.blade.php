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
    <link type="text/css" href="/front/assets/css/redpacket/v1.9/redpacket.css" rel="stylesheet">
    <link type="text/css" href="/front/assets/css/org/v1.5/iconfont/iconfont.css">
    <title>领红包</title>
</head>
<body>
{!! csrf_field() !!}
<input type="hidden" name="welcome" value="{{$welcome}}"/>
<div id="redBag">
    <div class="wrapper">
        <div class="head">
            <div class="slogenBox">
                <img class="slogen" src="/front/assets/img/redbag/title.png" />
            </div>
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
            <div class="register">
                    <div class="register-box phone">
                        <div class="inputBox">
                        <input class="register-code" id="phone-num" placeholder="输入手机号" />
                        <input class="code-btn disabled" type="button" id="phone-code-btn" value="获取验证码">
                        </div>
                    </div>
                <div class="register-box code-num">
                    <div class="inputBox">
                    <input class="register-code" id="user-code" placeholder="输入验证码"/>
                    </div>
                </div>
                <div class="register-box password">
                    <div class="inputBox lastChild">
                    <input class="register-code" id="password-num" type="password"  placeholder="输入密码"/>
                    </div>
                </div>
                <div class="btn nouse">
                    <span id="downloadBar">立即领取</span>
                    <span id="dot"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container hide">
        <img class="bg second" src="/front/assets/img/freestudy/v1.8/bg.png">
        <div class="txt txt-one">下载半课</div>
        <div class="txt txt-two">获得更多优惠</div>
        <div class="btn active"><a href="http://www.91banke.com/web/download">下载半课</a></div>
    </div>
</div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/redpacket/redpacket-v1.9.js" type="text/javascript"></script>
</html>