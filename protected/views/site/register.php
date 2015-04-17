<div class="main clearfix">
    <div class="title-1 clearfix">
        <h1><?php if(!empty($model->fb_id)) echo 'Register With Facebook'; else echo 'Register'; ?></h1>
    </div>
    <div class="form-type register">                        
        <?php 
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'users-model-form',
                'enableClientValidation' => false,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            )); 
        ?>
        <div style="display: none;">
            <?php echo $form->textField($model,'fb_id',array('class'=>'form-control')); ?>
            <?php echo $form->textField($model,'gender',array('class'=>'form-control')); ?>
        </div>

        <?php if (Yii::app()->user->hasFlash('msg')){ ?>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                
                    <div class="alert alert-success alert-dismissible" role="alert">
                         <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                             <?php echo Yii::app()->user->getFlash('msg'); ?>
                    </div>
            </div>
            <div class="col-xs-4"></div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-xs-6">
                <label class="lb">FIRST NAME: <span class="required">*</span></label>
                <!-- <input type="text" class="form-control" /> -->
                <?php echo $form->textField($model,'first_name',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'first_name'); ?>
            </div>
            <div class="col-xs-6">
                <label class="lb">last NAME: <span class="required">*</span></label>
                <?php echo $form->textField($model,'last_name',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'last_name'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <label class="lb">EMAIL ADDRESS: <span class="required">*</span></label>
                <!-- <input type="text" class="form-control" /> -->
                <?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <label class="lb">password: <span class="required">*</span> </label>
                <!-- <input type="password" class="form-control" /> -->
                <?php echo $form->passwordField($model,'temp_password',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'temp_password'); ?>
            </div>
            <div class="col-xs-6">
                <label class="lb">confirm password: <span class="required">*</span></label>
                <?php echo $form->passwordField($model,'password_confirm',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'password_confirm'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6"></div>
            <div class="col-xs-6">
                <?php echo $form->checkbox($model,'agreeTermOfUse'); ?>
                <!-- <input type="text" class="form-control" /> -->
               <?php echo $form->label($model,'agreeTermOfUse',array('label'=>'I agree with '.CHtml::link('Term And Condition', Yii::app()->createAbsoluteUrl('cms/index', array('slug'=>'term-and-condition')) , array('target'=>'_blank')))); ?>
               <?php echo $form->error($model,'agreeTermOfUse'); ?>
            </div>
        </div>
    <?php
    $loginUrl = Yii::app()->facebook->getLoginUrl(array(
        //'display' => 'popup',
        'scope' => 'email',
        'redirect_uri' => Yii::app()->createAbsoluteUrl('site/register', array('fb_call_back'=>'success') )
    ));
    ?>
        <div class="note"><span class="required">*</span> Required fields</div>
        <div class="output clearfix">
            <?php 
            // if(!isset($_GET['fb_call_back']))
            // { 
                ?>
                <div class="btn-signup">Or Sign up with <a href="<?php echo $loginUrl; ?>" class="btn-fb">Facebook</a></div>
                <?php
            // }
            ?>
            <button class="btn-1 btn-mini" type="submit">submit</button>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<?php /*
<div class="form">
    <?php 
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'users-model-form',
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); 
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'full_name',array('label'=>'Full Name')); ?>
        <?php echo $form->textField($model,'full_name',array('size'=>47,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'full_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>47,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'temp_password'); ?>
        <?php echo $form->passwordField($model,'temp_password',array('maxlength'=>30,'value'=>'')); ?>
        <?php echo $form->error($model,'temp_password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password_confirm'); ?>
        <?php echo $form->passwordField($model,'password_confirm',array('maxlength'=>30,'value'=>'')); ?>
        <?php echo $form->error($model,'password_confirm'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone', array('label'=>'Phone')); ?>
        <?php echo $form->textField($model,'phone',array('size'=>18,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'area_code_id',array('label'=>'Country:')); ?>
        <?php echo $form->dropDownList($model,'area_code_id',  AreaCode::loadArrArea(), array('empty'=>'Select a country'));?>
        <?php echo $form->error($model,'area_code_id'); ?>
    </div>

    <div class="field">
        <?php echo $form->checkbox($model,'agreeTermOfUse'); ?>
        <?php echo $form->label($model,'agreeTermOfUse',array('label'=>'I agree with '.CHtml::link('Term Of Use',array('/term-of-use'), array('target'=>'_blank')))); ?>
        <?php echo $form->error($model,'agreeTermOfUse'); ?>
    </div>

    <div class="field">
        <?php echo $form->checkbox($model,'recieveNewsletter',array('checked'=>true,)); ?>
        <?php echo $form->labelEx($model,'recieveNewsletter',array('label'=>'Receive Newsletter')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
    <?php $this->endWidget(); ?>

</div>
*/?>
