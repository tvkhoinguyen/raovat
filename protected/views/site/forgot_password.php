<div class="main clearfix">
    <h1 class="title-2">We'll help you reset your password</h1>

    <?php if (Yii::app()->user->hasFlash('msg'))
    { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
             <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                 <?php echo Yii::app()->user->getFlash('msg'); ?>
        </div>
    <?php 
    } else{
    ?>        
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'forgot_password-form',
            'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'),
            'enableClientValidation'=>false,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
    <!-- <form class="form-horizontal" role="form"> -->
        <fieldset>
            <div class="form-group">
                <label class="col-xs-3 control-label">Email Addreess<span class="required">*</span>:</label>
                <div class="col-xs-5">
                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>
            </div>
            <div class="form-group output">
                <div class="col-xs-offset-3 col-xs-5">
                  <button type="submit" class="btn-1">submit</button>
                </div>
            </div>
      </fieldset>
        
    <!-- </form> -->
    <?php $this->endWidget(); ?>
    <?php 
    } ?>
</div>


<?php /*
<div class="main clearfix">
    <div class="title-1 clearfix">
        <h1>We'll help you reset your password</h1>
    </div>
    <div class="form-type login">   

        <?php if (Yii::app()->user->hasFlash('msg')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                     <?php echo Yii::app()->user->getFlash('msg'); ?>
            </div>
        <?php endif; ?>        
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'forgot_password-form',
                'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'),
                'enableClientValidation'=>false,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
          <div class="in-row">
              <label class="lb">email address: <span class="required">*</span></label>
              <!-- <input type="text" class="form-control" /> -->
                <?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'email'); ?>
          </div>

          <div class="in-row clearfix">
            <button type="submit" class="btn-1 btn-mini">Submit</button>
          </div>
        <?php $this->endWidget(); ?>
  </div>
</div>
*/?>


