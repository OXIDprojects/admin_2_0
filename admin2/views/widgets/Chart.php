<?php

/**
 * Generates Charts
 * @author Rafael Dabrowski
 */
class Chart extends Widget
{

    public $Title = "";
    public $Id = 0;
    public $Description = "";
    public $Data = "";
    public $DataUrl = "";
    public $Width = "400";
    public $Height = "400";
    protected $_output = "";
    protected $_chartData = "[]";

    public $bHasJs = true;
    public $bHasJsDoc = true;

    public $jsLibs = array("raphael", "amcharts");

    public function __construct($oData)
    {
        parent::__construct($oData);
        $this->getChartData();
        $this->generateOutput();
    }

    /**
     * Generates Chartdate from DataSoruce or provided Data
     * @return void
     */
    protected function getChartData()
    {
        if ($this->Data != "")
        {
            $this->_chartData = $this->Data;
            return;
        } else if ($this->DataUrl != "")
        {
            $restClient = new Rest_Client();
            $this->_chartData = json_encode($restClient->getData(($this->DataUrl)));
            return;
        }
        $this->_chartData = "[]";
    }

    /**
     * Generates HTML Output und stores it in _output
     */
    public function generateOutput()
    {
        ob_start();
        ?>
        <div class="chart">
            <h3><?php echo $this->Title ?></h3>

            <p>
        <?php echo $this->Description ?>
            </p>

            <div id="chartdiv" style="width: <?php echo $this->Width ?>; height: <?php echo $this->Height ?>;"></div>
        </div>


        <?php
        $this->_output = ob_get_clean();
    }

    public function output()
    {
        return $this->_output;
    }

    public function getJsDocReady()
    {
        ob_start();
        ?>
                var chart;
                var chartData = <?php echo $this->_chartData ?>;

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
                <?php
                return ob_get_clean();
    }

}
