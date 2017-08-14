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
    $(document).on( window.eventName,'#jump-btn', function() {
        $('.sign-mask').addClass('hide').removeClass('show');
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
        // var url='/v1.3/share/doenrol',
        //     uid=$('.user').attr('data-uid'),
        //     cid=$('.user').attr('data-course-id'),
        //     oid=$('.user').attr('data-org-id'),
        //     mobile = $('.phone').val(),
        //     data={
        //         org_id:oid,
        //         course_id:cid,
        //         invitation_uid:uid,
        //         mobile:mobile
        //     };
        // $(this).removeClass('active');
        // getDataAsync(url,data,function(res) {
        //     //成功返回之后调用的函数
        //     window.controlLoadingBox(false);
        //     if (res.status_code == 0) {
                window.showTips('<p>恭喜您，申请成功!</p>',2000);
                window.setTimeout(function() {
                    showSuccessPage();
                },2000);
            // }
            // else{
            //     window.showTips(res.message);
            // }
        // },function(){
        //     window.controlLoadingBox(false);
        //     $(this).addClass('active');
        // },'post');
    });


    //跳转申请成功页面
    function showSuccessPage() {
        $('.sign-mask').addClass('hide').removeClass('show');
        $('.head').addClass('hide');
        $('.content').addClass('hide');
        $('.download').addClass('hide');
        $('.container').removeClass('hide');
    }

});