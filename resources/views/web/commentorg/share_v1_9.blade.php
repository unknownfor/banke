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
    <link href="/backend/js/libs/photoswipe/default-skin/photoswipeunion.min.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="/front/assets/css/commentcourse/v1.9/orgcourse.css" rel="stylesheet">
    <link type="text/css" href="/front/assets/css/commentcourse/v1.9/iconfont/iconfont.css" rel="stylesheet">
    <title>机构评论</title>
</head>
<body>
<div class="comment" id="orgComment"
            data-uid="{{$comment['uid']}}"
            data-course-id="{{$comment['course_id']}}"
            data-org-id="{{$comment['org_id']}}"
            data-record-id="{{$comment['id']}}"
            data-type-id="2">
    机构评论
</div>
{{--@include('web.layout.downloadbar')--}}
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/photoswipe.min.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/photoswipe-ui-default.min.js" type="text/javascript"></script>
<script src="/backend/js/libs/photoswipe/myphotoswipe.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/commentcourse/commentcourse-v1.9.js" type="text/javascript"></script>
<script type="text/javascript">
    /*
     * photoswipe
     * */
    new MyPhotoSwipe('.org-album');
</script>
</html>