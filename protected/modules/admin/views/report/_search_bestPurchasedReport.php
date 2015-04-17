<div class="panel panel-default">
  <div class="panel-body">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'search-form'),
	)); ?>
		<div class="col-sm-4">
			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model,'search_from_date', array('class' => 'col-sm-3 control-label')); ?>
				<div class="col-sm-7" >
					<div style="display: inline-flex">
						<?php echo $form->textField($model,'search_from_date', array('class' => 'my-datepicker-control form-control', 'readonly'=>'readonly')); ?>
					</div>
					<div>
						<?php echo $form->error($model,'search_from_date'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model,'search_to_date', array('class' => 'col-sm-3 control-label')); ?>
				<div class="col-sm-7" style="display: inline-flex">
					<?php echo $form->textField($model,'search_to_date', array('class' => 'my-datepicker-control form-control', 'readonly'=>'readonly')); ?>
					<?php echo $form->error($model,'search_to_date'); ?>
				</div>
			</div>
		</div>
	<div class="col-sm-12">
		<div class="well">
			<?php echo CHtml::htmlButton('<span class="' . $this->iconSearch .  '"></span> Search', array('class' => 'btn btn-default btn-sm', 'type' => 'submit')); ?>			
			<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Clear', array('class' => 'btn btn-default btn-sm', 'type' => 'reset', 'id' => 'clearsearch')); ?>
		</div>
	</div> 
	<?php $this->endWidget(); ?>

	</div>
</div>

