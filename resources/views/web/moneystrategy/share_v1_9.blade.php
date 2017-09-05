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
    <link type="text/css" href="/front/assets/css/moneystrategy/v1.7/moneystrategy.css" rel="stylesheet">
    <title>{{$strategy['title']}}</title>
</head>
<body>
<div id="article" data-uid="{{$uid}}" data-id="{{$id}}">
    <div class="head">
        <div class="title">{{$strategy['title']}}</div>
        <div class="author">by: {{$strategy['author']}}</div>
    </div>
    @if($strategy['content'])
        <div class="content">{!! $strategy['content'] !!}</div>
    @endif
</div>
@include('web.layout.downloadbar')
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
</html>