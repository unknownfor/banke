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
    <link type="text/css" href="/front/assets/css/course/v1.8/course.css" rel="stylesheet">
    <link type="text/css" href="/front/assets/css/course/v1.8/iconfont/iconfont.css" rel="stylesheet">
    <title>课程分享详情</title>
</head>
<body>
<div id="course">
    <img class="head-img" src="/front/assets/img/course/v1.8/banner.jpeg" />
    <div class="head container">
        <div class="head-info">
            <div class="course-name">{{$course['name']}}</div>
            <div class="course-price"><span id="new-price">￥{{$course['price']}}</span><span id="old-price">￥{{$course['original_price']}}</span></div>
            <div class="course-payback">报名后最高返现<div id="payback">￥{{$course['max_award']}}</div><div class="appoint">预约数：<span>{{$course['fake_enrol_counts']}}</span></div></div>
        </div>
        <div class="head-tips">
            <div class="org-stars">
                <i class="star colored iconfont">&#xe70e;</i>
                <i class="star colored iconfont">&#xe70e;</i>
                <i class="star colored half iconfont">&#xe62f;</i>
                <i class="star iconfont">&#xe680;</i>
            </div>
            <div class="tips">
                <div class="tips-left">
                    {{--@foreach($course)--}}
                    <div class="tips-box">环境好</div>
                    <div class="tips-box">环境好</div>
                    <div class="tips-box">环境好</div>
                    <div class="tips-box">环境好</div>
                    <div class="tips-box">环境好</div>
                </div>
            </div>

        </div>
        <div class="head-link">
            @if($org->installment_flag)
                <a href="javascript:void(0)">
                <div class="link-info">
                    <div class="link-left">
                        <div class="link-img" id="support-img"></div>
                        <span class="link-name">支持分期</span>
                    </div>
                    <hr style="color:#d8d8d8"/>
                    {{--<div class="link-middle">首付200预约金，尾款分期付：<span>￥600*12期</span></div>--}}
                    <div class="link-middle">{{$org->installment_title}}</div>
                    <div class="link-right">
                        <div class="link-img" id="help-img"></div>
                    </div>
                </div>
            </a>
            @endif
            @if($org->refund_flag)
                <a href="javascript:void(0)">
                <div class="link-info">
                    <div class="link-left">
                        <div class="link-img" id="refund-img"></div>
                        <span class="link-name">支持7天退</span>
                    </div>
                    <hr style="color:#d8d8d8"/>
                    <div class="link-middle">{{$org->refund_title}}</div>
                </div>
            </a>
            @endif
        </div>
    </div>

    <div class="join container">
        <div class="join-title">以下小伙伴正在发起团购，参团享返现哟</div>
        <div class="join-box">
            <img class="join-img" src="{{$fakeUserInfo['img']}}" />
            <div class="join-detail">
                <div class="join-name">{{$fakeUserInfo['name']}}"</div>
                <div class="join-num">已有<span>{{$fakeNumber}}人</span>参团</div>
                <div class="join-btn"><a href="#">立即参团</a></div>
            </div>
        </div>
    </div>

    <div class="org container">
        <div class="org-box">
            <a class="org-url" href="javascript:void(0)">
                <img class="org-img" src="/front/assets/img/course/v1.8/logo.jpg" />
            </a>
            <div class="org-info">
                <div class="org-name">
                    <div class="org-left">
                        {{--<div class="name">{{$org['name]}}</div>--}}
                        <div class="tips"><span>职业培训</span></div>
                    </div>
                    <div class="org-right">预约数：4000</div>
                </div>
                <div class="org-stars">
                    <i class="star colored iconfont">&#xe70e;</i>
                    <i class="star colored iconfont">&#xe70e;</i>
                    <i class="star colored half iconfont">&#xe62f;</i>
                    <i class="star iconfont">&#xe680;</i>
                </div>
                <div class="org-score">
                    <span>环境：4.4</span><span>专业度：4.4</span><span>服务：4.4</span><span>效果：4.4</span>
                </div>
                <div class="org-contact">
                    <div class="contact-btn" id="phone">
                        <div class="contact-img"></div>
                        <div class="contact">电话咨询</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="teacher-box">
            <div class="teacher-info">
                <a href="javascript:void(0)">
                    <span class="teacher-name">建明·蒋蒋</span>
                    <span class="teacher-class">擅长课程：<span class="class-name">21天学会打球</span><span class="class-name">7天学会倒车入库和上坡</span></span>
                </a>
            </div>
            <div class="teacher-info">
                <a href="javascript:void(0)">
                    <span class="teacher-name">蘑菇姐</span>
                    <span class="teacher-class">擅长课程：<span class="class-name">优雅</span><span class="class-name">乖巧</span></span>
                </a>
            </div>
        </div>

    </div>

    <ul class="course container">
        <li class="course-btn selected" id="detail"><span>课程详情</span></li>
        <li class="course-btn" id="special"><span>机构特色</span></li>
        <li class="course-btn" id="evaluate"><span>机构评价</span></li>
    </ul>

    <div class="detail-info container">
        <img src="/front/assets/img/course/v1.8/logo.jpg" />
        <img src="/front/assets/img/course/v1.8/head.jpg" />
        <img src="/front/assets/img/course/v1.8/banner.jpeg" />
    </div>

    <div class="special-info container hide">
        <img src="/front/assets/img/course/v1.8/banner.jpeg" />
        <img src="/front/assets/img/course/v1.8/banner.jpeg" />
        <img src="/front/assets/img/course/v1.8/banner.jpeg" />
    </div>
    <div class="evaluate-info container hide">
        <div class="evaluate-box">
            <div class="evaluate-img">
                <img src="/front/assets/img/course/v1.8/logo.jpg" />
            </div>
            <div class="evaluate-detail">
                <div class="name">半课用户评价</div>
                <div class="stars">
                    <i class="star colored iconfont">&#xe70e;</i>
                    <i class="star colored iconfont">&#xe70e;</i>
                    <i class="star colored half iconfont">&#xe62f;</i>
                    <i class="star iconfont">&#xe680;</i>
                </div>
                <div class="detail">
                    机构评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论
                </div>
                <div class="time">
                    2017-07-08 17:45
                </div>
            </div>
        </div>
        <div class="evaluate-box">
            <div class="evaluate-img">
                <img src="/front/assets/img/course/v1.8/logo.jpg" />
            </div>
            <div class="evaluate-detail">
                <div class="name">半课用户评价</div>
                <div class="stars">
                    <i class="star colored iconfont">&#xe70e;</i>
                    <i class="star colored iconfont">&#xe70e;</i>
                    <i class="star colored half iconfont">&#xe62f;</i>
                    <i class="star iconfont">&#xe680;</i>
                </div>
                <div class="detail">
                    机构评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论
                </div>
                <div class="time">
                    2017-07-08 17:45
                </div>
            </div>
        </div>
    </div>

    <div class="call-mask hide">
        <div class="call-container">
            @if($org->tel_phone)
                <div class="call-box"><a class="" href="tel:{{$org['tel_phone']}}">{{$org['tel_phone']}}</a></div>
            @endif
            @if($org->tel_phone2)
                <div class="call-box"><a class="" href="tel:{{$org['tel_phone2']}}">{{$org['tel_phone2']}}</a></div>
            @endif
            <p class="quite">取消</p>
        </div>
    </div>


</div>
@include('web.layout.downloadbar')
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/course/course-v1.8.js" type="text/javascript"></script>
</html>