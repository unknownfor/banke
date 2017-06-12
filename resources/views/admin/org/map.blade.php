<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=kbIUCIpdrQ7eikx2n9a4cU33"></script>
    <title>地图展示</title>
</head>
<body>
<div id="allmap"></div>
</body>
<script type="text/javascript">
    var map = new BMap.Map("allmap");

    // 创建标注
    // 将标注添加到地图中
    //    map.centerAndZoom(new BMap.Point(114.313332,30.503007), 15);  //114.328639,30.477551

    map.setCurrentCity("武汉");          // 设置地图显示的城市 此项是必须设置的
    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放

    //单击获取点击的经纬度
    map.addEventListener("click",function(e){
        var lon=e.point.lng;
            lat=e.point.lat;
        top.window.setLonLatInfo({lon:lon,lat:lat});

        map.clearOverlays();
        var point = new BMap.Point(lon, lat);
        var marker = new BMap.Marker(point);
        map.addOverlay(marker);
    });

    window.resetLocation=function(lon,lat){
        // 将标注添加到地图中
//        var point = new BMap.Point(114.328926,30.477427);
        if(lon!=0 && lat!=0) {
            var point = new BMap.Point(lon, lat);
            var marker = new BMap.Marker(point);
            map.addOverlay(marker);
            map.centerAndZoom(new BMap.Point(lon, lat), 17);  //114.328639,30.477551
        }else{
            map.centerAndZoom(new BMap.Point(114.337348,30.539705), 15);  //114.328639,30.477551
        }
    };

</script>
</html>
