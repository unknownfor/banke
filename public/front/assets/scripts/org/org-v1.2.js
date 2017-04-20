/**
 * Created by hisihi on 2017/4/13.
 */
$(function() {

    var href = window.location.href;
    var isFromApp = href.indexOf('banke-app') >= 0;  //是否来源于app

    //点击弹出拨打电话框，判断来源是否是分享页
    $(document).on( window.eventName,'.address-call', function() {
        if (isFromApp) {
            //调用客户端拨打电话方法
            showCallNumber();
        }else {
            $('.call-mask').removeClass('hide').addClass('show');
            window.scrollControl(false);
        }
    });


    $(document).on(window.eventName,function(e){
        toHideMask(e);
    });

    function toHideMask(e){
        var $target=$(e.srcElement);
        if($target.hasClass('box') ||
            $target.hasClass('call-box') ||
            $target.closest('.call-box').length>0)
        {
            return;
        }
        hideAndShow();
    };

    //收起拨打电话弹窗
    function hideAndShow(flag){
        var $target=$('.call-mask');
        if(flag){
            $target.removeClass('hide').addClass('show');
        }else {
            $target.removeClass('show').addClass('hide');
        }
    };



    //调用客户端方法,显示拨打电话
    function showCallNumber(){
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