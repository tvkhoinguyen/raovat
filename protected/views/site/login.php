<div class="main clearfix">
  <div class="title-1 clearfix">
      <h1>Login</h1>
    </div>
    <div class="form-type login">                     
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'),
            'enableClientValidation'=>false,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        
        <div class="in-row">
            <?php if (Yii::app()->user->hasFlash('error')){ ?>
                <div class="alert alert-error alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                         <?php echo Yii::app()->user->getFlash('error'); ?>
                </div>
            <?php } ?>
        </div>

        
        <div class="in-row">
            <label class="lb">email address: <span class="required">*</span></label>
            <!-- <input type="text" class="form-control" /> -->
              <?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
              <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="in-row">
            <label class="lb">password: <span class="required">*</span></label>
            <!-- <input type="password" class="form-control" /> -->
                <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'password'); ?>
        </div>
        <div class="in-row clearfix">
          <a href="<?php echo Yii::app()->createAbsoluteUrl('site/forgotPassword'); ?>" class="forgot">Forgot your password?</a>
          <button type="submit" class="btn-1 btn-mini">login</button>
        </div>
        <?php
        $loginUrl = Yii::app()->facebook->getLoginUrl(array(
            //'display' => 'popup',
            'scope' => 'email',
            'redirect_uri' => Yii::app()->createAbsoluteUrl('site/login', array('fb_call_back'=>'success') )
        ));
        ?>
        <div class="output clearfix">
            <div class="type"><strong>Or Sign in with</strong></div>
            <a href="<?php echo $loginUrl; ?>" class="btn-fb">Facebook</a>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>











<?php /*
<h1>SIGN IN</h1>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'),
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
  <div class="form-group">
    <?php echo $form->labelEx($model,'email', array('class'=>'col-sm-2 control-label')); ?>
    <div class="col-sm-6">
      <?php echo $form->textField($model,'email', array('class'=>'form-control','placeholder'=>'Email')); ?>
      <?php echo $form->error($model,'email'); ?>
    </div>
  </div>
  <div class="form-group">
    <?php echo $form->labelEx($model,'password', array('class'=>'col-sm-2 control-label')); ?>
    <div class="col-sm-6">
      <?php echo $form->passwordField($model,'password', array('class'=>'form-control','placeholder'=>'Password')); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>
  </div>

 <?php if($model->scenario == 'captchaRequired'): ?>
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'verifyCode', array('class'=>'col-sm-2 control-label')); ?>
    <div class="col-sm-6">
        <?php $this->widget('CCaptcha'); ?>
        <?php echo CHtml::activeTextField($model,'verifyCode', array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'verifyCode'); ?>
        <div class="hint">Please enter the letters as they are shown in the image above.
                <br/>Letters are not case-sensitive.</div>
    </div>
  </div>
<?php endif; ?>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <div class="checkbox">
          <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" class="btn2">Sign in</button>
    </div>
  </div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <a class="default-link" href="<?php echo Yii::app()->createAbsoluteUrl('site/forgotPassword') ?>">Forgot Password</a>
    </div>
  </div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
        <label>
            Not a member?
            <a class="default-link" href="<?php echo Yii::app()->createAbsoluteUrl('site/register'); ?>">Join Now</a>
        </label>
    </div>
  </div>
<?php $this->endWidget(); ?>
*/ ?>

