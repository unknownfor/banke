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
    <link type="text/css" href="/front/assets/css/course/v1.8/course.css" rel="stylesheet">
    <title>课程详情</title>
</head>
<body>
<div id="course">
    <div class="description container">
        @if($course['img_details'])
            <?php
            $imgs=explode(',',$course['img_details']);
            ?>
            @foreach($imgs as $v)
                <img src="{{$v}}" />
            @endforeach
        @endif
        <div class="des-txt">
            <div class="txt-box">
                <div class="title">购买流程</div>
                <div class="info">
                    <p>1.下订单并支付预约金</p>
                    <p>2.工作人员将第一时间联系您，让您选择机构校区及地址</p>
                    <p>3.前往报名机构，缴纳剩余学费，也可以申请分期</p>
                </div>
            </div>
            <div class="txt-box">
                <div class="title">如何咨询</div>
                <div class="info">
                    <p>点击页面上方的电话或者在线咨询，学习咨询师将会第一时间联系您</p>
                </div>
            </div>
            <div class="txt-box">
                <div class="title">如何退款</div>
                <div class="info">
                    <p>点击APP右下角的我的，进入“我的订单”，点击“申请退款”,工作人员会第一时间联系您，核实信息</p>
                </div>
            </div>
            <div class="txt-box">
                <div class="title">购买须知</div>
                <div class="info">
                    <p>1.下单后，您还需到机构缴纳（半课价-预约金）元</p>
                    <p>2.若您还有其他疑问，请在工作日9：00到22：00间，拨打半课客服电话4000340033或者在线咨询</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
</html>