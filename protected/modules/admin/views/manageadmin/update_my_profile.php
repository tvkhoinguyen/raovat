<?php
$this->breadcrumbs = array(
	'Update my profile',
);
?>

<h1>Update My Profile</h1>

<?php
Yii::app()->clientScript->registerScript(
	'myHideEffect', '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");', CClientScript::POS_READY
);
?>

<?php $this->renderNotifyMessage(); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Update Profile</h3>
	</div>
	<div class="panel-body">
		<div class="form">

		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id' => 'users-model-form',
			'enableAjaxValidation' => false,
			'htmlOptions' => array('class' => "form-horizontal", 'role' => "form"),
			));
		?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>
			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'username', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<p class="form-control-static"><?php echo $model->username; ?></p>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'email', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'email', array('size' => 38, 'maxlength' => 250, 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'email'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'full_name', array('label' => 'Full Name', 'class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'full_name', array('size' => 20, 'maxlength' => 200, 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'full_name'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'phone', array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'phone', array('size' => 20, 'maxlength' => 20, 'class' => "form-control")); ?>
					<?php echo $form->error($model, 'phone'); ?>
				</div>
			</div>
			<div class="well">
				<?php echo CHtml::htmlButton('<span class="glyphicon glyphicon-floppy-disk"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp; 
				<?php echo CHtml::htmlButton('<span class="glyphicon glyphicon-remove"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . Yii::app()->createAbsoluteUrl('admin') . '\'')); ?>
			</div>

			<?php $this->endWidget(); ?>

		</div><!-- form -->
	</div>
</div>