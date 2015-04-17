<?php
$this->breadcrumbs = array(
    'System Configurations',
);
?>

<h1>System configurations</h1>

<?php if (Yii::app()->user->hasFlash('setting')): ?>

<div class="alert alert-success">
    <?php echo Yii::app()->user->getFlash('setting'); ?>
</div>

<?php endif; ?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'setting-form-admin-form',
    'enableAjaxValidation' => false,
    'method'=>'post',
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => "form-horizontal", 'role' => "form"),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php // echo $form->errorSummary($model); ?>
    
	<ul class="nav nav-tabs">
		<?php 
		$i = 1;
		if (SettingForm::$settingDefine && is_array(SettingForm::$settingDefine)):
			foreach(SettingForm::$settingDefine as $key => $item):
			$active = $i == 1?' class="active" ':'';
			$itemObject = (object)$item;
		?>
			<li <?php echo $active;?>><a href="#<?php echo $key;?>" data-toggle="tab"><?php echo $itemObject->label?></a></li>
		<?php 
			$i++;
			endforeach;
		endif;?>
    </ul>
	<br />
	<div class="tab-content">
		<?php 
		$i = 1;
		if (SettingForm::$settingDefine && is_array(SettingForm::$settingDefine)):
			foreach(SettingForm::$settingDefine as $key => $item):
			$active = $i == 1?'class="tab-pane active"':'class="tab-pane"';
			$itemObject = (object)$item;
		?>
		<div <?php echo $active ?> id="<?php echo $key ;?>">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> <?php echo $itemObject->label;?></h3>
				</div>
				<div class="panel-body">
					<div class="column">
					<?php 
					if ($itemObject->items && is_array($itemObject->items)):
						foreach($itemObject->items as $data):
						$dataObj = (object)$data;
						?>
						<div class="form-group form-group-sm">
							<?php echo $form->labelEx($model, $dataObj->name, array('class' => "col-sm-1 control-label")); ?>
							<?php 
							$unit = '';
							if(isset($dataObj->unit) && $dataObj->unit != '')
								$unit = ' ' . $dataObj->unit;
							
							$note = '';
							if(isset($dataObj->notes) && $dataObj->notes != '')
								$note = '<div class="notes">' . $dataObj->notes . '</div>';
							
							if ($dataObj->controlTyle == 'text'):
								echo '<div class="col-sm-3">' . $form->textField($model, $dataObj->name, array_merge($dataObj->htmlOptions, array('class' => "form-control"))) . $unit . $note . '</div>'; 
							elseif($dataObj->controlTyle == 'textarea'):
								echo '<div class="col-sm-5">' . $form->textArea($model, $dataObj->name, $dataObj->htmlOptions) . $note . '</div>'; 
							elseif($dataObj->controlTyle == 'dropdown'):
								echo '<div class="col-sm-3">' . $form->dropDownList($model, $dataObj->name, $dataObj->data, array('class' => "form-control")) . $unit . $note . '</div>'; 
							elseif($dataObj->controlTyle == 'password'):
								echo '<div class="col-sm-3">' . $form->passwordField($model, $dataObj->name, array_merge($dataObj->htmlOptions, array('class' => "form-control"))) . $unit . $note . '</div>';
							
							endif;
							?>
							<?php echo $form->error($model, $dataObj->name); ?>
						</div>
					<?php 
						endforeach;
					endif;
					?>
					</div>
				</div>
			</div>
		</div>
		<?php 
			$i++;
			endforeach;
		endif;?>
	</div>
    <div class='clr'></div>
    <div class="well">
        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->


<style type="text/css">
    #test-mail{
        margin-left: 120px;
    }
    #test-mail div{
        display: none;
    }
    #test-mail .btn_send{
        margin-top: 8px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('#test-mail a').click(function(e) {
           e.preventDefault();
           $('#test-mail div').toggle(); 
        });
        $('#test-mail .btn_send').live('click', function(){
           var email = $('#test-mail .email_test').val();
           
           if (email != '' && IsEmail(email) == true) {
               $.ajax({
                   data: {email: email},
                   type: 'POST',
                   url: '<?php echo Yii::app()->createAbsoluteUrl('admin/setting/sendTestMail'); ?>',
                   success: function(response) {
                       var data = JSON.parse(response);
                       console.log(data.mess);
                   }
               })
           } else if (IsEmail(email) == false) {
               alert('Email wrong format!');
           } else {
               alert('Please enter email');
           }
        });
        
       
    });
    
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
</script>