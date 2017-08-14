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
    <link href="/front/assets/css/photoswipeunion.min.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="/front/assets/css/teachingteacher/v1.8/teacher.css" rel="stylesheet">
    <title>{{$teacher['name']}}</title>
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


        @if($teacher['album'])
        <div class="album container">
            <div class="main-title">老师相册</div>
            <ul class="album-ul">
                <?php
                $imgs=explode(',',$teacher['album']);
                ?>
                @foreach($imgs as $v)
                        <li class="album-li"><img src="{{$v}}" /></li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/plugins/photoswipe/myphotoswipe.js" type="text/javascript"></script>
<script src="/front/assets/plugins/photoswipe/photoswipe.min.js" type="text/javascript"></script>
<script>
    new MyPhotoSwipe('.album-ul',{
        bgFilter:true,
    });
</script>
</html>