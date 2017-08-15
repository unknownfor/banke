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
    <link type="text/css" href="/front/assets/css/org/v1.8/org.css" rel="stylesheet">
    <link type="text/css" href="/front/assets/css/course/v1.8/iconfont/iconfont.css" rel="stylesheet">
    <link href="/backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css" rel="stylesheet" type="text/css">
    <title>{{$org['name']}}</title>
</head>
<body>
<div id="org">
    <div class="head container">
        <div class="org-head">
            <img class="org-img" src="{{$org['logo']}}" />
            <p class="org-name">{{$org['name']}}</p>
            <span class="org-price">课程单均价{{$org['course_avg_price']}}</span>
            <div class="org-num">
                <div class="num-box">
                    <div class="num">{{$org['fake_enrol_counts']}}</div>
                    <div>预约</div>
                </div>
                <hr />
                <div class="num-box">
                    <div class="num">{{$org['fake_comment_count']}}</div>
                    <div>报名</div>
                </div>
                <hr />
                <div class="num-box">
                    <div class="num">{{$org['fake_consult_ranking']}}</div>
                    <div>咨询排名</div>
                </div>
            </div>
        </div>
        <div class="head-tips">
            {{--<div>{{$org['grade_total']}}</div>--}}
            <div class="org-stars">
                <i class="star colored iconfont">&#xe70e;</i>
                <i class="star colored iconfont">&#xe70e;</i>
                <i class="star colored half iconfont">&#xe62f;</i>
                <i class="star iconfont">&#xe680;</i>
            </div>
            <div class="tips">
                <div class="tips-left">
                    @if($org->tags)
                        @foreach($org->tags as $v)
                            <div class="tips-box">{{$v->name}}</div>
                        @endforeach
                    @endif
                </div>
                {{--机构评价--}}
                {{--<div class="tips-right">--}}
                    {{--<span>{{$org['fake_comment_count']}}人评价</span>--}}
                    {{--<i class="iconfont" id="more">&#xe600;</i>--}}
                {{--</div>--}}
            </div>

        </div>
        <div class="org-tips">
            <div class="tips-left">热门课程</div>
            <div class="tips-right">
                @if($org->hotmsg)
                    @foreach($org->hotmsg as $v)
                        <div class="tips-box">
                            <span>{{$v->name}}</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="address container">
        <div class="address-head">
            <div class="head-left">
                <span class="underline">最近校</span>区：
                <span class="school-add">{{$sub_org['name']}}</span>
            </div>
            {{--全部校区--}}
            {{--<div class="head-right">--}}
                {{--<span>全部校区</span>--}}
                {{--<i class="iconfont" id="more-school">&#xe600;</i>--}}
            {{--</div>--}}
        </div>
        <div class="address-bottom">
            <div class="address-left"></div>
            <div class="address-middle">{{$sub_org['address']}}</div>
            <div class="address-right">
                <div class="call-img"></div>
            </div>
        </div>
    </div>

    <div class="introduction container">
        <div class="org-album-pre">
            <ul class="org-album">
                @if($org->album)
                    <?php
                    $albums=explode(',',$org->album);
                    ?>
                    @foreach($albums as $v)
                            <li class="album-li">
                                <a href="{{$v}}" data-size="400x500"></a>
                                <img src="{{$v}}"/>
                            </li>
                    @endforeach
                @endif
                <div class="clear"></div>
            </ul>
        </div>
        <div class="half" id="full-intro">
            <div class="intro">{!! $org['details'] !!}</div>
        </div>
        <div class="read-more"  id="btn-intro">
            <i class="iconfont">&#xe600;</i>
            <span>查看简介</span>
        </div>
    </div>

    @if($course->count()>0)
    <div class="course container">
        <div class="main-title">优秀课程推荐</div>
        <div class="half" id="full-course">
            @if($course)
                @foreach($course as $v)
                    <div class="course-box">
                        <div class="course-head">
                            <div class="course-left">
                                <img src="{{$v->cover}}" />
                            </div>
                            <div class="course-middle">
                                <div class="name">{{$v->name}}</div>
                                <div class="org">{{$org['name']}}</div>
                            </div>
                            <div class="course-right">
                                <div class="price">￥{{$v->price}}</div>
                                <div class="old-price">￥{{$v->original_price}}</div>
                            </div>
                        </div>
                        <div class="course-appoint">
                            <div class="appoint-left">
                                <span class="appoint underline">学习周期：</span>
                            </div>
                            <div class="appoint-right">
                                <div class="appoint-tips">
                                    <span class="appoint">{{$v->period_desc}}</span>
                                    <span class="appoint first">预约数:{{$v->fake_enrol_counts}}</span>
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
                            @if($org->installment_flag==1)
                                <a href="{{$link_base_url}}/v1.8/web/installment/{{$v->id}}" class="link-info">
                                    <div class="link-left">
                                        <div class="link-img" id="support-img"></div>
                                        <span class="link-name">半课分期</span>
                                    </div>
                                    <hr style="color:#d8d8d8"/>
                                    <div class="link-middle">{{$org['installment_title']}}</div>
                                </a>
                            @endif
                            @if($org->refund_flag==1)
                                <a href="{{$link_base_url}}/v1.8/web/refund/{{$v->id}}" class="link-info">
                                    <div class="link-left">
                                        <div class="link-img" id="refund-img"></div>
                                        <span class="link-name">支持7天退</span>
                                    </div>
                                    <hr style="color:#d8d8d8"/>
                                    <div class="link-middle">{{$org['refund_title']}}</div>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="read-more" id="btn-course">
            <i class="iconfont">&#xe600;</i>
            <span>查看全部课程</span>
        </div>
    </div>
    @endif


    @if($org['teachers']->count()>0)
    <div class="teacher container">
        <div class="main-title">金牌讲师</div>
        <div class="half" id="full-teacher">
        @foreach($org->teachers as $v)
            <a href="{{$link_base_url}}/v1.8/web/teachingteacher/{{$v->id}}" class="teacher-box">
                <div class="teacher-left">
                    <img src="{{$v->avatar}}" />
                </div>
                <div class="teacher-right">
                    @if($v->tags)
                        <?php
                        $tag=explode(',',$v->tags)[0];
                        ?>
                        <div class="name">{{$v->name}}<span>{{$tag}}</span></div>
                    @else
                        <div class="name">{{$v->name}}</div>
                    @endif
                    <div class="org">{{$org['name']}}</div>
                </div>
            </a>
        @endforeach
        </div>
        <div class="read-more" id="btn-teacher">
            <i class="iconfont">&#xe600;</i>
            <span>查看全部老师</span>
        </div>
    </div>
    @endif


    <div class="call-mask hide">
        <div class="call-container">
            @if($sub_org['tel_phone'])
                <div class="call-box"><a class="" href="tel:{{$sub_org['tel_phone']}}">{{$sub_org['tel_phone']}}</a></div>
            @endif
            @if($sub_org['tel_phone'])
                <div class="call-box"><a class="" href="tel:{{$sub_org['tel_phone2']}}">{{$sub_org['tel_phone']}}</a></div>
            @endif
            <p class="quite">取消</p>
        </div>
    </div>
</div>
@include('web.layout.downloadbar')
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/photoswipe.min.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/photoswipe-ui-default.min.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/myphotoswipe.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/org/org-v1.8.js" type="text/javascript"></script>
<script type="text/javascript">
    /*
     * photoswipe
     * 图片信息查看  相册、视频信息查看
     * */
    new MyPhotoSwipe('.org-album');
</script>
</html>