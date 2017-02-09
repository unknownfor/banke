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
    <link href="/front/assets/css/invitation/invitation.css" rel="stylesheet" type="text/css"/>
    <title>邀请注册</title>
</head>
<body>
    <!--顶部图片-->
    <div class="head">
        <img src="/front/assets/img/invitation/bg_top.png" />
    </div>
    <!--手机注册-->
    <div class="register">
        {!! csrf_field() !!}
        <input type="hidden" name="welcome" value="{{$welcome}}"/>
        <div class="register-box phone">
            <div class="register-img phone-img"></div>
            <input class="mobile register-input" placeholder="输入手机号"/>
            <hr />
            <button class="getCheckCode disabled">获取验证码</button>
        </div>
        <div class="register-box code">
            <div class="register-img code-img"></div>
            <input class="register-input register-code" placeholder="验证码"/>
        </div>
        <button class="btn register-btn">注册获得20元现金</button>
    </div>
    <!--注册成功-->
    <div class="register-success notices hide">
        <div class="head">注册成功</div>
        <div class="head-title">您已经获得最高50%学费返现~</div>
        <div class="btn">下载领取</div>
        <div class="telephone"><span class="question">有任何疑问可致电客服：</span><span class="number">400 034 0033</span></div>
    </div>
    <!--领取奖励-->
    <div class="register-reward notices hide">
        <div class="head">您已领取过奖励</div>
        <div class="head-title">快快把好东西分享给您的朋友吧~</div>
        <div class="btn">分享给朋友</div>
        <div class="telephone"><span class="question">有任何疑问可致电客服：</span><span class="number">400 034 0033</span></div>
    </div>
    <!--活动细则-->
    <div class="active">
        <div class="active-head"><span>活动细则</span></div>
        <img src="/front/assets/img/invitation/bg_down.png" />
        <div class="active-txt">
            <div class="txt">1.新用户通过此页面注册会获得20元现金；</div>
            <div class="txt">2.需下载半课app，登陆并认证；</div>
            <div class="txt">3.提现流程参见半课app；</div>
            <div class="txt">4.参加学习计划最高可获得学费50%奖励；</div>
            <div class="txt">5.半课保留法律范围内允许的对活动的解释权。</div>
        </div>
    </div>
</body>
<script src="/front/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script>
    var baseApiUrl='/invitation';
    $(function(){
        var apiUrl="";
        $(document).on('input','.mobile',function(){
            var moblie = $(this).val(),
                $btn=$('.getCheckCode');
            if(/^1[3|4|5|7|8]\d{9}$/.test(moblie)){
                $btn.removeClass('disabled');
            }else{
                $btn.addClass('disabled');
            }
        });

        //得到验证码
        $(document).on('click','.getCheckCode',function(){
            var moblie = $('.mobile').val();
            if(/^1[3|4|5|7|8]\d{9}$/.test(moblie)){
                var url=baseApiUrl+'/requestSmsCode'
                getDataAsync(url,{mobile:moblie},function(res){
                    alert(res);
                },'post');
            }
        });

        //注册
        $(document).on('click','.register-btn',function(){
            var moblie = $('.mobile').val(),
                code=$('.register-code').val();
            if(/^1[3|4|5|7|8]\d{9}$/.test(moblie)){

                var url=baseApiUrl+'/register',
                        data={
                            mobile:moblie,
                            smsId:code,
                            welcome:$('input[name="welcome"]').val()
                        };

                getDataAsync(url,data,function(res){
                    alert(res);
                },'post');
            }
        });

        //请求数据
        function getDataAsync(url,data,callback,type){
            type = type ||'get';
            data._token=$('input[name="_token"]').val();
            $.ajax({
                type:type,
                url:url,
                data:data,
                success:function(res){
                    callback(res);
                }
            });
        }
    });
</script>
</html>