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
    <link href="/backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="/front/assets/css/commentcourse/v1.9/commentcourse.css" rel="stylesheet">
    <link type="text/css" href="/front/assets/css/commentcourse/v1.9/iconfont/iconfont.css" rel="stylesheet">
    <title>机构评论</title>
</head>
<body>
{!! csrf_field() !!}
<div class="commentPage" id="orgComment"
            data-uid="{{$comment['uid']}}"
            data-course-id="{{$comment['course_id']}}"
            data-org-id="{{$comment['org_id']}}"
            data-record-id="{{$comment['id']}}"
            data-type-id="2">
    <div class="headBox container">
        <img class="headImg" src="{{$user['avatar']}}"/>
        <div class="headName">{{$user['name']}}</div>
        <div class="headName">
            <p>我在“<span>{{$org['name']}}</span>”学习</p>
            <p>通过半课累计领取<span>{{$user['get_do_task_amount']}}</span>元现金</p>
        </div>
    </div>
    <div class="courseBox container">
        <div class="courseInfo">
            <div class="courseLeft">
                <img class="courseImg" src="http://pic.hisihi.com/2016-05-19/1463654396285620.png" />
            </div>
            <div class="courseMiddle">
                <div class="courseName">{{$course['name']}}</div>
                <div class="courseSchool">{{$org['branch_school']}}</div>
                <div class="courseAppoint">预约数:<span>{{$org['fake_enrol_counts']}}</span></div>
            </div>
            <div class="courseRight">
                <div class="realPrice">￥{{$course['price']}}</div>
                <div class="furtherPrice">￥{{$course['original_price']}}</div>
            </div>
        </div>
    </div>
    <div class="commentBox container">
        <div class="title">
            <div class="titleTxt">{{$org['name']}}</div>
            <div class="star" data-grade-total="{{$comment['star_counts']}}"></div>
        </div>
        <div class="comment">
            <div class="tips">
                @if($org->tags)
                    @foreach($org->tags as $v)
                        <div class="tips-box"><span>{{$v->name}}</span></div>
                    @endforeach
                @endif
            </div>
            <div class="txt">{{$comment['content']}}</div>
            <div class="org-album-pre">
                <ul class="org-album">
                    @if($comment->imgs)
                        <?php
                        $albums=explode(',',$comment->imgs);
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
        </div>
    </div>
    <div class="joinBox container">
        <div class="angle">
            <img src="/front/assets/img/commentcourse/tangle.png" />
        </div>
        <div class="slogen">
            <img src="/front/assets/img/commentcourse/slogen.png" />
        </div>
        <div class="joinTxt">
            <div class="txtOne">你想要的优质机构都在这里</div>
            <div class="txtTwo">仁和会计、韦伯英语、汇众教育、朗阁外语、天马驾校、蓝鸥IT、奇天插画</div>
        </div>
        <div class="joinTxt">
            <div class="txtOne">超多品类任你选</div>
            <div class="txtTwo">设计、外语、IT、考研、留学、美术、音乐、驾考、健身、少儿培训</div>
        </div>
        <div class="txtSlogen">快来和“<span>分享者</span>”一起参加，每天签到领学费吧</div>
        <div class="input">
            <input class="phone" type="number" placeholder="输入手机号" />
        </div>
        <div class="btn"><span class="downBtn">我也要领学费</span></div>
    </div>
</div>
{{--@include('web.layout.downloadbar')--}}
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/photoswipe.min.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/photoswipe-ui-default.min.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/myphotoswipe.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/commentcourse/commentcourse-v1.9.js" type="text/javascript"></script>
<script type="text/javascript">
    /*
     * photoswipe
     * */
    new MyPhotoSwipe('.org-album');
</script>
</html>