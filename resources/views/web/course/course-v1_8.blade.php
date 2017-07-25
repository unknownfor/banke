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
    <title>课程详情</title>
</head>
<body>
    <div id="course">
        <img class="head-img" src="/front/assets/img/course/v1.8/banner.jpeg" />
        <div class="head container">
            <div class="head-info">
                <div class="course-name">会计从业资格证资格证资格证资格证会计从业资格证资格证资格证资格证</div>
                <div class="course-price"><span id="new-price">￥400000</span><span id="old-price">￥600</span></div>
                <div class="course-payback">报名后最高返现<div id="payback">￥25000</div><div class="appoint">预约数：<span><span>4000</span></div></div>
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
                        <span class="tips-box">环境好</span>
                        <span class="tips-box">环境好</span>
                        <span class="tips-box">环境好</span>
                    </div>
                    <div class="tips-right">
                        <span>9999人评价</span>
                        <i class="iconfont">&#xe600;</i>
                    </div>
                </div>

            </div>
            <div class="head-link">
                <div class="link-info">
                    <div class="link-left">
                        <div class="link-img" id="support-img"></div>
                        <span class="link-name">支持分期</span>
                    </div>
                    <hr style="color:#d8d8d8"/>
                    <div class="link-middle">首付200预约金，尾款分期付：<span>￥600*12期</span></div>
                    <div class="link-right">
                        <div class="link-img" id="help-img"></div>
                    </div>
                </div>
                <div class="link-info">
                    <div class="link-left">
                        <div class="link-img" id="refund-img"></div>
                        <span class="link-name">支持7天退</span>
                    </div>
                    <hr style="color:#d8d8d8"/>
                    <div class="link-middle">报名7天内，学习不满意可以申请退款</div>
                </div>
            </div>
        </div>

        <div class="join container">
            <div class="join-title">以下小伙伴正在发起团购，参团享返现哟</div>
            <div class="join-box">
                <img class="join-img" src="/front/assets/img/course/v1.8/head.jpg" />
                <div class="join-detail">
                    <div class="join-name">参团组长</div>
                    <div class="join-num">已有<span>100550人</span>参团</div>
                    <div class="join-btn">立即参团</div>
                </div>
            </div>
        </div>

        <div class="org container">
            <div class="org-box">
                <img class="org-img" src="/front/assets/img/course/v1.8/logo.jpg" />
                <div class="org-info">
                    <div class="org-name">
                        <div class="org-left">
                            <div class="name">武汉仁和</div>
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
                        <div class="contact-btn" id="online">
                            <div class="contact-img"></div>
                            <div class="contact">在线咨询</div>
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
            <li class="course-btn" id="detail">
                {{--<a href="javascript:void(0)">--}}
                    <span>课程详情</span>
                {{--</a>--}}
            </li>
            <li class="course-btn" id="special"><span>机构特色</span></li>
            <li class="course-btn selected" id="evaluate"><span>机构评价</span></li>
        </ul>

        {{--@if($org['tel_phone2'])--}}
        {{--<div class="info container">--}}
            {{--<img src="/front/assets/img/course/v1.8/banner.jpeg" />--}}
            {{--<img src="/front/assets/img/course/v1.8/banner.jpeg" />--}}
            {{--<img src="/front/assets/img/course/v1.8/banner.jpeg" />--}}
        {{--</div>--}}
        {{--@endif--}}
        <div class="evaluate-info container">
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





    </div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/course/course-v1.8.js" type="text/javascript"></script>
</html>