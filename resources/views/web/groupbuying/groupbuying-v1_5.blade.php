<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Resource-type" content="Document">
    <!--禁止缩放-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--禁止数字识别为手机号-->
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <link type="text/css" href="/front/assets/css/course/v1.2/course.css" rel="stylesheet">
    <title></title>
</head>
<body>
{{--{!! csrf_field() !!}--}}
开团

</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script>
    $(function() {

        $.get('http://b.cn/bankehome/token', null, function (result) {
            result;
            var data = {
                '_token': result,
                'city': '武汉',
                'name': '相信机构123',
                'contact': '李某栽',
                'tel_phone': '198987666',
                'address': '南湖大道123',
                'introduce': '123132123',
            }
            $.ajax({
                type: 'post',
                url: 'http://b.cn/bankehome/addorgapplyfor',
                data: data,
                success: function (res) {
                   res;
                },
                error: function () {
                    //请求出错处理
                    window.controlLoadingBox(false),
                            window.showTips('操作失败');
                }
            });
        });
    });
</script>
</html>