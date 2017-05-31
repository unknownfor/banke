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
    <link href="/front/assets/css/orgapplyfor/v1.5/orgapplyfor.css" rel="stylesheet" type="text/css"/>
    <!--图标字体-->
    <link href="/front/assets/css/orgapplyfor/v1.5/iconfont/iconfont.css" rel="stylesheet" type="text/css"/>
    <title>合作入驻</title>
</head>
<body>
{!! csrf_field() !!}
    <div id="orgapplyfor">
        <div class="welcome hide">
            <div class="welcome-img">
                <img  src="/front/assets/img/orgapplyfor/cat.png" />
            </div>
            <div class="welcome-txt">
                <div class="welcome">欢迎您的加入</div>
                <div class="txt">商务人员会马上联系您，喵~</div>
            </div>
            <div class="welcome-btn">好的</div>
        </div>
        <div class="join">
            <div class="join-img">
                <img  src="/front/assets/img/orgapplyfor/img.png" />
            </div>
            <div class="join-txt">
                <p class="title">三步轻松入驻半课</p>
                <div class="join-txt-box">
                    <div class="txt-box">
                        <div class="num">1</div>
                        <div class="txt">填写机构名称及联系方式</div>
                    </div>
                    <i class="iconfont dotted">&#xe603;</i>
                    <div class="txt-box">
                        <div class="num">2</div>
                        <div class="txt">商务合作人员电话联系</div>
                    </div>
                    <i class="iconfont dotted">&#xe603;</i>
                    <div class="txt-box">
                        <div class="num">3</div>
                        <div class="txt">机构课程上架</div>
                    </div>
                </div>

            </div>
            <div class="join-btn"><span>立即入驻</span></div>
        </div>
        <form class="cooperation hide">
            <div class="regbox info">
                <input type="text" placeholder="请输入机构名称" id="name" value="中建三局武昌第二分局"/>
            </div>

            <div class="regbox info">
                <input type="text" placeholder="请输入机构地址" id="address" value="中建三局武昌第二分局"/>
            </div>

            <div class="regbox info">
                <input type="text" placeholder="联系人姓名" id="contact" value="中建三局武昌第二分局"/>
            </div>

            <div class="regbox">
                <input type="text" placeholder="手机号" id="telphone" value="135541543222"/>
            </div>

            <div class="submit-box disabled">
                <div type="submit" class="registered-btn" name="提交信息">提交信息</div>
            </div>
        </form>
    </div>
</body>
<script src="/front/assets/plugins/zepto.min.js"></script>
<script src="/front/assets/plugins/fastclick.js" type="text/javascript"></script>
<script src="/front/assets/plugins/common.js" type="text/javascript"></script>
<script src="/front/assets/scripts/orgapplyfor/orgapplyfor-v1.5.js" type="text/javascript"></script>
</html>