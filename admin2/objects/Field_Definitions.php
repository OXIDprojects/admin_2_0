<?php
	class Field_Definitions
	{
		static function renderItems($info)
		{
		
			foreach($info->Items as $obj)
				{
					$func = ucfirst($obj->Type);
					Field_Definitions::$func($obj);
				}
		}

		static function Panel($info)
		{
?>
				<section id="" class="listentry <?php echo (isset($info->Width))? "grid_".$info->Width:"" ?>">
				<header class="panelHead<?php echo (isset($info->Active) && $info->Active)?" open":"" ?>"><?php echo $info->Title ?></header>
				<section >

				<?php

					Field_Definitions::renderItems($info); 
				
				?>
				</section>
				</section>
				<?php

		}
		
		static function Columns($info)
		{
			?>
			<div class="container_16">
			<?php
					Field_Definitions::renderItems($info);
			?>
			
			<div class="clearfix"></div>
			</div>
			
			<?php
		}
		
		static function Column($info)
		{
		?>
			<div class="<?php echo (isset($info->Width))? "grid_".$info->Width:"" ?>">
			<?php Field_Definitions::renderItems($info) ?>
			</div>
			<?php
		}
		
		static function Text($info)
		{
			?>
				<p><?php echo $info->Text ?></p>
			<?php
		}
		
		static function Textbox($info)
		{
			?>
			<div>

			<Label class="input" for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
				<input id="<?php echo $info->Id ?>" Type="text" value="<?php echo (isset($info->value))? $info->value:"" ?>" />
			</div>
			<?php
		}
		static function Image($info)
		{
				?>
				<image src="<?php echo $info->Source ?>" title="<?php echo (isset($info->Label))? $info->Label:"" ?>" />
				<?php
		}

		static function Map($info)
		{
			?>
			<div>

			<Label class="input" for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
				<div id="<?php echo $info->Id ?>">I will show a Map with the Coordinates: <?php echo $info->coords[0]."; ".$info->coords[1] ?></div>
			</div>
			<?php
		}

		static function Br($info)
		{
			?><br/><?php
		}
		
		static function Line($info)
		{
			?><hr/><?php
		}
		static function Youtube($info)
		{
		?>
		<iframe width="<?php echo $info->Width ?>" height="<?php echo $info->Height ?>" src="<?php echo $info->Source ?>" frameborder="0" allowfullscreen></iframe>
		<?php
		}
		static function Numberbox($info)
		{
			?>
			<div>
			<Label class="input" for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
				<input id="<?php echo $info->Id ?>" Type="number" value="<?php echo (isset($info->Value))? $info->Value:"" ?>" />
			</div>
			<?php
		}

		static function Datepicker($info)
		{
			?>
			<div>

			<Label class="input" for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
				<input id="<?php echo $info->Id ?>" type="date" value=""/>
			</div>
			<script>
			$(function(){
				$("input[type='date']").datepicker({
				dateFormat: "dd.mm.yy",
				altFormat: 'yy-mm-dd'
				<?php
				echo (isset($info->MinDate))?",minDate: new Date('{$info->MinDate}')":""; 
				echo (isset($info->MaxDate))?",minDate: new Date('{$info->MaxDate}')":""; 
				?>
				}).datepicker('setDate', '<?php echo $info->Date ?>'); 
				})
			</script>
			<?php
		}

		static function Chart($info)
		{
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
			<?php
		}

		static function Textarea($info)
		{
			?>
			<div class="textarea">

			<Label for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
				<textarea id="<?php echo $info->Id ?>" Type="text" >
					<?php echo ($info->value)? $info->value:"" ?>
					</textarea>
			</div>
			
			<?php
			if($info->rte)
			{
				Field_Definitions::getTinyMceScript($info);
			}
		}
		
		static function TinyMceScript($info)
		{
			
		}

		static function Checkbox($info)
		{
			?>
			<div class="checkbox">

			<Label for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
				<input id="<?php echo $info->Id ?>" Type="checkbox" />
			</div>
			<?php
		}
		
		static function Select($info)
		{
			?>
			<div class="select">

			<Label for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
				<select id="<?php echo $info->Id ?>" Type="checkbox" >
				<?php 
				foreach($info->option as $option => $value)
				{
				?>
				<option value="<?php echo $value ?>"> <?php echo $option ?><option>
				<?php
				}
					?>
				</select>
			</div>
			<?php
		}
		
		static function Splitbutton($info)
		{
			?>
			<div class="splitbutton">

			<Label for="<?php echo $info->Id ?>"><?php echo $info->Label ?></Label>
				<input class="ui-icon" id="<?php echo $info->Id ?>" Type="button" />
			</div>
			<?php
		}
		
		static function Imagebutton($info)
		{
			?>
			<div class="imagebutton">
				<input id="button_<?php echo $info->Id ?>" Type="checkbox" value="<?php echo $info->Label ?>"/>
			</div>
			<script>
				$(function(){ 
					$("#button_<?php echo $info->Id ?>").button({icons:{primary: "ui-icon-<?php echo $info->icon ?>"}});
					});
			</script>
			<?php
		}

		static function Datagrid($info)
		{
			?>
			<div class="datagrid">

			<h3><?php echo $info->Label ?></h3>
			<table id="table_<?php echo $info->Id ?>">
			<thead>
			<tr>
			
				<?php
				foreach($info->Fields as $field)
				{
				?>
				<th><?php echo $field->Label ?></th>
				<?php
				}
				?>
				</tr>
				</thead>
				<tbody>
				<?php
				global $rc; 
				$data = $rc->getData($info->dataUrl);
				$data = $data;
				foreach($data as $row)
				{
					?>
					<tr>
					<?php
					foreach($row as $cell)
					{
					?>
						<td><?php echo $cell ?></td>
					<?php
					}
					?>
					</tr>
					<?php
				}
				?>
				</tbody>
				</table>
				<script>
				  $('#table_<?php echo $info->Id ?>').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
				</script>
			</div>
			<?php
		}
	}
?>