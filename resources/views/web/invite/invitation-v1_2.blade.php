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
    <link href="/front/assets/css/invitation/v1.2/invitation.css" rel="stylesheet" type="text/css"/>
    {{--图标字体--}}
    <link href="/front/assets/css/invitation/v1.2/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>邀请注册</title>
</head>
<body>
{!! csrf_field() !!}
<input type="hidden" name="welcome" value="{{$welcome}}"/>
<div id="invitation">
    <div class="page">
        <div class="container">
            <div class="register">
                <div class="register-main">
                    <div class="txt slogen">注册即刻领取8.8元现金奖励</div>
                    <div class="txt detail">接受好友邀请,上半课报名学习可省5000元学费</div>
                    <img class="bg" src="http://pic.hisihi.com/2017-04-14/1492162966172991.png" />
                    <div class="register-box phone">
                        <i class="iconfont register-img">&#xe659;</i>
                        <input class="register-code" id="phone-num" placeholder="输入手机号"/>
                    </div>
                    <div class="register-box code-num">
                        <i class="iconfont register-img">&#xe6a0;</i>
                        <input class="register-code" id="user-code" placeholder="验证码"/>
                        <hr color="#9b9b9b" />
                        <input class="code-btn disabled" type="button" id="phone-code-btn" value="获取验证码"/>
                    </div>
                    <div class="register-box password">
                        <i class="iconfont register-img">&#xe655;</i>
                        <input class="register-code" id="password-num" type="password"  placeholder="密码"/>
                    </div>
                    <button class="btn gift nouse"><span id="downloadBar">领取奖励</span></button>
                </div>
                <div class="register-done" style="display:none">
                    <div class="register-new" style="display:none">
                        <div class="txt slogen">恭喜您领取成功</div>
                        <div class="txt detail">您已接受半课用户的邀请体验半课学习</div>
                        <div class="txt txt-three">力省<span class="save-num">5000元</span>学费</div>
                        <img class="bg" src="http://pic.hisihi.com/2017-04-14/1492162966172991.png" />
                        <div class="txt txt-one">20元现金奖励已放至账号<span class="save-tel" ></span></div>
                        <div class="txt detail">快登陆APP领取吧~</div>
                        <button class="btn download"><a class="downloadBar" href="http://www.91banke.com/web/download">领取奖励</a></button>
                    </div>
                    <div class="register-old" style="display:none">
                        <img class="bg third" src="http://pic.hisihi.com/2017-04-14/1492162966172991.png" />
                        <div class="txt slogen">您好，老朋友</div>
                        <div class="txt detail">已经为您生成<span class="save-num">专属</span>的邀请链接，马上分享<br />赚取<span class="reward">5元</span>奖励~</div>
                        <div class="box first">
                            <div class="box-title">参与方式</div>
                            <div class="box-info">分享此链接给您的微信、QQ好友或者打开客户端参与推荐有奖活动，当好友完成注册认证后，您将立即获得5元奖励。</div>
                        </div>
                        <div class="box second">
                            <div class="box-title">奖励福利</div>
                            <div class="box-info">您获得的现金奖励将在您的半课账户中，现金奖励满100即可提现。</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="arrow">
                <i class="iconfont down-btn">&#xe7a5;</i>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="container">
            <img class="bg second" src="http://pic.hisihi.com/2017-04-14/1492163041837846.png" />
            <div class="txt txt-one">上半课报名学习</div>
            <div class="txt txt-two">最高可领取50%学费返现</div>
            <button class="btn download"><a class="downloadBar" href="http://www.91banke.com/web/download">下载半课，体验学费返现</a></button>
            <div class="arrow">
                <i class="iconfont down-btn">&#xe7a5;</i>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="container">
            <img class="bg second" src="http://pic.hisihi.com/2017-04-14/1492163081632946.png" />
            <div class="txt txt-one">坚持每日打卡</div>
            <div class="txt txt-two">每天开心领学费</div>
            <button class="btn download"><a class="downloadBar" href="http://www.91banke.com/web/download">下载半课，体验学费返现</a></button>
            <div class="arrow">
                <i class="iconfont down-btn">&#xe7a5;</i>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="container">
            <img class="bg second" src="http://pic.hisihi.com/2017-04-14/1492163132658414.png" />
            <div class="txt txt-one">完成指定任务</div>
            <div class="txt txt-two">领取任务奖励</div>
            <button class="btn download"><a class="downloadBar" href="http://www.91banke.com/web/download">下载半课，体验学费返现</a></button>
            <div class="arrow">
                <i class="iconfont down-btn">&#xe7a5;</i>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/zepto_modify.js"></script>
<script src="/front/assets/plugins/PageSlider.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/invitaion/invitaion.v1.2.js" type="text/javascript"></script>
<script>
    new PageSlider({
        pages: $('#invitation .page'),
        gestureFollowing: true
    });
</script>
</html>