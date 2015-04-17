<div class="panel panel-default">
  <div class="panel-body">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'search-form'),
	)); ?>
<div class="col-sm-4">
				<div class="form-group form-group-sm">
<?php echo $form->labelEx($model,'name', array('class' => 'col-sm-3 control-label')); ?>
<div class="col-sm-7">
<?php echo $form->textField($model,'name', array('class' => 'form-control')); ?>
<?php echo $form->error($model,'name'); ?>
		</div>
	</div>
</div>
<div class="col-sm-4">
				<div class="form-group form-group-sm">
<?php echo $form->labelEx($model,'email', array('class' => 'col-sm-3 control-label')); ?>
<div class="col-sm-7">
<?php echo $form->textField($model,'email', array('class' => 'form-control')); ?>
<?php echo $form->error($model,'email'); ?>
		</div>
	</div>
</div>
<div class="col-sm-4">
				<div class="form-group form-group-sm">
<?php echo $form->labelEx($model,'subscriber_group_id', array('class' => 'col-sm-3 control-label')); ?>
<div class="col-sm-7">
<?php echo $form->dropDownList($model,'subscriber_group_id', CHtml::listData(SubscriberGroup::model()->findAll(), 'id', 'name'),array('class'=>'multiselect form-control','empty'=>'--All--')); ?>
<?php echo $form->error($model,'subscriber_group_id'); ?>
		</div>
	</div>
</div>
	<div class="col-sm-12">
		<div class="well">
			<?php echo CHtml::htmlButton('<span class="' . $this->iconSearch .  '"></span> Search', array('class' => 'btn btn-default btn-sm', 'type' => 'submit')); ?>			
<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Clear', array('class' => 'btn btn-default btn-sm', 'type' => 'reset', 'id' => 'clearsearch')); ?>		</div>
	</div> 
	<?php $this->endWidget(); ?>

	</div>
</div>

