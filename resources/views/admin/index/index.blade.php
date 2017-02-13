@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/dashboard/fonticon/iconfont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/dashboard/dashboard.css')}}">
@endsection

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('admin')}}">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>控制台</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->


<div class="table-box">
    <div class="head-title">
        <i class="iconfont icon-itotal"></i>
        <span>基本概括</span>
    </div>
    <div class="table-main">
       <div>
           <div>总用户数</div>
           <div>0</div>
       </div>
        <div>
           <div>总预约人数</div>
           <div>0</div>
       </div>
        <div>
           <div>总报名人数</div>
           <div>0</div>
       </div>
        <div>
           <div>总打卡次数</div>
           <div>1110</div>
       </div>
    </div>
</div>

<div class="table-box">
    <div class="head-title">
        <i class="iconfont icon-data"></i>
        <span>今日数据</span>
    </div>
    <div class="table-main">
        <table class="table table-striped table-hover table-checkable dataTable no-footer">
            <thead>
                <th class="col-md-2"></th>
                <th class="col-md-2">新增注册人数</th>
                <th class="col-md-2">预约人数</th>
                <th class="col-md-2">报名人数</th>
                <th class="col-md-2">打卡人数</th>
            </thead>
            <tbody>
                <tr class="">
                    <td>今日</td>
                    <td>21123</td>
                    <td>3331</td>
                    <td>1254</td>
                    <td>96523</td>
                </tr>
                <tr>
                    <td>昨日</td>
                    <td>95212</td>
                    <td>856</td>
                    <td>9651</td>
                    <td>1245</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="table-box">
    <div class="head-title">
        <i class="iconfont icon-data"></i>
        <span>报名人数</span>
    </div>
    <div class="table-main">
        <div id="main-signin"  style="width:1039px;height: 400px"></div>
    </div>
</div>

<div class="margin-top-40">
    <div id="main"  style="width:1039px;height: 400px"></div>
</div>

@endsection

@section('js')
<script src="{{asset('backend/plugins/echarts/echarts.min.js')}}"></script>
    <script>
        var myChart = echarts.init(document.getElementById('main'));
        option = {
            title : {
                text: 'LAdmin网站用户访问来源',
                subtext: '纯属虚构',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
            },
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        {value:335, name:'直接访问'},
                        {value:310, name:'邮件营销'},
                        {value:234, name:'联盟广告'},
                        {value:135, name:'视频广告'},
                        {value:1548, name:'搜索引擎'}
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);

        //报名人数
        var myChart = echarts.init(document.getElementById('main-signin')),
        signInOption = {
            title: {
                text: '未来一周气温变化',
                subtext: '纯属虚构'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:['最高气温','最低气温']
            },
            toolbox: {
                show: true,
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    dataView: {readOnly: false},
                    magicType: {type: ['line', 'bar']},
                    restore: {},
                    saveAsImage: {}
                }
            },
            xAxis:  {
                type: 'category',
                boundaryGap: false,
                data: ['周一','周二','周三','周四','周五','周六','周日']
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: '{value} °C'
                }
            },
            series: [
                {
                    name:'最高气温',
                    type:'line',
                    data:[11, 11, 15, 13, 12, 13, 10],
                    markPoint: {
                        data: [
                            {type: 'max', name: '最大值'},
                            {type: 'min', name: '最小值'}
                        ]
                    },
                    markLine: {
                        data: [
                            {type: 'average', name: '平均值'}
                        ]
                    }
                },
                {
                    name:'最低气温',
                    type:'line',
                    data:[1, -2, 2, 5, 3, 2, 0],
                    markPoint: {
                        data: [
                            {name: '周最低', value: -2, xAxis: 1, yAxis: -1.5}
                        ]
                    },
                    markLine: {
                        data: [
                            {type: 'average', name: '平均值'},
                            [{
                                symbol: 'none',
                                x: '90%',
                                yAxis: 'max'
                            }, {
                                symbol: 'circle',
                                label: {
                                    normal: {
                                        position: 'start',
                                        formatter: '最大值'
                                    }
                                },
                                type: 'max',
                                name: '最高点'
                            }]
                        ]
                    }
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(signInOption);
    </script>
@endsection

