<?php
	class Field_Definitions
	{
		static function renderSite($info)
		{
			?>
			<h1><?php echo $info->label ?></h1>
			<div class="panels">
			<?php
			foreach($info->panels as $panel)
			{
				?>
				<div class="panel">
				<h3 class="panelHead"><?php echo $panel->label ?></h3>
				<div class="panelContent <?php echo ($panel->active)?"hide":"" ?>">

				<?php
				foreach($panel->fields as $obj)
				{
					$func = "get".ucfirst($obj->type);
					Field_Definitions::$func($obj);
				}
				?>
				</div>
				</div>
				<?php
			}
			?>
			</div>
			<?php
		}

		static function getText($info)
		{
			?>
			<div>

			<label for="<?php echo $info->id ?>"><?php echo $info->label ?></label>
				<input id="<?php echo $info->id ?>" type="text" />
			</div>
			<?php
		}

		static function getMap($info)
		{
			?>
			<div>

			<label for="<?php echo $info->id ?>"><?php echo $info->label ?></label>
				<div id="<?php echo $info->id ?>">I will show a Map with the Coordinates: <?php echo $info->coords[0]."; ".$info->coords[1] ?></div>
			</div>
			<?php
		}

		static function getNumber($info)
		{
			?>
			<div>
			<label for="<?php echo $info->id ?>"><?php echo $info->label ?></label>
				<input id="<?php echo $info->id ?>" type="number" />
			</div>
			<?php
		}

		static function getDatepicker($info)
		{
			?>
			<div>

			<label for="<?php echo $info->id ?>"><?php echo $info->label ?></label>
				<input id="<?php echo $info->id ?>" type="date" />
			</div>
			<?php
		}

		static function getBarchart($info)
		{
			?>
			<div>

			<label for="<?php echo $info->id ?>"><?php echo $info->label ?></label>
				<input id="<?php echo $info->id ?>" type="text" value="i am a barchart" />
			</div>
			<?php
		}

		static function getTextarea($info)
		{
			?>
			<div class="textarea">

			<label for="<?php echo $info->id ?>"><?php echo $info->label ?></label>
				<textarea id="<?php echo $info->id ?>" type="text" ></textarea>
			</div>
			<?php
		}

		static function getCheckbox($info)
		{
			?>
			<div class="checkbox">

			<label for="<?php echo $info->id ?>"><?php echo $info->label ?></label>
				<input id="<?php echo $info->id ?>" type="checkbox" />
			</div>
			<?php
		}

		static function getDatagrid($info)
		{
			?>
			<div class="datagrid">

			<label for="<?php echo $info->id ?>"><?php echo $info->label ?></label>
			<table>
			<tr>
				<?php
				foreach($info->fields as $field)
				{
				?>
				<th><?php echo $field ?></th>
				<?php
				}
				?>
				</tr>
				</table>
			</div>
			<?php
		}

	}
?>