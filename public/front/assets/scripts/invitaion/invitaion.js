/**
 * Created by hisihi on 2017/1/16.
 */
$(function () {
    window.addLoadingImg();

    //填充信息，按钮变色
    $(document).on('input', '#phone-num', function(){
        var number=$(this).val(),
        reg = /^1(3|4|5|7|8)\d{9}$/;
        var $code=$('#phone-code-btn'),
            $btn=$('.btn'),
            code=$('#user-code').val(),
            //新增登陆密码
            password=$('#user-password');
        if(reg.test(number)) {
           $code.removeClass('disabled');
           if(code!=''){
               $btn.addClass('active');
           }else{
               $btn.removeClass('active');
           }
        }else{
            $code.addClass('disabled');
            $btn.removeClass('active');
        }
    });

    //填充信息，按钮变色
    $(document).on('input', '#user-code', function() {
        var number=$('#phone-num').val(),
            reg = /^1(3|4|5|7|8)\d{9}$/;
        var $btn=$('.btn'),
            code=$(this).val();
        if(reg.test(number)) {
            if(code!=''){
                $btn.addClass('active');
            }else{
                $btn.removeClass('active');
            }
        }else{
            $btn.removeClass('active');
        }
    });

    //倒计时
    var countdown = 60;
    var timer;
    $(document).on( window.eventName,'#phone-code-btn', function setTime() {
        timer = window.setInterval(function () {
            setGetCodeBtn();
        }, 1000);

        //请求验证码
        if(countdown==60) {
            var url = '/invitation/requestSmsCode';
            getDataAsync(url, {mobile: $('#phone-num').val()},
                function (res) {
                    window.showTips(res.message);
                    if(res.status_code!=0) {
                        countdown = 0;
                        setGetCodeBtn();
                    }
                },function(){
                    countdown = 0;
                    setGetCodeBtn();
                },'post');
        }
    });

    function setGetCodeBtn(){
        var obj=$('#phone-code-btn')[0];
        if (countdown == 0) {
            obj.removeAttribute("disabled");
            obj.value = "获取验证码";
            countdown = 60;
            clearInterval(timer);
            return;
        } else {
            obj.setAttribute("disabled", true);
            obj.value = " " + countdown + " s";
            countdown--;
        }
    }

    //注册
    $(document).on(window.eventName,'.btn.active', function () {
        //window.setTimeout(function() {
        //    showSuccessPage();
        //},1500);
        window.controlLoadingBox(true);
        var phone = $('#phone-num').val(),
            code = $('#user-code').val();
        var url='/invitation/register',
            data={
                mobile:phone,
                smsId:code,
                welcome:$('input[name="welcome"]').val()
            };
        $(this).removeClass('active');
        getDataAsync(url,data,function(res){
                //成功返回之后调用的函数
            window.controlLoadingBox(false);
            if(res.status_code==0 ||res.status_code==50017) {
                $('.coupon-count span').text(phone);
                window.showTips('<p>注册成功!<br/>如未收到密码短信,<br/>请到App中重置密码</p>',2000);
                window.setTimeout(function() {
                    showSuccessPage();
                },2000);
            }else{
                window.showTips(res.message);
            }
        },function(){
            window.controlLoadingBox(false);
            $(this).addClass('active');
        },'post');
    });

    //请求数据
    function getDataAsync(url,data,callback,eCallback,type){
        type = type ||'get';
        data._token=$('input[name="_token"]').val();
        $.ajax({
            type: type,
            url: url,
            data: data,
            success: function (res) {
                callback(res);
            },
            error: function () {
                //请求出错处理
                window.controlLoadingBox(false),
                window.showTips('操作失败');
                eCallback && eCallback();
            }
        });
    }


    /**
     * 显示报名成功页面
     */
    //function showSuccessPage() {
    //
    //    //隐藏注册框
    //    $('.register').hide();
    //    $('.coupon').removeClass('hide');
    //    $('.reward').removeClass('hide');
    //};


});