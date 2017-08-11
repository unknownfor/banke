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
    <link type="text/css" href="/front/assets/css/teachingteacher/v1.8/teacher.css" rel="stylesheet">
    <title>teachingteacher1.8</title>
</head>
<body>
    <div id="wrapper">
        <div class="teacher container">
            <div class="head">
                <img class="logo" src="{{$teacher['avatar']}}" />
                <div class="name">{{$teacher['name']}}</div>
                <div class="tips">
                    @if($teacher['tags'])
                        <?php
                            $tags=explode(',',$teacher['tags']);
                        ?>
                        @foreach($tags as $v)
                            <span>{{$v}}</span>
                        @endforeach
                    @endif
                </div>
                <div class="org">{{$teacher->org['name']}}</div>
            </div>
            <div class="detail">
                <div class="title">擅长课程：</div>
                <div class="info">
                    @if($teacher['goodat_course'])
                        <?php
                            $goodat_course=explode(',',$teacher['goodat_course']);
                        ?>
                        @foreach($tags as $v)
                            <span class="course">{{$v}}</span>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="detail">
                <div class="title">个人简介：</div>
                <div class="info">{!! $teacher['intro'] !!}</div>
            </div>
        </div>
        <div class="course container">
            <div class="main-title">相关课程推荐</div>
            <div class="course-box">
                <div class="course-head">
                    <div class="course-left">
                        <img src="/front/assets/img/course/v1.8/head.jpg" />
                    </div>
                    <div class="course-middle">
                        <div class="name">会计从业资格证会计从业资格证</div>
                        <div class="org">武汉仁和武汉仁和</div>
                    </div>
                    <div class="course-right">
                        <div class="price">￥80000</div>
                        <div class="old-price">￥182733</div>
                    </div>
                </div>
                <div class="course-appoint">
                    <div class="appoint-left">
                        <span class="appoint underline">学习周</span>期：
                    </div>
                    <div class="appoint-right">
                        <div class="appoint-tips">
                            <span class="appoint">5个月</span>
                            <span class="appoint first">预约数:0</span>
                        </div>
                        <div class="appoint-tips">
                            <span class="appoint">6天</span>
                            <span class="appoint first">预约数:23</span>
                        </div>
                    </div>

                </div>
                <div class="head-link">
                    <div class="link-info">
                        <div class="link-left">
                            <div class="link-img" id="back-img"></div>
                            <span class="link-name">半课返现</span>
                        </div>
                        <hr style="color:#d8d8d8"/>
                        <div class="link-middle">报名成功后最高返现50%</div>
                    </div>
                    <div class="link-info">
                        <div class="link-left">
                            <div class="link-img" id="support-img"></div>
                            <span class="link-name">半课分期</span>
                        </div>
                        <hr style="color:#d8d8d8"/>
                        <div class="link-middle">首付200预约金，尾款分期付：<span>￥600*12期</span></div>
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
            <div class="course-box">
                <div class="course-head">
                    <div class="course-left">
                        <img src="/front/assets/img/course/v1.8/head.jpg" />
                    </div>
                    <div class="course-middle">
                        <div class="name">会计从业资格证会计从业资格证</div>
                        <div class="org">武汉仁和武汉仁和</div>
                    </div>
                    <div class="course-right">
                        <div class="price">￥80000</div>
                        <div class="old-price">￥182733</div>
                    </div>
                </div>
                <div class="course-appoint">
                    <div class="appoint-left">
                        <span class="appoint underline">学习周</span>期：
                    </div>
                    <div class="appoint-right">
                        <div class="appoint-tips">
                            <span class="appoint">5个月</span>
                            <span class="appoint first">预约数:0</span>
                        </div>
                        <div class="appoint-tips">
                            <span class="appoint">6天</span>
                            <span class="appoint first">预约数:23</span>
                        </div>
                    </div>

                </div>
                <div class="head-link">
                    <div class="link-info">
                        <div class="link-left">
                            <div class="link-img" id="back-img"></div>
                            <span class="link-name">半课返现</span>
                        </div>
                        <hr style="color:#d8d8d8"/>
                        <div class="link-middle">报名成功后最高返现50%</div>
                    </div>
                    <div class="link-info">
                        <div class="link-left">
                            <div class="link-img" id="support-img"></div>
                            <span class="link-name">半课分期</span>
                        </div>
                        <hr style="color:#d8d8d8"/>
                        <div class="link-middle">首付200预约金，尾款分期付：<span>￥600*12期</span></div>
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
        </div>
    </div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
{{--<script src="/front/assets/scripts/teachingteacher/teacher-v1.8.js" type="text/javascript"></script>--}}
</html>