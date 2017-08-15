/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    window.addLoadingImg();
    window.addTip();

    var href = window.location.href;
    var notFromApp = href.indexOf('share') >= 0;  //是否来源于app

    /*
     * 点击关闭弹窗*/
    $(document).on( window.eventName,'#close', function() {
        $('.sign-mask').addClass('hide').removeClass('show');
    });


    /*
    * 点击关闭弹窗*/
    $(document).on( window.eventName,'#jump-btn', function() {
        $('.sign-mask').addClass('hide').removeClass('show');
    });

    /*
     * 点击蒙板关闭*/
    $(document).on( window.eventName,'.sign-mask', function(e) {
        window.toHideModuleByClickOutside(e,function () {
            // $('.sign-mask').hide();
            $('.sign-mask').addClass('hide').removeClass('show');
        });
    });


    /*我要申请-判断来源是否是分享页*/
    $(document).on( window.eventName,'.down-btn', function() {
        if (!notFromApp) {
            return;
        }else {
            $('.sign-mask').removeClass('hide').addClass('show');
        }
    });

    /*检测手机号码合法性
     * 填写手机号
     * 输入框变色，按钮变色*/
    $(document).on('input', '.phone', function(){
        //页面禁止滚动
        window.scrollControl(false);
        var number=$(this).val(),
            reg = /^1(3|4|5|7|8)\d{9}$/;
        var $btn=$('#jump-btn');
        if(number!=''){
            if(reg.test(number)) {
                $btn.addClass('active');
                window.scrollControl(true);
            }else{
                $btn.removeClass('active');
                window.scrollControl(true);
            }
        }
    });

    $(document).on(window.eventName,'#jump-btn.active', function () {
        window.controlLoadingBox(true);
         var url='/v1.8/share/freestudysignup',
             id=$('#freestudy').attr('data-id'),
             mobile = $('.phone').val(),
             data={
                 free_study_id:id,
                 mobile:mobile
             };
         $(this).removeClass('active');
         getDataAsync(url,data,function(res) {
             //成功返回之后调用的函数
             window.controlLoadingBox(false);
             if (res.status_code == 0) {
                window.showTips('<p>恭喜您，申请成功!</p>',2000);
                window.setTimeout(function() {
                    showSuccessPage();
                },2000);
             }
             else{
                 window.showTips(res.msg);
             }
         },function(){
             window.controlLoadingBox(false);
             $(this).addClass('active');
         },'post');
    });


    //跳转申请成功页面
    function showSuccessPage() {
        $('.sign-mask').addClass('hide').removeClass('show');
        $('.head').addClass('hide');
        $('.content').addClass('hide');
        $('.download').addClass('hide');
        $('.container').removeClass('hide');
    }


    /*
    *判断活动是否结束
    * status 0：未启用。1：进行中。2：已结束
    * 0或者1时 显示“我要申请”
    * 2 显示“活动已结束”
     */
    function judgeTheActive() {

    }
});