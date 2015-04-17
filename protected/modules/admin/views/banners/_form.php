<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'banner-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
            ));
            ?>
	

	<div class="form-group form-group-sm">
	    <?php echo $form->labelEx($model, 'content', array('class' => 'col-sm-1 control-label')); ?>
	    <div class="col-sm-6">
	        <?php echo $form->textArea($model, 'content', array('class' => 'my-editor-basic-nguyen-custom', 'cols' => 63, 'rows' => 5)); ?>
	        <?php echo $form->error($model, 'content'); ?>
	    </div>
	</div>

	<?php 
	if( !$model->isNewRecord)
    {
            ?>
        <div class='form-group form-group-sm'>
			<?php echo $form->labelEx($model,'image', array('class' => 'col-sm-1 control-label')); ?>
            <div class="col-sm-3">
			<?php echo $form->fileField($model, 'image', array('class' => 'form-control')); ?>
			Recommended Size: <?php echo Banner::HOME_BANNER_WIDTH ?>px x <?php echo Banner::HOME_BANNER_HEIGHT ?>px (width x height). Allow: *.jpg, *.png, *.gif
			<?php echo $form->error($model,'image'); ?>
			</div>
		</div>
		<div class='form-group form-group-sm'>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-5">
				<?php if(!empty($model->image)) 
	                	echo CHtml::image( ImageHelper::getImageUrl($model, 'image', Banner::HOME_BANNER_SIZE2 ),''); ?>
        	</div>
		</div>	
            <?php
        }
        else if($model->isNewRecord)
        {
            ?>
            <div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'image', array('class' => 'col-sm-1 control-label')); ?>
	            <div class="col-sm-3">
				<?php echo $form->fileField($model, 'image', array('class' => 'form-control')); ?>
				Recommended Size: <?php echo Banner::HOME_BANNER_WIDTH ?>px x <?php echo Banner::HOME_BANNER_HEIGHT ?>px (width x height). Allow: *.jpg, *.png, *.gif
				<?php echo $form->error($model,'image'); ?>
				</div>
			</div>	
            <?php
        }
        ?>


    	<div class='form-group form-group-sm'>
			<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
				<?php echo $form->dropDownList($model,'status', $model->optionActive, array('class' => 'form-control') ); ?>
				<?php echo $form->error($model,'status'); ?>
				</div>
		</div>

		<?php
		$_tmp = array();
		for($i=1; $i<=100; $i++ )
			$_tmp[$i] = $i;
		?>
		<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model, 'order_display', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
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