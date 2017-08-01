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
        <div class="head-link">
            @if($org_summary->installment_flag)
                <a href="javascript:void(0)">
                <div class="link-info">
                    <div class="link-left">
                        <div class="link-img" id="support-img"></div>
                        <span class="link-name">支持分期</span>
                    </div>
                    <hr style="color:#d8d8d8"/>
                    {{--<div class="link-middle">首付200预约金，尾款分期付：<span>￥600*12期</span></div>--}}
                    <div class="link-middle">{{$org_summary->installment_title}}</div>
                    <div class="link-right">
                        <div class="link-img" id="help-img"></div>
                    </div>
                </div>
            </a>
            @endif
            @if($org_summary->refund_flag)
                <a href="javascript:void(0)">
                <div class="link-info">
                    <div class="link-left">
                        <div class="link-img" id="refund-img"></div>
                        <span class="link-name">支持7天退</span>
                    </div>
                    <hr style="color:#dfe0e6"/>
                    <div class="link-middle">{{$org_summary->refund_title}}</div>
                </div>
            </a>
            @endif
        </div>
    </div>

    <div class="join container">
        <div class="join-title">以下小伙伴正在发起团购，参团享返现哟</div>
        <div class="join-box">
            <img class="join-img" src="{{$fake_user_info['img']}}" />
            <div class="join-detail">
                <div class="join-name">{{$fake_user_info['name']}}</div>
                <div class="join-num">已有<span>{{$fake_number}}人</span>参团</div>
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
                        <div class="name">{{$org_summary->name}}</div>
                        <div class="tips"><span>职业培训</span></div>
                    </div>
                    <div class="org-right">预约数：{{$org_summary->fake_enrol_counts}}</div>
                </div>
                <div class="org-stars" data-grade-total="{{$org_summary->grade_total}}">
                    <i class="star colored iconfont">&#xe70e;</i>
                    <i class="star colored iconfont">&#xe70e;</i>
                    <i class="star colored half iconfont">&#xe62f;</i>
                    <i class="star iconfont">&#xe680;</i>
                </div>
                <div class="org-score">
                    <span>环境：{{$org_summary->grade_env}}</span>
                    <span>专业度：{{$org_summary->grade_profession}}</span>
                    <span>服务：{{$org_summary->grade_service}}</span>
                    <span>效果：{{$org_summary->grade_effect}}</span>
                </div>
            </div>
        </div>
            <div class="org-contact">
                <div class="contact-btn" id="phone">
                    <div class="contact-img"></div>
                    <div class="contact">电话咨询</div>
                </div>
            </div>

        <div class="teacher-box">
            @foreach($org_teachers as $v)
                <div class="teacher-info">
                    <a href="javascript:void(0)">
                        <span class="teacher-name">{{$v->name}}</span>
                        <span class="teacher-class">
                            <label>擅长课程：</label>
                            <?php
                                $cources=explode(',',$v['goodat_course']);
                            ?>
                            @foreach($cources as $c)
                                <span class="class-name">{{$c}}</span>
                            @endforeach
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <ul class="course container">
        <li class="course-btn selected" id="detail"><span>课程详情</span></li>
        <li class="course-btn" id="special"><span>机构特色</span></li>
        <li class="course-btn" id="evaluate"><span>机构评价</span></li>
    </ul>

    <div class="detail-info container">
        <img src="/front/assets/img/course/v1.8/banner.jpeg" />

        <div class="description">
            <img src="/front/assets/img/course/v1.8/banner.jpeg" />
            <div class="des-txt">
                <div class="txt-box">
                    <div class="title">购买流程</div>
                    <div class="info">
                        <p>1.下订单并支付预约金</p>
                        <p>2.工作人员将第一时间联系您，让您选择机构校区及地址</p>
                        <p>3.前往报名机构，缴纳剩余学费，也可以申请分期</p>
                    </div>
                </div>
                <div class="txt-box">
                    <div class="title">如何咨询</div>
                    <div class="info">
                        <p>点击页面上方的电话或者在线咨询，学习咨询师将会第一时间联系您</p>
                    </div>
                </div>
                <div class="txt-box">
                    <div class="title">如何退款</div>
                    <div class="info">
                        <p>点击APP右下角的我的，进入“我的订单”，点击“申请退款”,工作人员会第一时间联系您，核实信息</p>
                    </div>
                </div>
                <div class="txt-box">
                    <div class="title">购买须知</div>
                    <div class="info">
                        <p>1.下单后，您还需到机构缴纳（半课价-预约金）元</p>
                        <p>2.若您还有其他疑问，请在工作日9：00到22：00间，拨打半课客服电话4000340033或者在线咨询</p>
                    </div>
                </div>
            </div>
        </div>
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
            @if($org_summary->tel_phone)
                <div class="call-box"><a class="" href="tel:{{$org_summary['tel_phone']}}">{{$org_summary['tel_phone']}}</a></div>
            @endif
            @if($org_summary->tel_phone2)
                <div class="call-box"><a class="" href="tel:{{$org_summary['tel_phone2']}}">{{$org_summary['tel_phone2']}}</a></div>
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