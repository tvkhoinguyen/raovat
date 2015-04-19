<style type="text/css">
	.note{
		color: blue;
	}
</style>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'tin-rao-vat-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'post_user_name', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php 
						if($model->isNewRecord)
							echo $form->textField($model,'post_user_name', array('class' => 'form-control', 'maxlength' => 255)); 
						else
							echo $form->textField($model,'post_user_name', array('class' => 'form-control', 'maxlength' => 255, 'readonly'=>'readonly')); 
						?>
						<?php echo $form->error($model,'post_user_name'); ?>
						<div class="note">Post User Name - show in website</div>
					</div>
			</div>

			<?php if(!$model->isNewRecord){ ?>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'edit_user_name', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'edit_user_name', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'edit_user_name'); ?>
						<div class="note">Edit User Name - show in website</div>
					</div>
			</div>	
			<?php } ?>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'title', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'title', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'title'); ?>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'short_content', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'short_content', array('class' => 'form-control', 'maxlength' => 160)); ?>
						<?php echo $form->error($model,'short_content'); ?>
						<div class="note">Note: max lenght 160.</div>
					</div>
			</div>
			
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'content', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textArea($model,'content', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'content'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'status', $model->optionShowHidden, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
			</div>
    
			
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'image1', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
					<?php
					if (!empty($model->image1)) { ?>
								<div class="col-sm-4">
									<img  src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . "/".$model->id."/".$model->image1);?>"  style="width:100%;" />
								</div>
					<?php } ?>
					<?php echo $form->fileField($model, 'image1', array( 'class' => 'form-control', 'title' => 'Upload  ' . $model->getAttributeLabel('image1'))); ?>
						<div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize/1024)/1024;?>M </div>
						<?php echo $form->error($model,'image1'); ?>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'image2', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
					<?php
					if (!empty($model->image2)) { ?>
							<div class="col-sm-4">
								<img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . "/".$model->id."/".$model->image2);?>"  style="width:100%;" />
							</div>
					<?php } ?>
					<?php echo $form->fileField($model, 'image2', array( 'class' => 'form-control', 'title' => 'Upload  ' . $model->getAttributeLabel('image2'))); ?>
						<div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize/1024)/1024;?>M </div>
						<?php echo $form->error($model,'image2'); ?>
					</div>
			</div>
    
			<?php 
			$_tmp = array(); for($i=1; $i<=100; $i++ ) 	$_tmp[$i] = $i;
			?>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model, 'order_display', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'order_display',$_tmp , array('class' => 'form-control') ); ?>
						<?php echo $form->error($model, 'order_display'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_hot', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'is_hot', array( TYPE_NO=>"NO", TYPE_YES=>"YES"  ) , array('class' => 'form-control') ); ?>
						<?php echo $form->error($model,'is_hot'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_new', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'is_new',array( TYPE_NO=>"NO", TYPE_YES=>"YES"  ) , array('class' => 'form-control') ); ?>
						<?php echo $form->error($model,'is_new'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'address', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'address', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'address'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'phone', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'phone', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'phone'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'mobile', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'mobile', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'mobile'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'state_id', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'state_id', State::getListData(), array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'state_id'); ?>
					</div>
			</div>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'job_id', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'job_id', Job::getListData(), array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'job_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'city', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'city', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'city'); ?>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'loai_tin', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'loai_tin', TinRaoVat::$loai_tin, array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'loai_tin'); ?>
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

<?php /*<div class='form-group form-group-sm'>
		<?php echo $form->labelEx($model,'order_display', array('class' => 'col-sm-1 control-label')); ?>		<div class="col-sm-3">
			<?php echo $form->dropDownList($model,'order_display', ArrayHelper::getArray(), array('class' => 'form-control', 'maxlength' => 255)); ?>			<?php echo $form->error($model,'order_display'); ?>		</div>
</div>
*/ ?>