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
    var datas = <?php echo $article ?>;
    console.log(datas);
    var articleNames = [];
    var xAxisShow = [];
    var seriesDatas = [];
    $(function () {

        datas.forEach(function (article) {
            var series = {};
            var seriesData = [];
            var markPoint = {};
            var markPointData = [];


            articleNames.push(article.name);

            article.data.forEach(function (info,index) {
                xAxisShow.push(info.time);
                seriesData.push(info.num);

                //markPoint
                var markPointDataObj = {};
                markPointDataObj.name = "";
                markPointDataObj.value = info.num;
                markPointDataObj.xAxis = index;
                markPointDataObj.yAxis = info.num;
                markPointData.push(markPointDataObj);
            });
            markPoint.data = markPointData;

            series.name = article.name;
            series.type = 'line';
            series.data = seriesData;
            //series.markPoint = markPoint;

            seriesDatas.push(series);
        });
        console.log(seriesDatas);
        // 始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

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
            dataZoom: {
                show: true,
                realtime: true,
                start: 20,
                end: 80
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
