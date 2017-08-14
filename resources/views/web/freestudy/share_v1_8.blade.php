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
    <link type="text/css" href="/front/assets/css/freestudy/v1.8/freestudy.css" rel="stylesheet">
    <link type="text/css" href="/front/assets/css/freestudy/v1.8/iconfont/iconfont.css" rel="stylesheet">
    <title>免费学页面</title>
</head>
<body>
<div id="freestudy">
    <div class="head">
        <div class="title">{{$freestudy['title']}}</div>
    </div>
    <div class="content">
        {!! $freestudy['content'] !!}
    </div>
    <div class="download">
        <div class="down-btn">我要申请</div>
    </div>
    {{--<div class="sign-mask hide">--}}
    <div class="sign-mask show">
        <from class="modal-box-main">
            <div class="sign-head">
                <i id="close" class="iconfont">&#xe641;</i>
            </div>
            <div class="title">申请成功</div>
            <input class="phone" type="number" placeholder="输入手机号方便客服联系你">
            <div class="quite"><div id="jump-btn">马上领取</div></div>
        </from>
    </div>
    <div class="container hide">
        <img class="bg second" src="/front/assets/img/freestudy/v1.8/bg.png"/>
        <div class="txt txt-one">下载半课</div>
        <div class="txt txt-two">获得更多免费学资格</div>
        <div class="btn active"><a href="http://www.91banke.com/web/download">下载半课</a></div>
    </div>
</div>
{{--@include('web.layout.downloadbar')--}}
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/freestudy/freestudy-v1.8.js" type="text/javascript"></script>
</html>