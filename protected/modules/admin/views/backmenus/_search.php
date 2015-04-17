<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'menu_name'); ?>
		<?php echo $form->textField($model,'menu_name',array('size'=>30,'maxlength'=>255)); ?>
	</div>

   
    <div class="row">
        <?php echo $form->label($model,'menu_link'); ?>
        <?php echo $form->textField($model,'menu_link',array('size'=>50,'maxlength'=>255)); ?>
    </div>

<!--	<div class="row">
		<?php // echo $form->label($model,'show_in_menu'); ?>
        <?php // echo $form->dropDownList($model,'show_in_menu',MyActiveRecord::getYesNo(1)); ?>
	</div>-->

  
    <div class="row">
        <?php echo $form->labelEx($model,'application_id'); ?>
        <?php echo $form->dropDownList($model,'application_id',Applications::loadItems(1)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'parent_id'); ?>
        <?php echo Menus::getDropDownList('Menus[parent_id]','Menus_parent_id',$model->parent_id,true); ?>
    </div>


	<div class="row buttons">
		<span class="btn-submit"><?php echo CHtml::submitButton('Search'); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->