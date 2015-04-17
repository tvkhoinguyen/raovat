<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form-group form-group-sm">
	<label class="col-sm-1 control-label">&nbsp;</label>
	<div class="col-sm-10">
		Please check allowed actions for user roles bellow: <a href="#" onclick="checkAll()">Check All</a>
	</div>
</div>
<?php
if (!empty($listRole)):
	foreach ($listRole as $role):
?>
<div class="form-group form-group-sm">
	<label class="col-sm-1 control-label"><?php echo $role->role_name; ?></label>
	<div class="col-sm-10">
		<?php 
		foreach($actions as $action):
			$isChecked = false;
			if (isset($allowActions[$role->id]) && in_array(strtolower($action), $allowActions[$role->id]))
				$isChecked = true;
			?>
			<div class="col-sm-1"><?php echo CHtml::checkBox('allowaction[' . $role->id . '][]', $isChecked, array('value' => $action, "class" => 'actionItem')) . ' ' . $action; ?></div>
			<?php
		endforeach;
		?>
	</div>
</div>
<?php
	endforeach;
endif
?>
<script>
	function checkAll()
	{
		$('.actionItem').attr('checked', 'checked');
	}
</script>

