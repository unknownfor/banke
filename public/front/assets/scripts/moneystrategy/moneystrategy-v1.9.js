/**
 * Created by hisihi on 2017/7/3.
 */
$(function() {

    //浏览量
    viewCounts();

    /*
     * 调用浏览量接口
     typeId  表示页面类型
     1 课程页面
     2 表示机构页面
     3 表示团购页面
     4 表示免费学和赚钱攻略页面
     id   表示记录id
     * */
    function viewCounts() {
        var box = $('#article'),
            typeId = box.attr('data-type-id'),
            id = box.attr('data-id'),
            url = '/v1.5/share/updateviewcounts',
            data = {
                typeid: typeId,
                id: id
            }
        getDataAsync(url, data, function () {

        }, null, 'post');
    };

});