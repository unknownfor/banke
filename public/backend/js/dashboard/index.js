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

        //this.getData(){}
        // 使用刚指定的配置项和数据显示图表。
        this.initChart(this.options.id).setOption(registerOption);//报名人数
    },
    getDate:function(){

        //上周
        //var time=new Date(),
        //    diffNumber=time.getDay(),
        //    date1=new Date(time-diffNumber*24*60*60*1000),
        //    date2=new Date(time-((6+diffNumber)*24*60*60*1000));
        //return date2.format('yyyy-MM-dd')+'—'+date1.format('yyyy-MM-dd');

        //过去7天
        var time=new Date(),
            time1=new Date(time-6*24*60*60*1000);
        return time1.format('yyyy-MM-dd')+'—'+time.format('yyyy-MM-dd');
    },

    setUpChartBasicInfo:function(){
        var option = {
            title: {
                text: this.options.title,
                subtext: this.getDate()
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

$(function(){

    //刷新课程列表
    getTotalData();
    function getTotalData(){
        var url='/admin/dashboard/gettotaldata',
            paraData={},
            that=this;
        getDataAsync(url,paraData,function(res){
            fillInTotalData(res);
            //fillInChartData(res);
        });
    };


    function fillInTotalData(res){
        var totalData=res[0].total,
            todayData=res[1].today,
            yesterdayDay=res[2].yesterday;
        var $val=$('.total-val');
        for(var i=0;i<totalData.length;i++){
            $val.eq(i).text(totalData[i]);
        }

        var $todayTr=$('.today-tr td');
        for(var i=0;i<todayData.length;i++){
            $todayTr.eq(i+1).text(todayData[i]);
        }

        var $yesterdayTr=$('.yesterday-tr td');
        for(var i=0;i<yesterdayDay.length;i++){
            $yesterdayTr.eq(i+1).text(yesterdayDay[i]);
        }
    }

    function fillInChartData(res){
        //注册人数
        new dashBoard({
            id:'main-register',
            title:'七日注册人数变化',
            xAxix:['周一','周二','周三','周四','周五','周六','周日'],
            yData:[11, 11, 15, 13, 12, 13, 10],
            yStyle:{symbolColor:'#c23531',lineColor:'#c23531'}
        });

        //报名人数
        new dashBoard({
            id:'main-signin',
            title:'七日报名人数变化',
            xAxix:['周一','周二','周三','周四','周五','周六','周日'],
            yData:[11, 11, 15, 13, 12, 13, 10],
            yStyle:{symbolColor:'#d48265',lineColor:'#d48265'}
        });

        //打卡人数
        new dashBoard({
            id:'main-clock',
            title:'七日打卡人数变化',
            xAxix:['周一','周二','周三','周四','周五','周六','周日'],
            yData:[11, 11, 15, 13, 12, 13, 10],
            yStyle:{symbolColor:'#61A0A8',lineColor:'#61A0A8'}
        });
        //预约人数
        new dashBoard({
            id:'main',
            title:'七日预约人数变化',
            xAxix:['周一','周二','周三','周四','周五','周六','周日'],
            yData:[11, 11, 15, 13, 12, 13, 10],
            yStyle:{symbolColor:'#de9325',lineColor:'#de9325'}
        });
    }

    //请求数据
    function getDataAsync(url,data,callback,type){
        type = type ||'get';
        data._token=$('input[name="_token"]').val();
        $.ajax({
            type:type,
            url:url,
            data:data,
            success:function(res){
                callback && callback(res);
            }
        });
    }

});
