<div class="main tempt clearfix">
	<div class="main-content">
        <div class="breadcrumb"><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a> 
        		<a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myProfile'); ?>">Dashboard</a> <strong>My profile</strong></div>
        <h1 class="title-2">My profile</h1>
        <!-- <form class="form-horizontal" role="form"> -->
        <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                     <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php endif; ?> 

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'profile-info-form',
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
            <div class="form-group">
                <label class="col-xs-3 control-label">Title:</label>
                <div class="col-xs-2">
                    <!-- <select class="selectpicker">
                        <option>Mr.</option>
                        <option>Ms.</option>
                    </select> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->dropDownList($model,'title', Salutations::model()->getList(), array('class'=>'selectpicker')); ?>
                    <?php echo $form->error($model,'title'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">First Name<span class="required">*</span>:</label>
                <div class="col-xs-7">
                    <?php echo $form->textField($model, 'first_name', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'first_name')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Last Name<span class="required">*</span>:</label>
                <div class="col-xs-7">
                    <?php echo $form->textField($model, 'last_name', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'last_name')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Company Name:</label>
                <div class="col-xs-7">
                    <?php echo $form->textField($model, 'company', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'company')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Address Line 1<span class="required">*</span>:</label>
                <div class="col-xs-7">
                    <?php echo $form->textField($model, 'address1', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'address1')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Address Line 2:</label>
                <div class="col-xs-7">
                    <?php echo $form->textField($model, 'address2', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'address2')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Country<span class="required">*</span>:</label>
                <div class="col-xs-7">
                	<!-- <select class="selectpicker">
                    	<option>Singapore</option>
                        <option>Malaysia</option>
                    </select> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->dropDownList($model,'area_code_id', AreaCode::model()->loadArrArea(), array('class'=>'selectpicker')); ?>
                    <?php echo $form->error($model,'area_code_id'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Postal Code<span class="required">*</span>:</label>
                <div class="col-xs-7">
                    <?php echo $form->textField($model, 'postal_code', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'postal_code')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Contact Number<span class="required">*</span>:</label>
                <div class="col-xs-7">
                    <?php echo $form->textField($model, 'phone', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'phone')?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-7 check-wrap">
                    <input type="checkbox" id="subscribe" name="subscribe" class="uni-check" <?php echo ($check_subscribe)?'checked':'';?> />
                    	<label for="newsletter">Subcribe to Newsletter</label>
                </div>
            </div>
            <div class="form-group output">
                <div class="col-xs-offset-3 col-xs-5">
                	<button type="reset" class="btn-2">Clear</button>
                	<button type="submit" class="btn-1">Save</button>
                </div>
            </div>
		<!-- </form> -->
		<?php $this->endWidget(); ?>
    </div>
    <aside>
    	<h4>Account Infomation</h4>
        <ul class="nav-list">
            <li class="active"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/profileInfo'); ?>">My profile</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myOrder'); ?>">My order</a></li>
        </ul>
    </aside>                
</div>



<?php /*
<div class="title-1 clearfix">
	<h1>contact information</h1>
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
		<label class="lb">Title: <span class="required">*</span></label>
		<?php echo $form->dropDownList($model,'title', Salutations::model()->getList(), array('class'=>'selectpicker')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="col-xs-6">
		<label class="lb">telephone: <span class="required">*</span></label>
		<?php echo $form->textField($model,'phone',array('class'=>'form-control', 'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<label class="lb">FIRST NAME: <span class="required">*</span></label>
		<?php echo $form->textField($model,'contact_first_name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'contact_first_name'); ?>
	</div>
	<div class="col-xs-6">
		<label class="lb">company:</label>
		<?php echo $form->textField($model,'company',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<label class="lb">last name: <span class="required">*</span></label>
		<?php echo $form->textField($model,'contact_last_name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'contact_last_name'); ?>
	</div>
	<div class="col-xs-6">
		<label class="lb">fax:</label>
		<?php echo $form->textField($model,'fax',array('class'=>'form-control', 'maxlength'=>20)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>
</div>
<div class="title-1 space-1">
	<h2>address</h2>
</div>
<div class="row">
	<div class="col-xs-6">
		<label class="lb">ADDRESS 1: <span class="required">*</span></label>
		<?php echo $form->textField($model,'address1',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'address1'); ?>
	</div>
	<div class="col-xs-6">
		<label class="lb">ADDRESS 2:</label>
		<?php echo $form->textField($model,'address2',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'address2'); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<label class="lb">ZIP CODE: <span class="required">*</span></label>
		<?php echo $form->textField($model,'postal_code',array('class'=>'form-control', 'maxlength'=>10)); ?>
		<?php echo $form->error($model,'postal_code'); ?>
	</div>
	<div class="col-xs-6">
		<label class="lb">CITY: <span class="required">*</span></label>
		<?php echo $form->textField($model,'city',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<label class="lb">STATE:</label>
		<?php echo $form->textField($model,'state',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>
	<div class="col-xs-6">
		<label class="lb">country: <span class="required">*</span></label>
		<?php echo $form->dropDownList($model,'area_code_id', AreaCode::model()->loadArrArea(), array('class'=>'selectpicker')); ?>
		<?php echo $form->error($model,'area_code_id'); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 check-wrap">
		<input type="checkbox" id="change_password" class="checktype" name="subscribe" <?php echo ($check_subscribe)?'checked':'';?>/>
		<label class="lb" for="change_password" >subcribe to newsletter</label>
	</div>
	<div class="col-xs-4 text-right">
		<span class="required">*</span> <em>Required fields</em>
	</div>
</div>
<div class="clearfix btn-wrap-2">
	<button class="btn-1" type="submit">save</button>
</div>
</div>
<?php $this->endWidget(); ?>
<script>
	$(document).ready(function(){
		$('.nav-list #profile').addClass('active');
	});
</script>
*/?>
