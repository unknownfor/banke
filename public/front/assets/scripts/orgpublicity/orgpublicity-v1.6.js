/**
 * Created by hisihi on 2017/06/09.
 */
$(function () {

    window.addLoadingImg();
    window.addTip();

    //输入框激活变色
    $(document).on('input', '#org-name', function(){
        var org=$('#org-name').val();
        if(org!='') {
            $('.org-box').addClass('active');
        }else{
            $('.org-box').removeClass('active');
        }
    });


    //输入框激活变色
    $(document).on('input', '#phone-num', function() {
        var number=$('#phone-num').val(),
            reg = /^1(3|4|5|7|8)\d{9}$/;
        var $btn=$('#register-btn'),
            org=$('#org-name').val();
        if(org!='') {
            if (reg.test(number)) {
                $('.num-box').addClass('active');
                $btn.removeClass('nouse');
                $btn.addClass('active');
            } else {
                $('.num-box').removeClass('active');
                $btn.addClass('nouse');
                $btn.removeClass('active');
            }
        }else {
            $('.org-box').removeClass('active');
            $btn.addClass('nouse');
            $btn.removeClass('active');
        }
    });


    $(document).on(window.eventName,'#register-btn.active', function () {
        window.controlLoadingBox(true);
        var url='/v1.6/share/doenrol',
            comment=$('#org-name').val(),
            mobile = $('#phone-num').val(),
            data={
                mobile:mobile,
                comment:comment,
            };
        $(this).removeClass('active');
        getDataAsync(url,data,function(res) {
            //成功返回之后调用的函数
            window.controlLoadingBox(false);
            if (res.status_code == 0) {
                window.showTips('<p>恭喜您，预约成功!</p>',2000);
                window.setTimeout(function() {
                    showSuccessPage();
                },2000);
            }
            else{
                window.showTips(res.message);
            }
        },function(){
            window.controlLoadingBox(false);
            $(this).addClass('active');
        },'post');
    });




    /**
     * 显示预约成功页面
     */
    function showSuccessPage() {
        $('.box').addClass('hide');
        $('.container').removeClass('hide');
    }


    //点击加载更多
    $(document).on(window.eventName,'.more-btn',function() {
        //页面恢复滚动
        window.scrollControl(true);
        showOrgInfo();
    });

    //展示机构信息
    function showOrgInfo () {
        var box=$('#org-info'),
            btn=$('.more-btn');
        box.removeClass('noshow');
        btn.addClass('none');
    }

});