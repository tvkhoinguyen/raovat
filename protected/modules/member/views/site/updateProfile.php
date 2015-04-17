<h1>Change Password</h1>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'users-model-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>

    <div class="row">
        <?php echo $form->labelEx($model,'full_name',array('label'=>'Full Name')); ?>
        <?php echo $form->textField($model,'full_name',array('size'=>47,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'full_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone', array('label'=>'Phone')); ?>
        <?php echo $form->textField($model,'phone',array('size'=>18,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'area_code_id',array('label'=>'Country:')); ?>
        <?php echo $form->dropDownList($model,'area_code_id',  AreaCode::loadArrArea(), array('empty'=>'Select a country'));?>
        <?php echo $form->error($model,'area_code_id'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->
