/**
 * Created by jimmy-hisihi on 2017/5/6.
 */
$(function (){
    window.addLoadingImg();
    window.addTip();

    /*
    * 弹出注册窗口*/
    $(document).on(window.eventName,'#register',function(){
        $('.box1').removeClass('hide');
        $('.box').addClass('hide');
    });

    /*
    * 填写手机号
    * 输入框变色，按钮变色*/
    $(document).on('input', '#phone-num', function(){
        var number=$(this).val();
            // reg = /^1(3|4|5|7|8)\d{9}$/;
        var $btn=$('.btn');
        if(number!=''){
            // if(reg.test(number)) {
                $('.phone').addClass('active');
                $btn.removeClass('nouse');
                $btn.addClass('active');
            }else{
                $('.phone').removeClass('active');
                $btn.addClass('nouse');
                $btn.removeClass('active');
            }
        // }
    });

    $(document).on(window.eventName,'#register-btn.active', function () {
        window.controlLoadingBox(true);
        var url='/v1.3/share/doenrol',
            data={
            org_id:12,
            course_id:30,
            invitation_uid:210,
            mobile:'13554154325',
            org_name:'武汉卓意设计职业培训学校',
            course_name:'网页设计全科班'
        };
        $(this).removeClass('active');
        window.getDataAsync(url,data,function(res) {
            //成功返回之后调用的函数
            window.controlLoadingBox(false);
            if (res.status_code == 0) {
                window.showTips('<p>恭喜您，注册成功!</p>',2000);
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
     * 显示报名成功页面
     */
    function showSuccessPage() {
        $('.box1').addClass('hide');
        $('.container').removeClass('hide');
    }


});
