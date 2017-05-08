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
    <link href="/front/assets/css/invitation/v1.3/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>{{$course['name']}}</title>
</head>
<body>
{!! csrf_field() !!}
<div id="invitation">
    <div class="box user hide">
        <div class="user-left">
            <img src="{{$user['avatar']}}@70h_70w_2e">
        </div>
        <div class="user-right">
            <p>您的好友<span class="user-friend">{{$user['name']}}</span>已经报名<br />他帮您免去了<span class="color">一半学费</p>
        </div>
    </div>
    <div class="box info hide">
        <div class="org-name">{{$org['name']}}</div>
        <div class="class">
            <div class="class-left">
                <img src="{{$course['cover']}}@70h_70w_2e">
            </div>
            <div class="class-middle">
                <div class="name">{{$course['name']}}</div>
                <div class="save">
                    <span class="save-img"></span>
                    <span class="save-num">{{$course['checkin_award']}}%</span>
                </div>
            </div>
            <div class="class-right">
                <div class="price"><span class="price-info">参考价</span><span id="price-num">￥{{$course['price']}}</span></div>
                <div class="real-price"><span class="price-info">最高奖励金额</span><span id="price-real-num">￥{!! $course['price'] * $course['checkin_award']/100!!}</span></div>
            </div>
        </div>
    </div>
    <div class="box join hide">
        <p class="slogen">用一半学费上好课！</p>
        <div class="btn">和好友一起学习</div>
    </div>
    <div class="box rule hide">
        <div class="txt"><span>如何只花一半学费上好课</span></div>
        <div class="link"><a href="javascript:void 0;">更多<i class="iconfont">&#xe600;</i></a></div>
    </div>
    <div class="box1 process">
        <h3>报名流程</h3>
        <div class="rules first"><div class="num">1</div><div class="txt">留下您的联系方式</div></div>
        <i class="iconfont dotted">&#xe603;</i>
        <div class="rules"><div class="num">2</div><div class="txt">去往该培训机构缴纳学费</div></div>
        <i class="iconfont dotted">&#xe603;</i>
        <div class="rules"><div class="num">3</div><div class="txt">在机构填写信息（与平台认证信息一致）</div></div>
        <i class="iconfont dotted">&#xe603;</i>
        <div class="rules"><div class="num">4</div><div class="txt">平台核实后，在首页每日打卡领取学费</div></div>
    </div>
    <div class="box1 register">
        <div class="phone">
            <i class="iconfont register-img">&#xe659;</i>
            <input class="register-code" id="phone-num" placeholder="输入手机号"/>
        </div>
        <button class="btn nouse"><span>确定</span></button>
        <p>客服将会马上联系你</p>
    </div>

</div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/invitaion/enrol.v1.3.js" type="text/javascript"></script>
</html>