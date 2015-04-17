<div class="panel panel-default">
  <div class="panel-body">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'search-form'),
	)); ?>
	<?php /*
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'no_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'no_id', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'no_id'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'buyer_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'buyer_id', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'buyer_id'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'buyer_name', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'buyer_name', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'buyer_name'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'total_price', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'total_price', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'total_price'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'total_makup_price', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'total_makup_price', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'total_makup_price'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'total_credit', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'total_credit', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'total_credit'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'total_prolit', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'total_prolit', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'total_prolit'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'total_shiping_fee', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'total_shiping_fee', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'total_shiping_fee'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'total_gst', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'total_gst', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'total_gst'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'payment_method', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'payment_method', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'payment_method'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'billing_address_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'billing_address_id', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'billing_address_id'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'shipping_address_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'shipping_address_id', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'shipping_address_id'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'file_po', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'file_po', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'file_po'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'session_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'session_id', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'session_id'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'status', $model->optionActive, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'created_date', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'created_date', array('class' => 'my-datepicker-control form-control')); ?>
						<?php echo $form->error($model,'created_date'); ?>
					</div>
				</div>
			</div>
			*/?>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'search_report_sale', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'search_report_sale', array('class' => 'my-datepicker-control form-control')); ?>
						<?php echo $form->error($model,'search_report_sale'); ?>
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

