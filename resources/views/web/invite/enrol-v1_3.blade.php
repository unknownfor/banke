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
    <title>{{$course['name']}}</title>
</head>
<body>
{!! csrf_field() !!}
<div id="invitation">
    <div class="box user">
        <div class="user-left">
            {{--<img src="{{$user.avatar}}@70h_70w_2e">--}}
        </div>
        <div class="user-right">
            {{--<p>您的好友<span class="user-friend">{{$user['name']}}</span>已经报名<br />他帮您省去了<span class="color">一半学费</p>--}}
        </div>
    </div>
    <div class="box info">
        <div class="org-name">{{$org['name']}}</div>
        <div class="class">
            <div class="class-left">
                <img src="{{$course['cover']}}@70h_70w_2e">
            </div>
            <div class="class-middle">
                <div class="name">{{$course['name']}}</div>
                <div class="save">
                    <span class="save-img"></span>
                    <span class="save-num">{{$course['discount']}}%</span>
                </div>
            </div>
            <div class="class-right">
                <div class="price"><span class="price-info">参考价</span><span id="price-num">￥{{$course['price']}}</span></div>
                <div class="real-price"><span class="price-info">最高奖励金额</span><span id="price-real-num">￥{{$course['real_price']}}</span></div>
            </div>
        </div>

    </div>
</div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/invitaion/enrol.v1.3.js" type="text/javascript"></script>
</html>