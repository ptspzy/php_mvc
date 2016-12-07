<?php
/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-11-30
 * Time: 下午6:05
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
    var datas = <?php echo $chapters ?>;

    $(function () {

        var chapterNames = [];
        var data = [];
        var hours = ['12a', '1a', '2a', '3a', '4a', '5a', '6a', '7a', '8a', '9a', '10a', '11a', '12p', '1p', '2p', '3p', '4p', '5p', '6p', '7p', '8p', '9p', '10p', '11p'];;

        datas.forEach(function (chapter, index) {
            var tempData = [];

            chapterNames.push(chapter.name);

            chapter.data.forEach(function (info) {

                tempData.push(index);
                tempData.push(index);
                tempData.push(info.num);
                data.push(tempData);
            });
        });

        // 始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        option = {
            tooltip: {
                position: 'top'
            },
            dataZoom: {
                show: true,
                realtime: true,
                start: 20,
                end: 80
            },
            animation: false,
            grid: {
                height: '50%',
                y: '10%'
            },
            xAxis: {
                type: 'category',
                data: hours
            },
            yAxis: {
                type: 'category',
                data: chapterNames
            },
            visualMap: {
                min: 1,
                max: 10,
                calculable: true,
                orient: 'horizontal',
                left: 'center',
                bottom: '15%'
            },
            series: [{
                name: 'Punch Card',
                type: 'heatmap',
                data: data,
                label: {
                    normal: {
                        show: true
                    }
                },
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };


        myChart.setOption(option);

    })

</script>
</body>
</html>
