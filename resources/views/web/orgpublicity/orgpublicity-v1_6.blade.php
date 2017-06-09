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
    <link href="/front/assets/css/orgpublicity/v1.6/orgpublicity.css" rel="stylesheet" type="text/css"/>
    <title>{{$org['name']}}</title>
</head>
<body>
{!! csrf_field() !!}
<<<<<<< HEAD
<div id="publicity">
    <div class="box head">
        @if($org['cover'])
            <?php
            $imgs=explode(',',$org['cover']);
            ?>
            <img class="head-bg" src="{{$imgs[0]}}" />
        @else
            <img class="head-bg" src="{{asset('front/assets/img/org/banke-org.png')}}" />
        @endif
        <div class="head-img">
            <img src="{{$org['logo']}}"/>
        </div>

    </div>
    <div class="box detail">
        <div class="title">武汉天马驾校</div>
        <div class="detail-info">
            虚生先生所做的时事短评中，曾有一个这样的题目：《我们应该有正眼看各方面的勇气》（《猛进》十九期　。
            诚然，必须敢于正视，这才可望敢想，敢说，敢作，敢当。
            倘使并正视而不敢，此外还能成什么气候。然而，不幸这一种勇气，是我们中国人最所缺乏的。
        </div>
    </div>
</div>

</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/orgpublicity/orgpublicity-v1.6.js" type="text/javascript"></script>
</body>
</html>