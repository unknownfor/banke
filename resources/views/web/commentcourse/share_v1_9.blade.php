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
    <link type="text/css" href="/front/assets/css/commentcourse/v1.9/commentcourse.css" rel="stylesheet">
    <link type="text/css" href="/front/assets/css/commentcourse/v1.9/iconfont/iconfont.css" rel="stylesheet">
    <title>课程评价分享</title>
</head>
<body>
    <div id="courseComment" data-type-id="{{$shareInfo['type_id']}}">
        <div class="headBox container">
            <img class="headImg" src="http://pic.hisihi.com/2016-05-19/1463654400267875.png"/>
            <div class="headName">分享者的名字哈哈哈哈哈哈哈哈哈哈</div>
            <div class="headName">
                <p>我在“<span>武汉仁和会计中南校区</span>”学习</p>
                <p>通过半课累计领取<span>300</span>元现金</p>
            </div>
        </div>
        <div class="courseBox container">
            <div class="courseInfo">
                <div class="courseLeft">
                    <img class="courseImg" src="http://pic.hisihi.com/2016-05-19/1463654396285620.png" />
                </div>
                <div class="courseMiddle">
                    <div class="courseName">课程名称课程名称课程名称课程名称</div>
                    <div class="courseSchool">课程所属培训机构的校区名称</div>
                    <div class="courseAppoint">预约数:<span>36000</span></div>
                </div>
                <div class="courseRight">
                    <div class="realPrice">￥折扣后的的价格</div>
                    <div class="furtherPrice">￥折扣前的的价格</div>
                </div>
            </div>
        </div>
        <div class="commentBox container">
            <div class="title">
                <div class="titleTxt">课程打分</div>
                <div class="star" data-grade-total="5"></div>
            </div>
            <div class="comment">
                <div class="tips">
                    <span>优势标签</span>
                    <span>优势标签</span>
                    <span>优势标签</span>
                    <span>优势标签</span>
                </div>
                <div class="txt">课程评价课程评价课程评价课程评价课程评价课程评价</div>
                <div class="org-album-pre">
                    <ul class="org-album">
                        <li class="album-li">
                            <a href="http://pic.hisihi.com/2016-11-23/1479894836035810.jpg" data-size="400x500"></a>
                            <img src="http://pic.hisihi.com/2016-11-23/1479894836035810.jpg" >
                        </li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>

        </div>
        <div class="joinBox container">
            <div class="angle">
                <img src="/front/assets/img/commentcourse/tangle.png" />
            </div>
            <div class="slogen">
                <img src="/front/assets/img/commentcourse/slogen.png" />
            </div>
            <div class="joinTxt">
                <div class="txtOne">你想要的优质机构都在这里</div>
                <div class="txtTwo">仁和会计、韦伯英语、汇众教育、朗阁外语、天马驾校、蓝鸥IT、奇天插画</div>
            </div>
            <div class="joinTxt">
                <div class="txtOne">超多品类任你选</div>
                <div class="txtTwo">设计、外语、IT、考研、留学、美术、音乐、驾考、健身、少儿培训</div>
            </div>
            <div class="txtSlogen">快来和“<span>分享者</span>”一起参加，每天签到领学费吧</div>
            <div class="input">
                <input class="phone" type="number" placeholder="输入手机号" />
            </div>
            <div class="btn"><span class="downBtn">我也要领学费</span></div>
        </div>
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