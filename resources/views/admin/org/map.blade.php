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
</html>
<script type="text/javascript">
    var map = new BMap.Map("allmap");

    // 创建标注
    var point = new BMap.Point(114.328926,30.477427);
    var marker = new BMap.Marker(point);
    map.addOverlay(marker);              // 将标注添加到地图中
    map.centerAndZoom(new BMap.Point(114.313332,30.503007), 15);  //114.328639,30.477551

    map.setCurrentCity("武汉");          // 设置地图显示的城市 此项是必须设置的
    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放


    ////单击获取点击的经纬度
    map.addEventListener("click",function(e){
        console.log(e.point.lng + "," + e.point.lat);
    });

    var sContent ='<div id="location">'+
            '<span class="mylocation">'+
            '<span class="icon-mapmarker"></span>'+
            '<span class="myPlace">公司地址：</span>'+
            '</span>'+
            '<span class="myAddress">武汉市 洪山区 </span>'+
            '</br>'+
            '<span class="myAddress">野芷湖西路16号创意天地2#高层6F601</span>'+
            '</div>';

    var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
    marker.addEventListener("click", function(){
        map.openInfoWindow(infoWindow,point); //开启信息窗口
    });
</script>