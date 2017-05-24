/**
 * Created by hisihi on 2017/05/22.
 */
$(function () {
    window.addLoadingImg();
    window.addTip();

    //弹出申请页
    $(document).on(window.eventName,'.join-btn',function(){
        $('.cooperation').removeClass('hide');
        $('body').addClass('bg-color');
        $('.join').addClass('hide');
    });


    //填充手机号信息，按钮变色
    $(document).on('input', '#telphone', function(){
        var number=$(this).val(),
        reg = /^1(3|4|5|7|8)\d{9}$/;
        var $btn=$('.submit-box'),
            code=$('#telphone').val();
        if(reg.test(number)) {
            //调用此方法, 可以在别的方法中调用它
            // if (checkInput > 0 ) {
                if (code != '') {
                    $btn.removeClass('disabled');
                    $btn.addClass('active');
                } else {
                    $btn.addClass('disabled');
                    $btn.removeClass('active');
                }
            // }
            // else {
            //     return;
            // }
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
    $(document).on(window.eventName,'.submit-box.active', function () {
        window.controlLoadingBox(true);
        var name = $('#name').val(),
            address = $('#address').val(),
            contact = $('#contact').val(),
            telphone = $('#telphone').val();
        var url='/bankehome/addorgapplyfor',
            data={
                city:'武汉',
                introduce:'哈哈哈哈',
                name:name,
                address:address,
                contact:contact,
                tel_phone:telphone
            };
        $(this).removeClass('active');
        getDataAsync(url,data,function(res) {
            //成功返回之后调用的函数
            window.controlLoadingBox(false);
            if (res.status == true) {
                window.showTips('<p>恭喜您，申请已提交!</p>',2000);
                $('.welcome').removeClass('hide');
                $('.cooperation').addClass('hide');
                //弹出成功提示页
                showMyhomePage();
            }
            else{
                window.showTips(res.message);
            }
            },function(){
                window.controlLoadingBox(false);
                // $(this).addClass('active');
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

    //调用客户端跳转我的页面方法
    function showMyhomePage(){
        if (window.deviceType.mobile) {
            if (this.deviceType.android) {
                //如果方法存在
                if (typeof AppFunction != "undefined"&&  typeof AppFunction.callServicePhone !='undefined') {
                    AppFunction.callServicePhone(); //调用app的方法，得到用户的基体信息
                }
            }
            else {
                //如果方法存在
                if (typeof callServicePhone != "undefined") {
                    callServicePhone();//调用app的方法，得到电话
                }
            }
        }
    };

});