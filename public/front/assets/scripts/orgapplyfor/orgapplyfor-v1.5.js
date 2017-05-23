/**
 * Created by hisihi on 2017/05/22.
 */
$(function () {
    window.addLoadingImg();
    window.addTip();

    //填充手机号信息，按钮变色
    $(document).on('input', '#telphone', function(){
        var number=$(this).val(),
        reg = /^1(3|4|5|7|8)\d{9}$/;
        var $btn=$('.submit-box'),
            code=$('#telphone').val();
        if(reg.test(number)) {
            //调用此方法, 可以在别的方法中调用它
            if( checkInput > 0 ) {
                if (code != '') {
                    $btn.removeClass('disabled');
                    $btn.addClass('active');
                } else {
                    $btn.addClass('disabled');
                    $btn.removeClass('active');
                }
            }
        }else{
            $btn.removeClass('active');
            $btn.addClass('disabled');
        }
    });

    //检查input输入框是否有内容
    function checkInput() {
        var $tr = $(".info").find("tr"),
            flag = 0,
            antiqueTypes = [];

        $tr.each( function( index, item ){
            var type = $(item).find("input[type='text']").val();

            antiqueTypes.push(type);

        });

        $.each(antiqueTypes, function(index, item){
            if( item.length == 0 ){
                flag += 1;
                $("order-tips").find("span").text("请输入商品物流单号");
            }
        });
        return flag;
    }

    //注册
    $(document).on(window.eventName,'.btn.active', function () {
        window.controlLoadingBox(true);
        var phone = $('#phone-num').val(),
            code = $('#user-code').val(),
            password = $('#password-num').val();
        var url='/v1.2/share/register',
            data={
                welcome:$('input[name="welcome"]').val(),
                mobile:phone,
                smsId:code,
                password:password,
            };
        $(this).removeClass('active');
        getDataAsync(url,data,function(res) {
            //成功返回之后调用的函数
            window.controlLoadingBox(false);
            if (res.status_code == 0) {
                window.showTips('<p>恭喜您，申请已提交!</p>',2000);
            }
            else{
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


});