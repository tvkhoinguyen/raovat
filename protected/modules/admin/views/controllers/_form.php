<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'controllers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="row buttons" style="padding-left: 115px;">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
        <div class="clr"></div>
        <?php         
        foreach ($actions_controller as $key => $value)
        {
        ?>
        <div class="row" style="width: 30%;float:left;">
            <label for="UsersActions_user_id" style="width: 220px;"><?php echo ucfirst($value); ?></label>
            <?php echo CHtml::dropDownList("Actions[$value]", Controllers::canAccess($value, $model->id, Yii::app()->session['type']), array('allow' => 'Allow', 'deny' => 'Deny'),array('style'=>'width:70px;') ) ?>		
	</div>
            
        <?php } ?>
        <div class="clr"></div>
	<div class="row buttons" style="padding-left: 115px;">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->