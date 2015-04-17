<?php
$this->breadcrumbs=array(
	'Site'=>array('/admin/site'),
	'ChangePassword',
);?>


<h1>Change Password <?php echo $model->username; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admin-form',
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50, 'value'=>'')); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password_repeat'); ?>
        <?php echo $form->passwordField($model,'password_repeat',array('size'=>50,'maxlength'=>50, 'value'=>'')); ?>
        <?php echo $form->error($model,'password_repeat'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->