/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    var href = window.location.href;
    var notFromApp = href.indexOf('share') >= 0;  //是否来源于app


    /*
    * 点击关闭分期说明弹窗*/
    $(document).on( window.eventName,'#btn', function() {
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

    /*检测手机号码合法性*/


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



    //点击关闭拨打电话弹窗
    $(document).on( window.eventName,'.quite', function() {
        var $target=$('.sign-mask');
        $target.removeClass('show').addClass('hide');
    });




});