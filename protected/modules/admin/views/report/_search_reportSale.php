<style type="text/css">
	.inline_text .form-control{
		width: 85% !important;
		float: left;
	}
</style>

<div class="panel panel-default">
  <div class="panel-body">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		// 'enableAjaxValidation' => true,
        // 'enableClientValidation' => true,
        // 'clientOptions' => array(
        //     'validateOnChange' => true,
        //     'validateOnSubmit' => true,
        // ),
		'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'search-form'),
	)); ?>
			
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'from_date', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7 inline_text" style="display: inline-flex">
							<?php echo $form->textField($model,'from_date', array('class' => 'my-datepicker-control-dd-mm-yy form-control', 'readonly'=>'readonly')); ?>
							<?php echo $form->error($model,'from_date'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'to_date', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7 inline_text" style="display: inline-flex">
						<?php echo $form->textField($model,'to_date', array('class' => 'my-datepicker-control-dd-mm-yy form-control', 'readonly'=>'readonly')); ?>
						<?php echo $form->error($model,'to_date'); ?>
					</div>
				</div>
			</div>


			<?php /*
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'order_no', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'order_no', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'order_no'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'product_name', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'product_name', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'product_name'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'product_code', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'product_code', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'product_code'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'customer_name', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'customer_name', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'customer_name'); ?>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'status', array(''=>'Select') + GocOrders::getListStatusOrderBE(),  array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'country_name', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php //echo $form->textField($model,'country_name', array('class' => 'form-control')); ?>
						<?php echo $form->dropDownList($model, 'country_name', Countries::getDropdownlistWithTableName(), array('class' => 'form-control', 'empty' => '---Select country--')) ?>
						<?php echo $form->error($model,'country_name'); ?>
					</div>
				</div>
			</div>
			*/?>
			
	<div class="col-sm-12">
		<div class="well">
			<?php echo CHtml::htmlButton('<span class="' . $this->iconSearch .  '"></span> Search', array('class' => 'btn btn-default btn-sm', 'type' => 'submit')); ?>			
			<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Clear', array('class' => 'btn btn-default btn-sm', 'type' => 'reset', 'id' => 'clearsearch')); ?>
		</div>
	</div> 
	<?php $this->endWidget(); ?>

	</div>
</div>


