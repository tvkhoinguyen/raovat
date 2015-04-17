
<table style="width: 100%; border-collapse: collapse" border="1" bordercolor="#ccc">
	<thead>
	<td>Column Name</td>
	<td>Required</td>
	<td>Email</td>
	<td>Unique</td>
	<td>Image</td>
	<td>Upload File</td>
	</thead>

<?php
$i=1;
if (!empty($columns)):
foreach ($columns->columns as $column):
	$cssStyle = "border-bottom: solid 1px #ccc;";
	if ($i%2 == 0)
		$cssStyle .= "background-color: #e0e0e0";
	else
		$cssStyle .= "background-color: #FFF";
?>
	<tr style="<?php echo $cssStyle; ?>">
		<td><?php echo $column->name . "(" . $column->dbType . ")"; ?></td>
		<td><input type="checkbox" id="ModelCodeRequired_<?php echo $column->name?>" <?php if (isset($_POST['ModelCodeRequired'][$column->name]) && $_POST['ModelCodeRequired'][$column->name] != "") echo 'checked="true"';?> name="ModelCodeRequired[<?php echo $column->name?>]" value="<?php echo $column->name?>"></td>
		<td>
			<?php if (strpos($column->dbType, 'varchar') !== false):?>
			<input type="checkbox" id="ModelCodeEmail_<?php echo $column->name?>" <?php if (isset($_POST['ModelCodeEmail'][$column->name]) && $_POST['ModelCodeEmail'][$column->name] != "") echo 'checked="true"';?> name="ModelCodeEmail[<?php echo $column->name?>]" value="<?php echo $column->name?>">
			<?php else: echo "&nbsp;";?>
			<?php endif; ?>
		</td>
		<td>
			<input type="checkbox" id="ModelCodeUnique_<?php echo $column->name?>" <?php if (isset($_POST['ModelCodeUnique'][$column->name]) && $_POST['ModelCodeUnique'][$column->name] != "") echo 'checked="true"';?> name="ModelCodeUnique[<?php echo $column->name?>]" value="<?php echo $column->name?>">
		</td>
		<td>
			<?php if (strpos($column->dbType, 'varchar') !== false):?>
			<input type="checkbox" id="ModelCodeImage_<?php echo $column->name?>" <?php if (isset($_POST['ModelCodeImage'][$column->name]) && $_POST['ModelCodeImage'][$column->name] != "") echo 'checked="true"';?> name="ModelCodeImage[<?php echo $column->name?>]" value="<?php echo $column->name?>">
			<?php else: echo "&nbsp;";?>
			<?php endif; ?>
		</td>
		<td>
			<?php if (strpos($column->dbType, 'varchar') !== false):?>
			<input type="checkbox" id="ModelCodeUploadfile_<?php echo $column->name?>" <?php if (isset($_POST['ModelCodeUploadfile'][$column->name]) && $_POST['ModelCodeUploadfile'][$column->name] != "") echo 'checked="true"';?> name="ModelCodeUploadfile[<?php echo $column->name?>]" value="<?php echo $column->name?>">
			<?php else: echo "&nbsp;";?>
			<?php endif; ?>
		</td>
	</tr>

<?php 
$i++;
endforeach ;
endif;
	$cssStyle = "border-bottom: solid 1px #ccc;";
	if (($i+2)%2 == 0)
		$cssStyle .= "background-color: #e0e0e0";
	else
		$cssStyle .= "background-color: #FFF";
