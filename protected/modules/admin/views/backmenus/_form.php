<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'menus-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	<div class="form-group form-group-sm">
		<?php echo $form->labelEx($model, 'menu_name', array('class' => 'col-sm-1 control-label')); ?>
		<div class="col-sm-3">
			<?php echo $form->textField($model, 'menu_name', array('size' => 30, 'maxlength' => 255)); ?>
			<?php echo $form->error($model, 'menu_name'); ?>
		</div>
	</div>
	<div class="form-group form-group-sm">
		<?php echo $form->labelEx($model, 'menu_link', array('class' => 'col-sm-1 control-label')); ?>
		<div class="col-sm-3">
			<?php echo $form->textField($model, 'menu_link', array('size' => 30, 'maxlength' => 255)); ?>
			<?php echo $form->error($model, 'menu_link'); ?>
		</div>
	</div>

	<?php
	$tmp_ = array();
	for ($i = 1; $i < 100; $i++)
		$tmp_[$i] = $i;
	?>
	<div class="form-group form-group-sm">
		<?php echo $form->labelEx($model, 'display_order', array('class' => 'col-sm-1 control-label')); ?>
		<div class="col-sm-3">
			<?php echo $form->dropDownList($model, 'display_order', $tmp_); ?>
			<?php echo $form->error($model, 'display_order'); ?>
		</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo $form->labelEx($model, 'show_in_menu', array('class' => 'col-sm-1 control-label')); ?>
		<div class="col-sm-3">
			<?php echo $form->checkBox($model, 'show_in_menu', (!empty($model->show_in_menu) && $model->show_in_menu == 1) ? array('checked' => 'checked') : array());?>
			<?php echo $form->error($model, 'show_in_menu'); ?>
		</div>
	</div>



	<div class="form-group form-group-sm">
		<?php echo $form->labelEx($model, 'application_id', array('class' => 'col-sm-1 control-label')); ?>
		<div class="col-sm-3">
			<?php echo $form->dropDownList($model, 'application_id', Applications::loadItems()); ?>
			<?php echo $form->error($model, 'application_id'); ?>
		</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo $form->labelEx($model, 'parent_id', array('class' => 'col-sm-1 control-label')); ?>
		<div class="col-sm-3">
			<?php echo Menus::getDropDownList('Menus[parent_id]', 'Menus_parent_id', $model->parent_id, true); ?>
			<?php echo $form->error($model, 'parent_id'); ?>
		</div>
	</div>
	<div class="form-group form-group-sm">
		<label class="col-sm-1 control-label">Show With Role</label>
		<div class="col-sm-10">
			<?php 
			if (!empty($roles))
			{
				foreach($roles as $role):
					$isChecked = false;
					foreach ($selectedRoles as $allowedRole)
					{
						if ($allowedRole->role_id == $role->id)
							$isChecked = true;
					}
					
				?>
					<div class="col-sm-1"><?php echo CHtml::checkBox('allowrole[]', $isChecked, array('value' => $role->id)) . ' ' . $role->role_name; ?></div>
				<?php
				endforeach;
			}
			
			?>
		</div>
	</div>

    <div class="clr"></div>
    <div id="checkboxresult"></div>

	<div class="form-group form-group-sm buttons">
		<span class="btn-submit"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript">
	
	

	function validateNumber() {
		$(".number").each(function() {
			$(this).unbind("keydown");
			$(this).bind("keydown", function(event) {
				if (!(event.keyCode == 8                                // backspace
						|| event.keyCode == 46                              // delete
						|| event.keyCode == 9							// tab
						|| event.keyCode == 190							// dấu chấm (point) 
						|| (event.keyCode >= 35 && event.keyCode <= 40)     // arform-group form-group-sm keys/home/end
						|| (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
						|| (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
						) {
					event.preventDefault();     // Prevent character input
				}
			});
		});
	}

</script>