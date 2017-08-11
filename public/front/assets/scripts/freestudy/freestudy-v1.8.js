/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    var href = window.location.href;
    var notFromApp = href.indexOf('share') >= 0;  //是否来源于app


    /*
    * 点击关闭分期说明弹窗*/
    $(document).on( window.eventName,'#jump-btn', function() {
        $('.sign-mask').addClass('hide').removeClass('show');
    });


    /*我要申请-判断来源是否是分享页*/
    $(document).on( window.eventName,'.down-btn', function() {
        if (!notFromApp) {
            //调用客户端拨打电话方法
            // showCallNumber();
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
        // window.controlLoadingBox(true);
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


    //调用客户端方法,显示拨打电话
    // function showCallNumber(){
    //     if (window.deviceType.mobile) {
    //         if (this.deviceType.android) {
    //             //如果方法存在
    //             if (typeof AppFunction != "undefined"&&  typeof AppFunction.callServicePhone !='undefined') {
    //                 AppFunction.callServicePhone(); //调用app的方法，得到用户的基体信息
    //             }
    //         }
    //         else {
    //             //如果方法存在
    //             if (typeof callServicePhone != "undefined") {
    //                 callServicePhone();//调用app的方法，得到电话
    //             }
    //         }
    //     }
    // };


    //跳转申请成功页面
    function showSuccessPage() {
        $('sign-mask').addClass('hide');
        $('container').removeClass('hide');
    }

    //点击关闭拨打电话弹窗
    $(document).on( window.eventName,'#jump-btn', function() {
        var $target=$('.sign-mask');
        $target.removeClass('show').addClass('hide');
    });


});