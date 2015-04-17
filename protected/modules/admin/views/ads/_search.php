<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'place_holder'); ?>
        <?php echo $form->dropDownList($model,'place_holder', Ads::getPlaceHolder(1)); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('maxlength'=>100)); ?>
	</div>

	<div class="row">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', DeclareHelper::$statusFormat, array('empty'=>'All')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->