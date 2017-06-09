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
    <link href="/front/assets/css/orgapplyfor/v1.5/orgapplyfor.css" rel="stylesheet" type="text/css"/>
    <!--图标字体-->
    <link href="/front/assets/css/orgapplyfor/v1.5/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>合作入驻</title>
</head>
<body>
{!! csrf_field() !!}
    半课宣传
    @if($superiororg)
        @foreach($superiororg as $v)
            <p>{{$v->logo}}</p>
            <p>{{$v->category}}</p>
            <p>{{$v->name}}</p>
        @endforeach
    @endif
</body>
</html>