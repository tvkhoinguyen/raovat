<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'image-example-form',
//        'enableAjaxValidation' => true,
//        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'form', 'enctype' => 'multipart/form-data'),
    ));
    ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model, 'image1'); ?>
            <image style="margin-bottom: 5px;" src="<?php echo $model->getImageUrl('image1', ImageExample::IMAGE1_WIDTH_1, ImageExample::IMAGE1_HEIGHT_1) ?>">
            <div>
                   <?php echo $form->fileField($model, 'image1'); ?><span> (Recommended size: <?php echo ImageExample::IMAGE1_WIDTH_1 ?>x<?php echo ImageExample::IMAGE1_HEIGHT_1 ?>px)</span>
                <?php echo $form->error($model, 'image1'); ?>
            </div>
        </div> 

	<div class="row">
            <?php echo $form->labelEx($model, 'image2'); ?>
            <image style="margin-bottom: 5px;" src="<?php echo $model->getImageUrl('image2', ImageExample::IMAGE2_WIDTH_1, ImageExample::IMAGE2_HEIGHT_1) ?>">
            <div>
                   <?php echo $form->fileField($model, 'image2'); ?><span> (Recommended size: <?php echo ImageExample::IMAGE2_WIDTH_1 ?>x<?php echo ImageExample::IMAGE2_HEIGHT_1 ?>px)</span>
                <?php echo $form->error($model, 'image2'); ?>
            </div>
        </div> 
        
	<div class="row">
            <?php echo $form->labelEx($model, 'image3'); ?>
            <image style="margin-bottom: 5px;" src="<?php echo $model->getImageUrl('image3') ?>">
            <div>
                   <?php echo $form->fileField($model, 'image3'); ?><span> (NO RESIZE)</span>
                <?php echo $form->error($model, 'image3'); ?>
            </div>
        </div> 

	<div class="row buttons" style="padding-left: 115px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->