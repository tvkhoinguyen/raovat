<?php $this->pageTitle = 'Login - '.Yii::app()->params['projectName']; ?>
<div class="panel panel-default panel-login">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span> Login</h3>
	</div>
	<div class="panel-body">
		
		<div class="form">
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'admin-login-form',
				'enableClientValidation' => true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
				),
				'htmlOptions' => array('class' => "form-horizontal", 'role' => "form")
			));
			?>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'username', array('class' => "col-sm-3 control-label")); ?>
				<div class="col-sm-9">
					<div class="left-inner-addon">
						<i class="glyphicon glyphicon-user"></i>
						<?php echo $form->textField($model, 'username', array('size' => 40, 'class' => "login-form-control")); ?>
					</div>
					<?php echo $form->error($model, 'username'); ?>
				</div>
				
			</div>

			<div class="form-group form-group-sm">
				<?php echo $form->labelEx($model, 'password', array('class' => "col-sm-3 control-label")); ?>
				<div class="col-sm-9">
					<div class="left-inner-addon">
						<i class="glyphicon glyphicon-lock"></i>
						<?php echo $form->passwordField($model, 'password', array('size' => 33,'class' => "login-form-control")); ?>
					</div>
					<?php echo $form->error($model, 'password'); ?>
				</div>
			</div>

			<!--<div class="form-group form-group-sm">
				<label class="col-sm-3 control-label">&nbsp;</label>
				<div class="col-sm-9">
					<?php //echo $form->checkBox($model, 'rememberMe'); ?> Remember me
					<?php //echo $form->error($model, 'rememberMe'); ?>
				</div>
			</div>-->

			<div class="form-group form-group-sm">
				<label class="col-sm-3 control-label">&nbsp;</label>
				<div class="col-sm-9">
					<a href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/ForgotPassword'); ?>" target="_blank">Forgot Password ?</a>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<label class="col-sm-3 control-label">&nbsp;</label>
				<div class="col-sm-9">
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span> Login</button>
				</div>
			</div>

			<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>
</div>

