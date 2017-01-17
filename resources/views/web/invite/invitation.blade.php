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
    <link type="text/css" href="../css/wechat.css" rel="stylesheet">
    <link href="/front/assets/css/invitation.css" rel="stylesheet" type="text/css"/>
    <title>邀请注册</title>
</head>
<body>
    <!--顶部图片-->
    <div class="head">
        <img src="/front/assets/img/invitation/bg_top.png" />
    </div>
    <!--手机注册-->
    <div class="register">
        {!! csrf_field() !!}
        <input class="register-code" type="hidden" name="welcome" value="{{$welcome}}"/>
        <div class="register-box phone">
            <div class="register-img phone-img"></div>
            <input class="register-code" placeholder="输入手机号"/>
            <hr />
            <button>获取验证码</button>
        </div>
        <div class="register-box code">
            <div class="register-img code-img"></div>
            <input class="register-code" placeholder="验证码"/>
        </div>
        <button class="btn">注册获得20元现金</button>
    </div>
    <!--注册成功-->
    <div class="register-success notices hide">
        <div class="head">注册成功</div>
        <div class="head-title">您已经获得最高50%学费返现~</div>
        <div class="btn">下载领取</div>
        <div class="telephone"><span class="question">有任何疑问可致电客服：</span><span class="number">400 034 0033</span></div>
    </div>
    <!--领取奖励-->
    <div class="register-reward notices hide">
        <div class="head">您已领取过奖励</div>
        <div class="head-title">快快把好东西分享给您的朋友吧~</div>
        <div class="btn">分享给朋友</div>
        <div class="telephone"><span class="question">有任何疑问可致电客服：</span><span class="number">400 034 0033</span></div>
    </div>
    <!--活动细则-->
    <div class="active">
        <div class="active-head"><span>活动细则</span></div>
        <img src="/front/assets/img/invitation/bg_down.png" />
        <div class="active-txt">
            <div class="txt">1.新用户通过此页面注册会获得20元现金；</div>
            <div class="txt">2.需下载半课app，登陆并认证；</div>
            <div class="txt">3.提现流程参见半课app；</div>
            <div class="txt">4.参加学习计划最高可获得学费50%奖励；</div>
            <div class="txt">5.半课保留法律范围内允许的对活动的解释权。</div>
        </div>
    </div>
</body>
<script>
    window.hisihiUrlObj={
        api_url_php:'http://{$Think.server.HTTP_HOST}/api.php?s=',
        img_url:'__IMG__',
        js: "__JS__",
        api_url:'__API_URL__'
    };
</script>
<!--<script type="application/javascript" src="__JS__/require.js" data-main="__JS__/config"></script>-->
<!--<script type="text/javascript" data-main="__JS__/famous-teacher-3.4.min"  src="__JS__/require.js" ></script>-->
</html>