<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-11-30
 * Time: 下午5:03
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/3.2.3/echarts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 1400px;height:900px;"></div>
<script type="text/javascript">
    $(function () {

        // 始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        //图例，小说名称
        var articleNames = ['小说一', '小说二', '小说三', '小说四'];
        //x轴刻度显示
        var xAxisShow = ['周一', '周二', '周三', '周四', '周五', '周六', '周日'];
        //按天统计某小说
        var seriesDatas = [
            {
                name: '小说一',
                type: 'line',
                data: [98, 90, 85, 70, 85, 85, 72],
                markPoint: {
                    data: [
                        {name: '', value: 98, xAxis: 0, yAxis: 98},
                        {name: '', value: 90, xAxis: 1, yAxis: 90},
                        {name: '', value: 85, xAxis: 2, yAxis: 85},
                        {name: '', value: 70, xAxis: 3, yAxis: 70},
                        {name: '', value: 85, xAxis: 4, yAxis: 85},
                        {name: '', value: 85, xAxis: 5, yAxis: 85},
                        {name: '', value: 72, xAxis: 6, yAxis: 72}
                    ]
                }
            },
            {
                name: '小说二',
                type: 'line',
                data: [80, 82, 82, 65, 83, 85, 78],
                markPoint: {
                    data: [
                        {name: '111', value: 80, xAxis: 0, yAxis: 80},
                        {name: '222', value: 82, xAxis: 1, yAxis: 82},
                        {name: '333', value: 82, xAxis: 2, yAxis: 82},
                        {name: '444', value: 65, xAxis: 3, yAxis: 65},
                        {name: '555', value: 83, xAxis: 4, yAxis: 83},
                        {name: '666', value: 85, xAxis: 5, yAxis: 85},
                        {name: '777', value: 78, xAxis: 6, yAxis: 78}
                    ]
                }
            },
            {
                name: '小说三',
                type: 'line',
                data: [71, 72, 72, 75, 73, 72, 78],
                markPoint: {
                    data: [
                        {name: '', value: 71, xAxis: 0, yAxis: 71},
                        {name: '', value: 72, xAxis: 1, yAxis: 72},
                        {name: '', value: 72, xAxis: 2, yAxis: 72},
                        {name: '', value: 75, xAxis: 3, yAxis: 75},
                        {name: '', value: 73, xAxis: 4, yAxis: 73},
                        {name: '', value: 72, xAxis: 5, yAxis: 72},
                        {name: '', value: 78, xAxis: 6, yAxis: 78}
                    ]
                }

            }, {
                name: '小说四',
                type: 'line',
                data: [61, 62, 72, 55, 63, 72, 80],
                markPoint: {
                    data: [
                        {name: '', value: 61, xAxis: 0, yAxis: 61},
                        {name: '', value: 62, xAxis: 1, yAxis: 62},
                        {name: '', value: 72, xAxis: 2, yAxis: 72},
                        {name: '', value: 55, xAxis: 3, yAxis: 55},
                        {name: '', value: 63, xAxis: 4, yAxis: 63},
                        {name: '', value: 72, xAxis: 5, yAxis: 72},
                        {name: '', value: 80, xAxis: 6, yAxis: 80}
                    ]
                }
            }
        ];

        // 指定图表的配置项和数据
        option = {
            title: {
                text: '小说订阅趋势图',
                subtext: 'subtext'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: articleNames
            },
            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            calculable: true,
            dataZoom : {
                show : true,
                realtime : true,
                start : 20,
                end : 80
            },
            xAxis: [
                {
                    type: 'category',
                    boundaryGap: false,
                    data: xAxisShow
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    axisLabel: {
                        formatter: '{value} '
                    }
                }
            ],
            series: seriesDatas
        };


        myChart.setOption(option);

    })

</script>
</body>
</html>
