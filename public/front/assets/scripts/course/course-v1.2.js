/**
 * Created by hisihi on 2017/4/13.
 */
$(function() {

    //点击弹出拨打电话框
    $(document).on( window.eventName,'.address-call', function() {
            $('.call-mask').removeClass('hide').addClass('show');
            window.scrollControl(false);
    });


    $(document).on(window.eventName,function(e){
        toHideMask(e);
    });


    //点击关闭拨打电话弹窗
    $(document).on( window.eventName,'.quite', function() {
        var $target=$('.call-mask');
        $target.removeClass('show').addClass('hide');
    });

    function toHideMask(e){
        var $target=$(e.srcElement);
        if($target.hasClass('box') ||
            $target.hasClass('call-box') ||
            $target.closest('.call-box').length>0)
        {
            return;
        }
    };

});