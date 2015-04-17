<h1>Change Password</h1>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'users-model-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php //echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'currentPassword',array('class'=>'w-180')); ?>
        <?php echo $form->passwordField($model,'currentPassword',array('size'=>38,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'currentPassword',array('class'=>'errorMessage m-l-180')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'newPassword',array('class'=>'w-180')); ?>
        <?php echo $form->passwordField($model,'newPassword',array('size'=>38,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'newPassword',array('class'=>'errorMessage m-l-180')); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password_confirm',array('label'=>'Confirm New Password','class'=>'w-180')); ?>
        <?php echo $form->passwordField($model,'password_confirm',array('size'=>38,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'password_confirm',array('class'=>'errorMessage m-l-180')); ?>
    </div>

    <div class="row buttons">
        <span class="btn-submit"> <?php echo CHtml::submitButton('Save'); ?></span>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->