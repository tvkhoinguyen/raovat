<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singlelTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'users-form',
				'enableAjaxValidation' => false,
				'htmlOptions' => array('class' => "form-horizontal", 'role' => "form"),
			));
			?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>
			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'full_name', array('label' => 'Full Name','class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'full_name', array('size' => 47, 'maxlength' => 50, 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'full_name'); ?>
				</div>
			</div>
			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'username', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'username', array('size' => 47, 'maxlength' => 250, 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'username'); ?>
				</div>
			</div>	
			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'email', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'email', array('size' => 47, 'maxlength' => 250, 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'email'); ?>
				</div>
			</div>
			<div class="form-group form-group-sm">
				
				<?php echo $form->labelEx($model, 'temp_password', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php if ($model->scenario == 'editAdmin'): ?>
						<div class="notes">
							Leave this blank if you don't want to change current password
						</div>
					<?php endif ?>
					<?php echo $form->passwordField($model, 'temp_password', array('size' => 47, 'maxlength' => 30, 'value' => '', 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'temp_password'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'password_confirm', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->passwordField($model, 'password_confirm', array('size' => 47, 'maxlength' => 50, 'value' => '', 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'password_confirm'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'phone', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'phone', array('size' => 47, 'maxlength' => 20, 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'phone'); ?>
				</div>
			</div>
			<div class="form-group form-group-sm">
				<?php echo $form->label($model,'status', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->dropDownList($model,'status',DeclareHelper::$statusFormat,array('empty'=>'--Select One--', 'class' => "form-control"));?>
					<?php echo $form->error($model, 'status'); ?>
				</div>
			</div>
			
			<div class="clr"></div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp; 
				<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
			</div>
			<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>
</div>