?>
	<tr style="<?php echo $cssStyle; ?>">
		<td>Slug Field</td>
		<td colspan="5">
			<select name="slugfield">
				<option value="">Doesn't has</option>
				<?php 
				if (!empty($columns)):
					foreach ($columns->columns as $column)
					{
						if ($column->name != 'slug')
						{
							$check = '';
							if (isset($_POST['slugfield']) && $column->name == $_POST['slugfield'])
								$check = ' selected ';
							echo '<option ' . $check . ' value="' . $column->name . '">' . $column->name . '</option>';
						}
					}
				endif;
				?>
			</select>
		</td>
	</tr>
	<?php 
	$cssStyle = "border-bottom: solid 1px #ccc;";
	if (($i+3)%2 == 0)
		$cssStyle .= "background-color: #e0e0e0";
	else
		$cssStyle .= "background-color: #FFF";
	?>
	<tr style="<?php echo $cssStyle; ?>">
		<td>Default sort field</td>
		<td colspan="5">
			<select name="sortfield">
				<option value="">Doesn't has</option>
				<?php 
				if (!empty($columns)):
					foreach ($columns->columns as $column)
					{
						$check = '';
						if (isset($_POST['slugfield']) && $column->name == $_POST['slugfield'])
							$check = ' selected ';
						echo '<option ' . $check . ' value="' . $column->name . '">' . $column->name . '</option>';
					}
				endif;
				?>
			</select>
		</td>
	</tr>
	<?php 
	$tableList = $model->getTableList();
	$relations = array('BELONGS_TO', 'HAS_ONE', 'HAS_MANY', 'MANY_MANY');
	for($j = 1; $j <= 5; $j++): ?>
	<?php 
	$cssStyle = "border-bottom: solid 1px #ccc;";
	if (($i+3+$j)%2 == 0)
		$cssStyle .= "background-color: #e0e0e0";
	else
		$cssStyle .= "background-color: #FFF";
	?>
	<tr style="<?php echo $cssStyle; ?>">
		<td>Relation <?php echo $j?></td>
		<td colspan="2">
			<select id="relationTable_<?php echo $j ?>" name="relationTable[<?php echo $j ?>]" class="relationtable">
				<option value="">Doesn't has</option>
				<?php foreach ($tableList as $table)
				{
					$check = '';
					if (isset($_POST['relationTable'][$j]) && $table->name == $_POST['relationTable'][$j])
						$check = ' selected ';
					echo '<option ' . $check . '  value="' . $table->name . '">' . $table->name . '</option>';
				}
				?>
			</select>
		</td>
		<td colspan="2">
			<select name="relationName[<?php echo $j ?>]">
				<option value="">Doesn't has</option>
				<?php foreach ($relations as $relation)
				{
					$check = '';
					if (isset($_POST['relationName'][$j]) && $relation == $_POST['relationName'][$j])
						$check = ' selected ';
					echo '<option ' . $check . '  value="' . $relation . '">' . $relation . '</option>';
				}
				?>
			</select>
		</td>
		<td>
			<select id="relationField_<?php echo $j ?>" name="relationField[<?php echo $j ?>]">
				<option value="">Doesn't has</option>
				<?php foreach ($table->columns as $key => $relatedColumn)
				{
					$check = '';
					if (isset($_POST['relationField'][$j]) && $column->name == $_POST['relationField'][$j])
						$check = ' selected ';
					echo '<option ' . $check . '  value="' . $key . '">' . $key . '</option>';
				}
					
				?>
			</select>
		</td>
	</tr>
	<?php endfor;?>
</table>
<script>
	$(document).ready(function(){
		$('.relationtable').change(function () {
			var id = $(this).attr('id');
			var str = $( "#" + id + " option:selected" ).val();
			var indexNumber = id.substring(id.indexOf('_') + 1);

			if (str != "Doesn't has")
			{
				$.ajax({
					url: '<?php echo Yii::app()->getUrlManager()->createUrl('gii/model/GetTableColunmConfig') ?>',
					data: {tablename: str},
					type: 'POST',
				}).done(function(data){
					$('#relationField_' + indexNumber).html(data);
				});
			}
		});
		window.onload = function()
		{
			$('.relationtable').each(function () {
				var id = $(this).attr('id');
				var str = $( "#" + id + " option:selected" ).val();
				var selectedField  = '<?php echo implode(',', isset($_POST['relationField'])?$_POST['relationField']:array()); ?>';
				var indexNumber = id.substring(id.indexOf('_') + 1);

				if (str != "Doesn't has")
				{
					$.ajax({
						url: '<?php echo Yii::app()->getUrlManager()->createUrl('gii/model/GetTableColunmConfig') ?>',
						data: {tablename: str, selectedfield: selectedField},
						type: 'POST',
					}).done(function(data){
						$('#relationField_' + indexNumber).html(data);
					});
				}
			});
		}
	});
	

</script>