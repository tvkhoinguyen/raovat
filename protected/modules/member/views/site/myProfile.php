<div class="main tempt clearfix">
	<div class="main-content">
        <div class="breadcrumb"><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a> <strong>Dashboard</strong></div>
        <h1 class="title-2">Account Infomation</h1>
        <p class=""><strong>E-mail address: </strong><?php echo $model->email; ?></p>
        <div class="check-wrap clearfix">
            <input type="checkbox" id="accept" onclick="check_check();" class="uni-check" <?php echo ($check_change_pass) ? "checked" : ""; ?> /><label for="accept">Change password</label>
        </div>

        <!-- <form class="form-horizontal" role="form"> -->
        <?php if (Yii::app()->user->hasFlash('successChangeMyPassword')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                     <?php echo Yii::app()->user->getFlash('successChangeMyPassword'); ?>
            </div>
        <?php endif; ?>    

    	<div class="change-password">
        <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'myProfile-form',
                    'enableAjaxValidation'=>false,
                    'enableClientValidation'=>false,
                    'clientOptions' => array(
                        'validateOnSubmit' => true
                    ),
                    'htmlOptions'=>array(
                      'class'=>'form-horizontal',
                      'role'=>'form',
                    )
                )); ?>
        	<fieldset class="space-1">
            	<legend>Change password</legend>
                <div class="form-group">
                    <label class="col-xs-4 control-label">Current Password<span class="required">*</span></label>
                    <div class="col-xs-5">
                        <!-- <input type="password" class="form-control" /> -->
                        <!--<span class="error">Error message</span>-->
                        <?php echo $form->passwordField($model, 'currentPassword', array('class' => 'form-control'))?>
                        <?php echo $form->error($model, 'currentPassword')?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label">New Password<span class="required">*</span></label>
                    <div class="col-xs-5">
                        <!-- <input type="password" class="form-control" /> -->
                        <!--<span class="error">Error message</span>-->
                        <?php echo $form->passwordField($model, 'newPassword', array('class' => 'form-control'))?>
                        <?php echo $form->error($model, 'newPassword')?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-4 control-label">Confirm New Password <span class="required">*</span></label>
                    <div class="col-xs-5">
                        <!-- <input type="password" class="form-control" /> -->
                        <!--<span class="error">Error message</span>-->
                        <?php echo $form->passwordField($model, 'password_confirm', array('class' => 'form-control'))?>
                        <?php echo $form->error($model, 'password_confirm')?>
                    </div>
                </div>
                <div class="form-group output">
                    <div class="col-xs-offset-4 col-xs-5">
                        <button type="submit" class="btn-1">save</button>
                    </div>
                </div>
			</fieldset>
        <!-- </form> -->
        <?php $this->endWidget(); ?>
        </div>

    </div>
    <aside>
    	<h4>Account Infomation</h4>
        <ul class="nav-list">
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/profileInfo'); ?>">My profile</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myOrder'); ?>">My order</a></li>
        </ul>
    </aside>                
</div>

<script type="text/javascript">
	function check_check()
	{
		if ( $('#accept').is(':checked')  )
		{
			$(".change-password").show();
		}else{
			$(".change-password").hide();
		}
	}
	$(document).ready(function()
	{
		<?php echo ($check_change_pass)?'$(".change-password").show();':'$(".change-password").hide();'; ?>
	});
</script>

<?php /*
<div class="title-1 clearfix">
  <h1>account information</h1>
</div>
<?php
foreach(Yii::app()->user->getFlashes() as $key => $message) {
	echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'users-model-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
    'clientOptions'=>array(
        'validateOnSubmit'=>false,
    ),
)); ?>
<div class="row">
<div class="col-xs-6">
	<label class="lb">FIRST NAME: <span class="required">*</span></label>
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
	<?php echo $form->textField($model,'email',array('class'=>'form-control', 'disabled'=>$disable)); ?>
	<?php echo $form->error($model,'email'); ?>
  </div>
<div class="col-xs-6">
	<div class="check-wrap space-2  change_password">
		  <input type="checkbox" id="change_password" name="change_password" class="checktype" <?php echo ($check_change_pass)?'checked':'';?>/>
		  <label class="lb" for="change_password">change password</label>
	  </div>
  </div>
</div>
<div class="change-password">
  <div class="title-1 space-1">
	<h2>change password</h2>
  </div>
  <div class="row">
	<div class="col-xs-6">
		<label class="lb">current password: <span class="required">*</span></label>
		<?php echo $form->passwordField($model,'currentPassword',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'currentPassword'); ?>
	  </div>
	<div class="col-xs-6">
		<label class="lb">new password: <span class="required">*</span></label>
		<?php echo $form->passwordField($model,'newPassword',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'newPassword'); ?>
	  </div>
  </div>
  <div class="row">
	<div class="col-xs-6">
		<label class="lb">confirm new password: <span class="required">*</span></label>
		<?php echo $form->passwordField($model,'password_confirm',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'password_confirm'); ?>
	  </div>
  </div>
</div>

<div class="clearfix btn-wrap-2">
  <div class="col-xs-4">
	  <span class="required">*</span> <em>Required fields</em>
  </div>
  <button class="btn-1" type="submit">save</button>
</div>
<?php $this->endWidget(); ?>
<script>
	$(document).ready(function(){
		<?php echo ($check_change_pass)?'$(".change-password").show();':'';?>
		$('.nav-list #account').addClass('active');
	});
</script>
*/?>
