<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'orders-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'no_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'no_id', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'no_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'buyer_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'buyer_id', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'buyer_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'buyer_name', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'buyer_name', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'buyer_name'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'total_price', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'total_price', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'total_price'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'total_makup_price', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'total_makup_price', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'total_makup_price'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'total_credit', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'total_credit', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'total_credit'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'total_prolit', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'total_prolit', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'total_prolit'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'total_shiping_fee', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'total_shiping_fee', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'total_shiping_fee'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'total_gst', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'total_gst', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'total_gst'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'payment_method', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'payment_method', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'payment_method'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'billing_address_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'billing_address_id', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'billing_address_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'billing_address_data', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textArea($model,'billing_address_data', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'billing_address_data'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'shipping_address_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'shipping_address_id', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'shipping_address_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'shipping_address_data', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textArea($model,'shipping_address_data', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'shipping_address_data'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'note', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textArea($model,'note', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'note'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'file_po', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'file_po', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'file_po'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'session_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'session_id', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'session_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->dropDownList($model,'status', $model->optionActive, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
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