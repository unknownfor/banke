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
    <title>{{$org['name']}}</title>
</head>
<body>
{!! csrf_field() !!}
<div id="publicity">
    <div class="box head">
        @if($org['cover'])
            <?php
            $imgs=explode(',',$org['cover']);
            ?>
            <img class="head-bg" src="{{$imgs[0]}}" />
        @else
            <img class="head-bg" src="{{asset('front/assets/img/org/banke-org.png')}}" />
        @endif
        <div class="head-img">
            <img src="{{$org['logo']}}"/>
        </div>
            <p class="head-txt first">通过半课App报名<span>{{$org['name']}}</span></p>
            <p class="head-txt second"><span class="txt">最高获得</span><span class="txt color">50%返现</span></p>
    </div>
    <div class="box detail noshow" id="org-info">
        <div class="title">{{$org['name']}}</div>
        @if($org['details'])
            <div class="detail-info">
                {!!$org['details']!!}
            </div>
        @endif
    </div>
    <div class="box more-btn">
        <i class="iconfont">&#xe646;</i>
    </div>
    <div class="box detail">
        <div class="title">半课</div>
        <div class="detail-info">
            半课是一个学生赚钱省学费的利器
            <br />
            <br />
            一半学费上好课，为学生提供7天担保服务，学生通过打卡获得返现，开团享受优惠，最高可获得50%返现，
            帮助学生筛选出更具性价比的课程及机构，为学生提供终生学习的服务。
        </div>
    </div>
    <div class="box line"></div>
    <div class="box appointment">
        <p>客服半半将会第一时间联系您</p>
        <div class="input-box org-box">
            <i class="iconfont register-img">&#xe76b;</i>
            <select class="register-code" id="org-name" placeholder="选择课程" >
                @if($org['course'])
                    @foreach($org['course'] as $v)
                        <option class="course-id" data-course-id="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                @endif
            </select>
            <i class="iconfont register-img section">&#xe658;</i>
        </div>
        <div class="input-box num-box">
            <i class="iconfont register-img">&#xe61f;</i>
            <input class="register-code" id="phone-num" placeholder="输入手机号"/>
        </div>
        <button class="btn nouse" id="register-btn"><span>确定</span></button>

        <div class="statement">本服务由半课提供，最终解释权归半课所有</div>
    </div>
    <div class="box line"></div>
    <div class="box cooperation">
        <div class="title">优质合作机构推荐</div>
        <div class="org-container">
            @if($superiororg)
                @foreach($superiororg as $v)
                    <div class="coo-org">
                        <a href="javascript:void(0)">
                            <div class="tip-box">
                                <div class="tip-img"></div>
                                <div class="tip-txt">{{$v->category}}</div>
                            </div>
                            <div class="org-box">
                                <img class="org-img" src="{{$v->logo}}"/>
                                <div class="org-name">{{$v->name}}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="box margin"></div>
    <div class="container hide" >
        <img class="bg second" src="http://pic.hisihi.com/2017-04-14/1492163041837846.png" />
        <div class="txt txt-one">领取成功</div>
        <div class="txt txt-two">获得<span>50%</span>返现机会</div>
        <div class="btn active"><a href="http://www.91banke.com/web/download">下载半课，体验学费返现</a></div>
    </div>
</div>
@include('web.layout.downloadbar')
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/orgpublicity/orgpublicity-v1.6.js" type="text/javascript"></script>
</body>
</html>