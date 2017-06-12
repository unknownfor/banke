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
    <link href="/front/assets/css/orgpublicity/v1.6/orgpublicity.css" rel="stylesheet" type="text/css"/>
    <link href="/front/assets/css/orgpublicity/v1.6/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>半课合作机构</title>
</head>
<body>
{!! csrf_field() !!}
<div id="publicity"
     {{--data-uid="{{$user['uid']}}"--}}
     {{--data-org-id="{{$org['id']}}"--}}
>
    <div class="box head">
        <img class="head-bg" src="http://pic.hisihi.com/2016-05-19/1463654426358971.png" />
        <div class="head-img">
            <img src="http://pic.hisihi.com/2016-11-23/1479894836281466.jpg"/>
        </div>
        <p class="head-txt first"><span class="txt">报名后最高获得</span><span class="txt color">50%返现</span></p>
        <p class="head-txt second">用半课返现，学费贷款相当于0利息</p>
    </div>
    <div class="box detail">
        <div class="detail-info">
            半课是一个学生赚钱省学费的利器
            <br />
            <br />
            一半学费上好课，为学生提供7天担保服务，学生通过打卡获得返现，开团享受优惠，最高可获得50%返现，
            帮助学生筛选出更具性价比的课程及机构，为学生提供终生学习的服务。
        </div>
    </div>
    <div class="box line"></div>
    <div class="box cooperation">
        <div class="title">优质合作机构</div>
        <div class="coo-container">
            @if($superiororg)
                @foreach($superiororg as $v)
                    {{--<p>{{$v->logo}}</p>--}}
                    {{--<p>{{$v->category}}</p>--}}
                    {{--<p>{{$v->name}}</p>--}}
                    <div class="coo-org">
                        <a href="javascript:void(0)">
                            <img class="org-img" src="{{$v->logo}}"/>
                            <span class="org-name">{{$v->name}}</span>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="box line"></div>
    <div class="box appointment">
        <p>客服半半将会第一时间联系您</p>
        <div class="input-box org-box">
            <i class="iconfont register-img">&#xe76b;</i>
            <input class="register-code" id="org-name" placeholder="输入意向机构" />
        </div>
        <div class="input-box num-box">
            <i class="iconfont register-img">&#xe61f;</i>
            <input class="register-code" id="phone-num" placeholder="输入手机号"/>
        </div>
        <button class="btn nouse" id="register-btn"><span>确定</span></button>

        <div class="statement">本服务由半课提供，最终解释权归半课所有</div>
    </div>

    <div class="container hide" >
        <img class="bg second" src="http://pic.hisihi.com/2017-04-14/1492163041837846.png" />
        <div class="txt txt-one">领取成功</div>
        <div class="txt txt-two">获得<span>50%</span>返现机会</div>
        <div class="btn active"><a href="http://www.91banke.com/web/download">下载半课，体验学费返现</a></div>
    </div>


</div>

@include('web.layout.downloadbar')
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/orgpublicity/orgpublicity-v1.6.js" type="text/javascript"></script>
</body>
</html>