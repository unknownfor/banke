/**
 * Created by hisihi on 2017/4/13.
 */
$(function() {

    //点击弹出拨打电话框，判断来源是否是分享页
    $(document).on( window.eventName,'.address-call', function() {

        $('call-mask').removeClass('hide');
    });
});