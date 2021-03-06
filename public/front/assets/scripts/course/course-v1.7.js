/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    var href = window.location.href;
    var notFromApp = href.indexOf('share') >= 0;  //是否来源于app

    judgeTheUserType();

    //点击弹出拨打电话框，判断来源是否是分享页
    $(document).on( window.eventName,'.address-call', function() {
        if (!notFromApp) {
            //调用客户端拨打电话方法
            showCallNumber();
        }else {
            $('.call-mask').removeClass('hide').addClass('show');
        }
    });

    //预约报名
    $(document).on( window.eventName,'#join-btn', function() {
        if (!notFromApp) {
            //调用客户端拨打电话方法
            showSignInBox();
        }
    });


    //更多校区
    $(document).on( window.eventName,'.more-school', function() {
        if (!notFromApp) {
            //调用客户端
            showMoreSchool();
        }
    });


    $(document).on(window.eventName,function(e){
        toHideMask(e);
    });


    /*
    * 判断类型是招生老师或者机构账户则不显示立即参团
    * $currentUserType 为3或者4
    * */
    function judgeTheUserType() {
        var type = $('.head').attr('data-type');
        var str ='<div id="join-btn">立即参团</div>';
        if (type!= 3 && type != 4) {
            $('.join-right').html(str);
        }
    };


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


    //调用客户端方法,显示预约框
    function showSignInBox(){
        if (window.deviceType.mobile) {
            if (this.deviceType.android) {
                //如果方法存在
                if (typeof AppFunction != "undefined"&&  typeof AppFunction.beginEnrollCourse !='undefined') {
                    AppFunction.beginEnrollCourse(); //调用app的方法，得到用户的基体信息
                }
            }
            else {
                //如果方法存在
                if (typeof beginEnrollCourse != "undefined") {
                    beginEnrollCourse();//调用app的方法，得到电话
                }
            }
        }
    };

    //调用客户端方法，显示更多校区
    function showMoreSchool(){
        var courseId = $('.head').attr('data-course-id'),
            orgId = $('.head').attr('data-org-id');
        if (window.deviceType.mobile) {
            if (this.deviceType.android) {
                //如果方法存在
                if (typeof AppFunction != "undefined"&&  typeof AppFunction.showMoreOrganizationBranch !='undefined') {
                    AppFunction.showMoreOrganizationBranch(orgId); //调用app的方法，得到用户的基体信息
                }
            }
            else {
                //如果方法存在
                if (typeof showMoreOrganizationBranch != "undefined") {
                    showMoreOrganizationBranch(orgId);//调用app的方法，得到电话
                }
            }
        }
    };

});