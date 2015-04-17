<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: _form.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applications-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'application_name'); ?>
		<?php echo $form->textField($model,'application_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'application_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'application_short_name'); ?>
		<?php echo $form->textField($model,'application_short_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'application_short_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->