<h1>Forgot Password</h1>
<?php
//Yii::app()->clientScript->registerScript(
//   'myHideEffect',
//   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
//   CClientScript::POS_READY
//);
?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info" style="widows:600px;height:50px; color:#FF0000;font-weight:bold;text-align:center; font-size:24px;margin-top:30px;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<p class="note-1">Please enter your email.</p>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'forgot-password-form',
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'email',array('style'=>'padding-left:115px;')); ?>
    </div>
    <div class="row buttons" id="button" style="padding-left: 110px;padding-top: 10px;">
        <?php echo CHtml::submitButton('Reset Password'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->