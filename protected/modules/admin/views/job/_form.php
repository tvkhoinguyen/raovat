<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'job-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'name', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'name', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'name'); ?>
					</div>
			</div>
    
			
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'status', $model->optionActive, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
			</div>
    
			
	    	<?php
	    	$_tmp = array(); for($i=1; $i<=100; $i++ ) 	$_tmp[$i] = $i;
	    	?>
	    	<div class='form-group form-group-sm'>
	    			<?php echo $form->labelEx($model, 'order_display', array('class' => 'col-sm-2 control-label')); ?>
	    			<div class="col-sm-6">
	    				<?php echo $form->dropDownList($model,'order_display',$_tmp , array('class' => 'form-control') ); ?>
	    				<?php echo $form->error($model, 'order_display'); ?>
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

<?php /*<div class='form-group form-group-sm'>
		<?php echo $form->labelEx($model,'order_display', array('class' => 'col-sm-1 control-label')); ?>		<div class="col-sm-3">
			<?php echo $form->dropDownList($model,'order_display', ArrayHelper::getArray(), array('class' => 'form-control', 'maxlength' => 255)); ?>			<?php echo $form->error($model,'order_display'); ?>		</div>
</div>
*/ ?>