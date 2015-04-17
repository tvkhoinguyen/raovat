<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singlelTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'email-templates-form',
				'enableAjaxValidation' => false,
			));
			?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

				<?php //echo $form->errorSummary($model);  ?>

			<div class="row">
				<?php echo $form->labelEx($model, 'email_subject'); ?>
				<?php echo $form->textField($model, 'email_subject', array('size' => 103, 'maxlength' => 255)); ?>
				<?php echo $form->error($model, 'email_subject'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model, 'parameter_description'); ?>
				<?php echo $form->textArea($model, 'parameter_description', array('rows' => 6, 'cols' => 100)); ?>
				<?php echo $form->error($model, 'parameter_description'); ?>
			</div>	

			<div class="row">
				<?php echo $form->labelEx($model, 'email_body'); ?>
				<div style="float:left; width: 800px">
					<?php echo $form->textArea($model, 'email_body', array('rows' => 6, 'cols' => 50, 'class' => 'my-editor-full')); ?>
				</div>
				<div class="clr"></div>
				<?php echo $form->error($model, 'email_body'); ?>
			</div>
			<div class='clr'></div>

			<div class="row" style="display: none;">
				<?php echo $form->labelEx($model, 'type'); ?>
				<?php echo $form->textField($model, 'type', array('size' => 60, 'maxlength' => 255)); ?>
				<?php echo $form->error($model, 'type'); ?>
			</div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp; 
				<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
			</div>

		<?php $this->endWidget(); ?>

		</div><!-- form -->
	</div>
</div>