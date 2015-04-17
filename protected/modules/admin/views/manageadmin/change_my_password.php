<?php
$this->breadcrumbs=array(
	'Change my password',
);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $this->iconEdit; ?>"></span> Change My Password</h3>
	</div>
	<div class="panel-body">
		<?php
		Yii::app()->clientScript->registerScript(
		   'myHideEffect',
		   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
		   CClientScript::POS_READY
		);
		?>

		<?php if(Yii::app()->user->hasFlash('successChangeMyPassword')):?>
			<div class="info" style="widows:600px;height:50px; color:#FF0000;font-weight:bold;text-align:center; font-size:24px;margin-top:30px;">
				<?php echo Yii::app()->user->getFlash('successChangeMyPassword'); ?>
			</div>
		<?php endif; ?>

		<div class="form">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'users-model-form',
			// 'enableAjaxValidation'=>false,
            // 'enableClientValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true
            ),
			'htmlOptions' => array('class' => "form-horizontal", 'role' => "form")
		)); ?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php
			$this->renderNotifyMessage(); 
			// foreach(Yii::app()->user->getFlashes() as $key => $message) {
			// 	echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
			// }
			?>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model,'currentPassword',array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->passwordField($model,'currentPassword',array('size'=>38,'maxlength'=>30)); ?>
					<?php echo $form->error($model,'currentPassword'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model,'newPassword',array('class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->passwordField($model,'newPassword',array('size'=>38,'maxlength'=>30)); ?>
					<?php echo $form->error($model,'newPassword'); ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model,'password_confirm',array('label'=>'Confirm New Password','class' => "col-sm-1 control-label")); ?>
				<div class="col-sm-3">
					<?php echo $form->passwordField($model,'password_confirm',array('size'=>38,'maxlength'=>30)); ?>
					<?php echo $form->error($model,'password_confirm'); ?>
				</div>
			</div>


			   <div class="well">
						<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp; 
						<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
					</div>

		<?php $this->endWidget(); ?>

		</div><!-- form -->
	</div>
</div>


