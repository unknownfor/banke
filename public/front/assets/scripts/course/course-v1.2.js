/**
 * Created by hisihi on 2017/4/13.
 */
$(function() {

    //点击弹出拨打电话框，判断来源是否是分享页
    $(document).on( window.eventName,'.address-call', function() {

        //请求验证码
        if(countdown==60) {
            var url = '/invitation/requestSmsCode';
            getDataAsync(url, {mobile: $('#phone-num').val()},
                function (res) {
                    if(res.status_code==50016){
                        $('.register-old').show().parent().show().siblings().hide();
                        return;
                    }
                    window.showTips(res.message);
                    if(res.status_code!=0) {
                        countdown = 0;
                        //setGetCodeBtn();
                    }
                },function(){
                    countdown = 0;
                    //setGetCodeBtn();
                },'post');
        }
    });
});