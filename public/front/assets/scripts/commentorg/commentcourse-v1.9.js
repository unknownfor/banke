/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    window.addLoadingImg();
    window.addTip();

    showStars();

    /*
     * 机构评分星星*/
    function showStars () {
        var  star = $('.star').attr('data-grade-total'),
            str;
        str = '<span class="rightItem starsCon">' + getStarInfoByScore(star) + '</span>';
        $(".star").html(str);
    };



});