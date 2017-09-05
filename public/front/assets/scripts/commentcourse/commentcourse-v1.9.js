/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    window.addLoadingImg();
    window.addTip();

    showStars();
    viewCounts();

    /*
     * 机构评分星星*/
    function showStars () {
        var  star = $('.star').attr('data-grade-total'),
            str;
        str = '<span class="rightItem starsCon">' + getStarInfoByScore(star) + '</span>';
        $(".star").html(str);
    };


    /*检测手机号码合法性
     * 填写手机号
     * 输入框变色，按钮变色*/
    $(document).on('input', '.phone', function(){
        //页面禁止滚动
        window.scrollControl(false);
        var number=$(this).val(),
            reg = /^1(3|4|5|7|8)\d{9}$/;
        var $btn=$('.downBtn');
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

    $(document).on(window.eventName,'.downBtn.active', function () {
        window.controlLoadingBox(true);
        var url='/v1.8/share/freestudysignup',
            id=$('#courseComment').attr('data-id'),
            mobile = $('.phone').val(),
            data={
                courseCommentId:id,
                mobile:mobile
            };
        $(this).removeClass('active');
        getDataAsync(url,data,function(res) {
            //成功返回之后调用的函数
            window.controlLoadingBox(false);
            if (res.status_code == 0) {
                window.showTips('<p>恭喜您，预约成功!</p>',2000);
            }
            else{
                window.showTips(res.msg);
            }
        },function(){
            window.controlLoadingBox(false);
            $(this).addClass('active');
        },'post');
    });


    /*
     * 调用浏览量接口
     typeId  表示页面类型
     1 课程页面
     2 表示机构页面
     3 表示团购页面
     id   表示记录id
     * */
    function viewCounts() {
        var box = $('.comment'),
            typeId = box.attr('data-type-id'),
            id = box.attr('data-record-id'),
            url = '/v1.5/share/updateviewcounts',
            data = {
                typeid: typeId,
                id: id
            }
        getDataAsync(url, data, function () {

        }, null, 'post');
    };

});