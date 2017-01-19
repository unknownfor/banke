<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="/front/assets/css/news.css" rel="stylesheet" type="text/css">
    <title>动态详情</title>
</head>
<body>
<div class="wrapper">
    <!--标题-->
    <p class="box title">{{$news['title']}}</p>
    <p class="box author">{{$news['updated_at']}}</p>
    <!--作品信息-->
    <div class="box content">
        {!! $news['content'] !!}
    </div>
</div>
</body>
<!--不做分享和点击查看大图-->
</html>