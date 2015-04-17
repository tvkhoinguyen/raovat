<h1>Reset Password</h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info" style="widows:600px;height:50px; color:#FF0000;font-weight:bold;text-align:center; font-size:24px;margin-top:30px;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'forgot-password-form',
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
    <div class="row">
        <?php echo $form->error($model,'email',array('style'=>'font-size: 1.9em;')); ?>
    </div>
    <div class="row">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('/admin/site/login');?>">Click here to login</a>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->