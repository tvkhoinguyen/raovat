<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banner-ads-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>
    <?php
    if(Yii::app()->controller->action->id == "create"){
    ?>
	<div class="row">
		<?php echo $form->labelEx($model,'place_holder'); ?>
        <?php echo $form->dropDownList($model,'place_holder', Ads::getPlaceHolder()); ?>
		<?php echo $form->error($model,'place_holder'); ?>
	</div>
    <?php } else {?>
    <div class="row">
        <?php echo $form->labelEx($model,'place_holder'); ?>
        <?php echo $model->place_holder; ?>
    </div>
    <?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
        <?php echo $form->fileField($model, 'image'); ?>
        Allow: *.jpg, *jpeg, *.png, *.gif
		<?php echo $form->error($model,'image'); ?>
        <?php
        if (!empty($model->image)) { ?>
            <div>
                <img src="<?php echo Yii::app()->createAbsoluteUrl("/upload/bannerads/".$model->place_holder."/thumbs/".$model->image);?>" alt=""/>
            </div>
        <?php } ?>
	</div>

    <div id="5" class="position">
        <fieldset>
            <legend>Photo 's size</legend>
            <p>Homepage: width <b><?php echo ADS_HOME_WIDTH;?>px</b> / height <b><?php echo ADS_HOME_HEIGHT;?>px</b></p>
            <p>Blog - Top : width <b><?php echo ADS_BLOG_TOP_WIDTH;?>px</b> / height <b><?php echo ADS_BLOG_TOP_HEIGHT;?>px</b></p>
            <p>Others : width <b><?php echo ADS_INSIDE_PAGE_WIDTH;?>px</b> / height <b><?php echo ADS_INSIDE_PAGE_HEIGHT;?>px</b></p>
        </fieldset>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'expired_date'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'language' => 'en_us',
            'model'=>$model, //Model object
            'attribute'=>'expired_date', //attribute name
            'mode'=>'date', //use "time","date" or "datetime" (default)
            'options'=>array('dateFormat'=>'dd/mm/yy', 'regional' => 'en_us','minDate'=> '0',), // jquery plugin options


        ));
        ?>
        <?php echo $form->error($model,'expired_date'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60, 'maxlength'=>700)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
