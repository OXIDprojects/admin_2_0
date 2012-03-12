<?php
global $rc;
        ?>
        <div class="chart">
            <script type="text/javascript">
                var chart;
                            

                var chartData = <?php echo json_encode($rc->getData($info->DataUrl)) ?>;

                AmCharts.ready(function () {
                    // SERIAL CHART
                    chart = new AmCharts.AmSerialChart();
                    chart.dataProvider = chartData;
                    chart.categoryField = "Category";
                    // the following two lines makes chart 3D
                    chart.depth3D = 20;
                    chart.angle = 30;

                    // AXES
                    // category
                    var categoryAxis = chart.categoryAxis;
                    categoryAxis.labelRotation = 90;
                    categoryAxis.dashLength = 5;
                    categoryAxis.gridPosition = "start";

                    // value
                    var valueAxis = new AmCharts.ValueAxis();
                    valueAxis.dashLength = 5;
                    chart.addValueAxis(valueAxis);

                    // GRAPH            
                    var graph = new AmCharts.AmGraph();
                    graph.valueField = "Value";
                    graph.colorField = "color";
                    graph.balloonText = "[[category]]: [[value]]";
                    graph.type = "column";
                    graph.lineAlpha = 0;
                    graph.fillAlphas = 1;
                    chart.addGraph(graph);

                    // WRITE
                    chart.write("chartdiv");
                });
            </script>

            <h3><?php echo $info->Title ?></h3>
            <p>
        <?php echo $info->Description ?>
            </p>
            <div id="chartdiv" style="width: <?php echo $info->Width ?>; height: <?php echo $info->Height ?>;"></div>
        </div>