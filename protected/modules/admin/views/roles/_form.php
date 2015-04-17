<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'roles-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'role_name'); ?>
		<?php echo $form->textField($model,'role_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'role_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role_short_name'); ?>
		<?php echo $form->textField($model,'role_short_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'role_short_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'application_id'); ?>
		<?php echo $form->dropDownList($model,'application_id',Applications::loadItems()); ?>
		<?php echo $form->error($model,'application_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<span class="select"> <?php echo $form->dropDownList($model,'status', ActiveRecord::getUserStatus()); ?></span>
		<?php echo $form->error($model,'status'); ?>
	</div>
        
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->