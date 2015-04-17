<div class="breadcrumbs">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('admin'); ?>">Home</a> » 
    <span>Invoice Template</span>
</div>

<h1>Invoice Template</h1>
<?php $this->renderNotifyMessage(); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> Invoice Template</h3>
	</div>
	<div class="panel-body">
		<div class="form">
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'email-templates-form',
				'enableAjaxValidation' => false,
			));
			?>
                        
                        <div style="float:left; width: 800px">
                                <?php echo $form->textArea($model, 'email_body', array('rows' => 6, 'cols' => 50, 'class' => 'my-editor-full')); ?>
                        </div>
                        <div class="clr"></div>
                        <?php echo $form->error($model, 'email_body'); ?>

			<div class="row" style="display: none;">
				<?php echo $form->labelEx($model, 'type'); ?>
				<?php echo $form->textField($model, 'type', array('size' => 60, 'maxlength' => 255)); ?>
				<?php echo $form->error($model, 'type'); ?>
			</div>
                        <br/>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp; 
			</div>

		<?php $this->endWidget(); ?>

		</div><!-- form -->
	</div>
</div>