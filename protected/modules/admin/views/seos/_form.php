<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'seos-form',
				'enableAjaxValidation' => false,
				'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
			));
			?>
			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model, 'title_tag', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'title_tag', array('class' => 'form-control')); ?>
					<?php echo $form->error($model, 'title_tag'); ?>
				</div>
			</div>

			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model, 'url', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model, 'url', array('class' => 'form-control')); ?>
					<?php echo $form->error($model, 'url'); ?>
				</div>
			</div>

			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model, 'meta_keyword', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textArea($model, 'meta_keyword', array('cols' => 60, 'rows' => 5)); ?>
					<?php echo $form->error($model, 'meta_keyword'); ?>
				</div>
			</div>

			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model, 'meta_desc', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textArea($model, 'meta_desc', array('cols' => 60, 'rows' => 5)); ?>
					<?php echo $form->error($model, 'meta_desc'); ?>
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