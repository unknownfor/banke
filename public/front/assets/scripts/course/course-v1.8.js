/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    var href = window.location.href;
    var notFromApp = href.indexOf('share') >= 0;  //是否来源于app

    showStars();

    /*
     * 机构评分星星*/
    function showStars () {
        var  star = $('.org-stars').attr('data-grade-total'),
            str;
        str = '<span class="rightItem starsCon">' + getStarInfoByScore(star) + '</span>';
        $(".org-stars").html(str);
    };


    /*
    * 点击查看分期说明*/
    $(document).on( window.eventName,'#help-img', function() {
        $('.installment').removeClass('hide').addClass('show');
     });

    /*
    * 点击关闭分期说明弹窗*/
    $(document).on( window.eventName,'.close-btn', function(e) {
        $('.installment').addClass('hide').removeClass('show');
    });

    /*
     * 点击蒙板关闭*/
    $(document).on( window.eventName,'.installment', function(e) {
        window.toHideModuleByClickOutside(e,function () {
            $('.installment').addClass('hide').removeClass('show');
        });
    });

    /*点击切换机构特色*/
    $(document).on( window.eventName,'#special', function() {
        showSpecialInfo();
    });

    /*点击切换机构评价*/
    $(document).on( window.eventName,'#evaluate', function() {
        showEvaluateInfo();
    });

    /*点击切换课程详情*/
    $(document).on( window.eventName,'#detail', function() {
        showDetailInfo();
    });


    /*电话咨询-判断来源是否是分享页*/
    $(document).on( window.eventName,'#phone', function() {
        if (!notFromApp) {
            //调用客户端拨打电话方法
            showCallNumber();
        }else {
            $('.call-mask').removeClass('hide').addClass('show');
        }
    });


    /*切换机构特色内容*/
    function showSpecialInfo () {
        $('#special').addClass('selected');
        $('#detail').removeClass('selected');
        $('#evaluate').removeClass('selected');
        $('.special-info').removeClass('hide');
        $('.detail-info').addClass('hide');
        $('.evaluate-info').addClass('hide');
    }

    /*切换机构评价*/
    function showEvaluateInfo () {
        $('#special').removeClass('selected');
        $('#detail').removeClass('selected');
        $('#evaluate').addClass('selected');
        $('.special-info').addClass('hide');
        $('.detail-info').addClass('hide');
        $('.evaluate-info').removeClass('hide');
    }

    /*切换课程详情*/
    function showDetailInfo () {
        $('#special').removeClass('selected');
        $('#detail').addClass('selected');
        $('#evaluate').removeClass('selected');
        $('.special-info').addClass('hide');
        $('.detail-info').removeClass('hide');
        $('.evaluate-info').addClass('hide');
    }


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

    //点击关闭拨打电话弹窗
    $(document).on( window.eventName,'.quite', function() {
        var $target=$('.call-mask');
        $target.removeClass('show').addClass('hide');
    });




});