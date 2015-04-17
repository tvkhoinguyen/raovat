<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'subscriber-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>
			<div class='form-group form-group-sm'>
<?php echo $form->labelEx($model,'name', array('class' => 'col-sm-1 control-label')); ?>
	<div class="col-sm-3">
	<?php echo $form->textField($model,'name', array('class' => 'form-control', 'maxlength' => 255)); ?>
	<?php echo $form->error($model,'name'); ?>
	</div>
</div>
    
			<div class='form-group form-group-sm'>
<?php echo $form->labelEx($model,'email', array('class' => 'col-sm-1 control-label')); ?>
	<div class="col-sm-3">
	<?php echo $form->textField($model,'email', array('class' => 'form-control', 'maxlength' => 255)); ?>
	<?php echo $form->error($model,'email'); ?>
	</div>
</div>
    
			<div class='form-group form-group-sm'>
		<?php echo $form->labelEx($model,'subscriber_group_id', array('class' => 'col-sm-1 control-label')); ?>
			<div class="col-sm-3">
			<?php echo $form->dropDownList($model,'subscriber_group_id', CHtml::listData(SubscriberGroup::model()->findAll(), 'id', 'name'),array('class'=>'multiselect form-control','multiple'=>'multiple')); ?>
			<?php echo $form->error($model,'subscriber_group_id'); ?>
			</div>
		</div>
    
			
			<div class="clr"></div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
				<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
			</div>
		<?php $this->endWidget(); ?>
		</div>
	</div>
</div>


<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/multiselect/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/multiselect/bootstrap-multiselect.js"></script>
<script>
    $('.multiselect').multiselect({
        //maxHeight: 200,
        numberDisplayed: 2,
        templates: {
            //divider: '<div class="divider" data-role="divider"></div>'
        }
    });
</script>