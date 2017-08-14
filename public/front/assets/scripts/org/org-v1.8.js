/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    var href = window.location.href;
    var notFromApp = href.indexOf('share') >= 0;  //是否来源于app


    /*
    * 机构评分星星*/



    /*电话咨询-判断来源是否是分享页*/
    $(document).on( window.eventName,'.address-right', function() {
        if (!notFromApp) {
            //调用客户端拨打电话方法
            showCallNumber();
        }else {
            $('.call-mask').removeClass('hide').addClass('show');
        }
    });

    /*点击查看更多机构简介*/
    $(document).on( window.eventName,'#btn-intro', function() {
        showMoreIntroInfo();
    });

    /*点击查看更多课程简介*/
    $(document).on( window.eventName,'#btn-course', function() {
        showMoreCourseInfo();
    });

    /*点击查看更多老师简介*/
    $(document).on( window.eventName,'#btn-teacher', function() {
        showMoreTeacherInfo();
    });


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


    function showMoreIntroInfo () {
        var box=$('#full-intro'),
            btn=$('#btn-intro');
        box.removeClass('half');
        btn.addClass('hide');
    }

    function showMoreCourseInfo() {
        var box=$('#full-course'),
            btn=$('#btn-course');
        box.removeClass('half');
        btn.addClass('hide');
    }

    function showMoreTeacherInfo() {
        var box=$('#full-teacher'),
            btn=$('#btn-teacher');
        box.removeClass('half');
        btn.addClass('hide');
    }

});