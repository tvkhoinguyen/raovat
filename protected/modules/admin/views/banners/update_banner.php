<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> Update <?php echo $this->singleTitle; ?></h3>
	</div>
	<div class="panel-body">
		<?php $this->renderNotifyMessage();  ?>


		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'banner-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array(
					'class' => 'form-horizontal', 
					'role' => 'form', 
					'enctype' => 'multipart/form-data'
				),
		)); ?>
	
	<?php 
	if( !$model->isNewRecord)
    {
            ?>
        <div class='form-group form-group-sm'>
			<?php echo $form->labelEx($model,'image', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-6">
			<?php echo $form->fileField($model, 'image'); ?>
			<?php echo $model->showRecommendedSize(); ?>
			<?php echo $form->error($model,'image'); ?>
			</div>
		</div>
		<div class='form-group form-group-sm'>
			<div class="col-sm-2">
			</div>
			<div class="col-sm-6">
				<?php 
				if(!empty($model->image)) 
				{
					echo $model->showImageUpdate();
					// echo '<img src="'.$model->getImageUrl($model, 'image', QuangCaoBanner::SIZE2 ).'" />';
				}
					
              	?>
        	</div>
		</div>	
            <?php
    }
    ?>


		<div class='form-group form-group-sm'>
			<?php echo $form->labelEx($model, 'link', array('class' => 'col-sm-2 control-label')); ?>
			<div class="col-sm-6">
				<?php echo $form->textField($model, 'link', array('class' => 'form-control', 'maxlength' => 255)); ?>
				<?php echo $form->error($model, 'link'); ?>
			</div>
		</div>
		
		<div class="clr"></div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
				<?php //echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default')); ?>
			</div>
		<?php $this->endWidget(); ?>
		</div>
	</div>
</div>