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
    <link type="text/css" href="/front/assets/css/activity/v1.8/activity.css" rel="stylesheet">
    <title>活动页面</title>
</head>
<body>
<div id="activity">
    @if($activity['title'])
        <div class="head">
            <div class="title">{{$activity['title']}}</div>
            @if($activity['author'])
                <div class="author">by: {{$activity['author']}}</div>
            @endif
        </div>
    @endif
    @if($activity['content'])
        <div class="content">{!! $activity['content'] !!}</div>
    @endif
</div>
@include('web.layout.downloadbar')
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
</html>