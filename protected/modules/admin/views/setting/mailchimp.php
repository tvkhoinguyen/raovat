<?php
//$this->breadcrumbs = array(
//    'System Configurations',
//);
?>

<!--<h1>System configurations</h1>-->

<?php if (Yii::app()->user->hasFlash('setting')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('setting'); ?>
</div>

<?php endif; ?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'setting-form-admin-form',
    'enableAjaxValidation' => false,
    'method'=>'post',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>



    <?php echo $form->errorSummary($model); ?>

    <div class="column" style="width: 45%">
<!--        <fieldset>
            <legend>General Settings</legend>

            <div class="row">
                <?php echo $form->labelEx($model, 'title'); ?>
                <?php echo $form->textField($model, 'title', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'title'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'adminEmail'); ?>
                <?php echo $form->textField($model, 'adminEmail', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'adminEmail'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'autoEmail'); ?>
                <?php echo $form->textField($model, 'autoEmail', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'autoEmail'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'meta_description'); ?>
                <?php echo $form->textArea($model, 'meta_description', array('rows'=>5,'cols'=>35,'style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'meta_description'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'meta_keywords'); ?>
                <?php echo $form->textArea($model, 'meta_keywords', array('rows'=>5,'cols'=>35,'style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'meta_keywords'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($model, 'login_limit_times'); ?>
                <?php echo $form->textField($model, 'login_limit_times', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'login_limit_times'); ?>
            </div>
            
            <div class="row">
                <label for="SettingForm_time_refresh_login">Time Refresh Login(minutes)</label>
                <?php echo $form->textField($model, 'time_refresh_login', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'time_refresh_login'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($model, 'server_name',array('label'=>'Server Name For Cron Job')); ?>
                <?php echo $form->textField($model, 'server_name', array('size'=>55)); ?>
                <?php echo $form->error($model, 'server_name'); ?>
            </div>            
          
        </fieldset>-->
        
       <!--<div class="column" style="width: 45%">-->
<!--        <fieldset>
                <legend>Google Map Settings</legend>
            <div class="row">
                <?php echo $form->labelEx($model, 'directions',array('label'=>'Directions')); ?>
                <?php echo $form->textArea($model, 'directions', array('rows'=>5,'cols'=>35,'style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'directions'); ?>
            </div>            
            <div class="row">
                <?php echo $form->labelEx($model, 'company_name',array('label'=>'Company Name')); ?>
                <?php echo $form->textField($model, 'company_name', array('size'=>55)); ?>
                <?php echo $form->error($model, 'company_name'); ?>
            </div>            
            <div class="row">
                <?php echo $form->labelEx($model, 'tel',array('label'=>'Tel')); ?>
                <?php echo $form->textField($model, 'tel', array('size'=>55)); ?>
                <?php echo $form->error($model, 'tel'); ?>
            </div>            
            <div class="row">
                <?php echo $form->labelEx($model, 'fax',array('label'=>'Fax')); ?>
                <?php echo $form->textField($model, 'fax', array('size'=>55)); ?>
                <?php echo $form->error($model, 'fax'); ?>
            </div>            
            <div class="row">
                <?php echo $form->labelEx($model, 'address',array('label'=>'Address')); ?>
                <?php echo $form->textArea($model, 'address', array('rows'=>5,'cols'=>35,'style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'address'); ?>
            </div>            
            <div class="row">
                <?php echo $form->labelEx($model, 'email',array('label'=>'Email')); ?>
                <?php echo $form->textField($model, 'email', array('size'=>55)); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>  
        </fieldset>-->
           
<!--        <fieldset>
            <legend>Paypal Settings</legend>
            <div class="row">
                <?php echo $form->labelEx($model, 'paypalType'); ?>
                <?php echo $form->dropDownList($model, 'paypalType',
                array(
                    'live'=>'Live Paypal',
                    'test'=>'Test Paypal',
                )
            ); ?>
                <?php echo $form->error($model, 'paypalType'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'paypal_email_address'); ?>
                <?php echo $form->textField($model, 'paypal_email_address', array('size'=>35)); ?>
                <?php echo $form->error($model, 'paypal_email_address'); ?>
            </div>
        </fieldset>-->
        
    </div>

<!--    <div class="column" style="width: 45%">
        <fieldset>
            <legend>Email Settings</legend>
            <div class="row">
                <?php echo $form->labelEx($model, 'transportType'); ?>
                <?php echo $form->dropDownList($model, 'transportType', array('php' => 'PHP', 'smtp' => 'Smtp')); ?>
                <?php echo $form->error($model, 'transportType'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'smtpHost'); ?>
                <?php echo $form->textField($model, 'smtpHost'); ?>
                <?php echo $form->error($model, 'smtpHost'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'smtpPort'); ?>
                <?php echo $form->textField($model, 'smtpPort'); ?>
                <?php echo $form->error($model, 'smtpPort'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'smtpUsername'); ?>
                <?php echo $form->textField($model, 'smtpUsername', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'smtpUsername'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'smtpPassword'); ?>
                <?php echo $form->passwordField($model, 'smtpPassword', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'smtpPassword'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'encryption'); ?>
                <?php echo $form->dropDownList($model, 'encryption', array('None' => 'none', 'ssl' => 'SSL', 'tls' => 'TLS')); ?>
                <?php echo $form->error($model, 'encryption'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'title_all_mail'); ?>
                <?php echo $form->textField($model, 'title_all_mail', array('size'=>50)); ?>
                <?php echo $form->error($model, 'title_all_mail'); ?>
            </div>
        </fieldset>

    </div>-->
	
        <div class="column" style="width: 45%;margin-top: 56px;">
            <fieldset>
                <legend>Mailchimp Settings</legend>
<!--                <div class="row">
                    <?php echo $form->labelEx($model, 'mailchimp_on'); ?>
                    <?php echo $form->dropDownList($model, 'mailchimp_on', array('yes'=>'Yes','no'=>'No')); ?>
                    <?php echo $form->error($model, 'mailchimp_on'); ?>
                </div>-->
                
                <div class="row">
                    <?php echo $form->labelEx($model, 'mailchimp_title_groups'); ?>
                    <?php echo $form->textField($model, 'mailchimp_title_groups', array('style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'mailchimp_title_groups'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'mailchimp_api_key'); ?>
                    <?php echo $form->textField($model, 'mailchimp_api_key', array('style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'mailchimp_api_key'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'mailchimp_list_id'); ?>
                    <?php echo $form->textField($model, 'mailchimp_list_id', array('style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'mailchimp_list_id'); ?>
                </div>

                <div class="row">
                    <button type="button" onclick="location.href='<?php echo Yii::app()->createAbsoluteUrl("admin/mailchimp/synchronize") ?>'">Synchronize</button>
                </div>
            </fieldset>
        </div>
 
<!--    <div class="column" style="width: 45%">
        <fieldset>
            <legend>Follow us links</legend>
            <div class="row">
                <?php echo $form->labelEx($model, 'follow_us_facebook',array('label'=>'Facebook') ); ?>
                <?php echo $form->textField($model, 'follow_us_facebook', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'follow_us_facebook'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'follow_us_twitter',array('label'=>'Twitter') ); ?>
                <?php echo $form->textField($model, 'follow_us_twitter', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'follow_us_twitter'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'follow_us_youtube',array('label'=>'Youtube') ); ?>
                <?php echo $form->textField($model, 'follow_us_youtube', array('style'=>'width:350px;')); ?>
                <?php echo $form->error($model, 'follow_us_youtube'); ?>
            </div>
        </fieldset>
    </div>     -->
    
        <div class='clr'></div>
    <div class="buttons clear">
        <button type="submit" style='margin-left: -60px;'>Submit</button>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->