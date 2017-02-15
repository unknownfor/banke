/**
 * Created by jimmy-jiang on 2017/2/14.
 */

var dashBoard=function(options){
    this.options=options;
    this.showChart();
};
dashBoard.prototype={

    initChart:function(){
        return echarts.init(document.getElementById(this.options.id));
    },

    showChart:function(){
        var registerOption = this.setUpChartBasicInfo();
        // 使用刚指定的配置项和数据显示图表。
        this.initChart(this.options.id).setOption(registerOption);//报名人数
    },

    setUpChartBasicInfo:function(title,legendTxt,xAxix,yData,yStyle){
        var option = {
            title: {
                text: this.options.title,
                //subtext: ''
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:['最多人数']
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
                data: this.options.xAxix
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: '{value} 人'
                }
            },
            series: [
                {
                    name:'最高',
                    type:'line',
                    smooth:true,
                    data:this.options.yData,
                    itemStyle:{
                        normal:{
                            color:this.options.yStyle.symbolColor //图标颜色
                        }
                    },
                    lineStyle:{
                        normal:{
                            width:2,  //连线粗细
                            color: this.options.yStyle.lineColor  //连线颜色
                        }
                    },
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
                }
            ]
        };
        return option;
    }

};

function initChart(id){
    return echarts.init(document.getElementById(id));
}

var myChart = initChart('main');
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

//注册人数
new dashBoard({
    id:'main-register',
    title:'最近一周注册人数变化',
    xAxix:['周一','周二','周三','周四','周五','周六','周日'],
    yData:[11, 11, 15, 13, 12, 13, 10],
    yStyle:{symbolColor:'#c23531',lineColor:'#c23531'}
});

//报名人数
new dashBoard({
    id:'main-signin',
    title:'最近一周报名人数变化',
    xAxix:['周一','周二','周三','周四','周五','周六','周日'],
    yData:[11, 11, 15, 13, 12, 13, 10],
    yStyle:{symbolColor:'#d48265',lineColor:'#d48265'}
});

//打卡人数
new dashBoard({
    id:'main-clock',
    title:'最近一周打卡人数变化',
    xAxix:['周一','周二','周三','周四','周五','周六','周日'],
    yData:[11, 11, 15, 13, 12, 13, 10],
    yStyle:{symbolColor:'#61A0A8',lineColor:'#61A0A8'}
});

//刷新课程列表
getTotalData();
function getTotalData(){
    var url='/admin/dashboard/gettotaldata',
        paraData={},
        that=this;
    getDataAsync(url,paraData,function(res){
        var str='',len=res.length;
        console.log(len);
    });
};
//请求数据
function getDataAsync(url,data,callback,type){
    type = type ||'get';
    data._token=$('input[name="_token"]').val();
    $.ajax({
        type:type,
        url:url,
        data:data,
        success:function(res){
            callback(res);
        }
    });
}
