/**
 * Created by hisihi on 2017/4/13.
 */
$(function() {

    var href = window.location.href;
    var isFromApp = href.indexOf('banke-app') >= 0;  //�Ƿ���Դ��app

    //�����������绰���ж���Դ�Ƿ��Ƿ���ҳ
    $(document).on( window.eventName,'.address-call', function() {
        if (isFromApp) {
            //���ÿͻ��˲���绰����
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

    //���𲦴�绰����
    function hideAndShow(flag){
        var $target=$('.call-mask');
        if(flag){
            $target.removeClass('hide').addClass('show');
        }else {
            $target.removeClass('show').addClass('hide');
        }
    };



    //���ÿͻ��˷���,��ʾ����绰
    function showCallNumber(){
        if (window.deviceType.mobile) {
            if (this.deviceType.android) {
                //�����������
                if (typeof AppFunction != "undefined"&&  typeof AppFunction.callServicePhone !='undefined') {
                    AppFunction.callServicePhone(); //����app�ķ������õ��û��Ļ�����Ϣ
                }
            }
            else {
                //�����������
                if (typeof callServicePhone != "undefined") {
                    callServicePhone();//����app�ķ������õ��绰
                }
            }
        }

    };
});