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
    <link href="/front/assets/css/invitation/v1.7/enrol.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/css/invitation/v1.7/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>{{$course['name']}}</title>
</head>
<body>
{!! csrf_field() !!}
<div id="enrol">
    <div class="page">
        <div class="container">
            <div class="head-txt">
                <div class="txt-one">成为优质机构代言人</div>
                <div class="txt-two">一大波福利等着你</div>
            </div>
            <img class="head-img first" src="/front/assets/img/invitation/v1.7/coo.png" />
            <from class="input-box">
                <div class="input-info">
                    <input placeholder="输入手机号" />
                </div>
                <div class="input-info">
                    <input placeholder="验证码" />
                    <hr/>
                    <input class="code-btn" placeholder="获取验证码">
                </div>

                <div class="input-info">
                    <input  placeholder="密码" type="password"/>
                </div>

                <button class="btn">
                    <a class="downloadBar" href="http://www.91banke.com/web/download">成为机构代言人</a>
                </button>
            </from>

        </div>
    </div>
    <div class="page">
        <div class="container">
            <img class="head-img" src="/front/assets/img/invitation/v1.7/coo1.png" />
            <div class="head-txt">
                <div class="txt-one">下载半课</div>
                <div class="txt-two">成为优质机构代言人</div>
            </div>
            <div class="btn">
                <a class="downloadBar" href="http://www.91banke.com/web/download">下载半课</a>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="container">
            <img class="head-img" src="/front/assets/img/invitation/v1.7/coo2.png" />
            <div class="head-txt">
                <div class="txt-one">邀请招生老师</div>
                <div class="txt-two">可获得100元返现</div>
            </div>
            <div class="btn">
                <a class="downloadBar" href="http://www.91banke.com/web/download">下载半课</a>
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
<script src="/front/assets/scripts/invitaion/enrol.v1.7.js" type="text/javascript"></script>
<script>
    new PageSlider({
        pages: $('#enrol .page'),
        gestureFollowing: true
    });
</script>
</html>