<div class="panel panel-default">
  <div class="panel-body">

	<?php echo "<?php \$form = \$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl(\$this->route),
		'method'=>'get',
		'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'search-form'),
	)); ?>\n";

	if(!empty($this->type_option['search'])):
	foreach ($this->type_option['search'] as $key => $val) {
		echo "\t\t\t".'<div class="col-sm-4">
				<div class="form-group form-group-sm">'."\n";
					echo "\t\t\t\t\t<?php echo \$form->labelEx(\$model,'{$key}', array('class' => 'col-sm-3 control-label')); ?>\n";
					echo "\t\t\t\t\t<div class=\"col-sm-7\">\n";
		if ($val == 'text') {
				echo "\t\t\t\t\t\t<?php echo \$form->textField(\$model,'{$key}', array('class' => 'form-control')); ?>\n";
		} elseif ($val == 'date_picker') {
				echo "\t\t\t\t\t\t<?php echo \$form->textField(\$model,'{$key}', array('class' => 'my-datepicker-control form-control')); ?>\n";
		} elseif ($val == 'date_time_picker') {
				echo "\t\t\t\t\t\t<?php echo \$form->textField(\$model,'{$key}', array('class' => 'my-datetimepicker-control form-control')); ?>\n";
		} elseif ($val == 'time') {
				echo "\t\t\t\t\t\t<?php echo \$form->textField(\$model,'{$key}', array('class' => 'my-timepicker-control form-control')); ?>\n";
		} elseif ($val == 'dropdown') {
				echo "\t\t\t\t\t\t<?php echo \$form->dropDownList(\$model,'{$key}', \$model->optionActive, array('class' => 'form-control')); ?>\n";

		} elseif ($val == 'yesno') {
				echo "\t\t\t\t\t\t<?php echo \$form->dropDownList(\$model, '{$key}', MyActiveRecord::getYesNo(), array('class' => 'form-control')); ?>";
		}
		echo "\t\t\t\t\t\t<?php echo \$form->error(\$model,'{$key}'); ?>\n";
		echo "\t\t\t\t\t</div>\n";
		echo "\t\t\t\t</div>\n";
		echo "\t\t\t</div>\n";
	}
	endif;
	?>
	<div class="col-sm-12">
		<div class="well">
			<?php echo "<?php echo CHtml::htmlButton('<span class=\"' . \$this->iconSearch .  '\"></span> Search', array('class' => 'btn btn-default btn-sm', 'type' => 'submit')); ?>";?>
			<?php echo "\n"."\t\t\t<?php echo CHtml::htmlButton('<span class=\"' . \$this->iconCancel . '\"></span> Clear', array('class' => 'btn btn-default btn-sm', 'type' => 'reset', 'id' => 'clearsearch')); ?>\n";?>
		</div>
	</div> 
	<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

	</div>
</div>

