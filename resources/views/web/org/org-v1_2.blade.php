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
    <link type="text/css" href="/front/assets/css/org/v1.2/org.css" rel="stylesheet">
    <title>机构详情</title>
</head>
<body>
<div class="address container">
    <div class="container-head">
        <span>机构地址</span>
    </div>
    <div class="address-box container-box">
        <div class="address-info">
            <div class="address-img"></div>
            <div class="address-detail">{{$org['address']}}</div>
        </div>
        <div class="address-call">
                <div id="address-call-box">
                    <a href="tel:{{$org['tel_phone']}}">
                    <div id="img"></div>
                        </a>
                </div>
        </div>
    </div>
</div>
<!--课程介绍-->
@if($org['details'])
<div class="class-info container">
    <div class="class-info-box container-box">
        {!!$org['details']!!}
    </div>
</div>
@endif
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/org/org-v1.2.js" type="text/javascript"></script>
</html>