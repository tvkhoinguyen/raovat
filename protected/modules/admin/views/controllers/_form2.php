<div class="form">

<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'controllers-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class='form-group form-group-sm'>
		<?php echo $form->labelEx($model,'module_name', array('class' => 'col-sm-1 control-label')); ?>
		<div class="col-sm-3">
			<?php echo $form->dropDownList($model,'module_name',  $this->makeLookUpList(Yii::app()->metadata->getModules()), array('empty' => '--Select One--', 'id' => 'modulename')); ?>
			<?php echo $form->error($model,'module_name'); ?>
		</div>
	</div>
	
	<div class="form-group form-group-sm">
		<?php echo $form->labelEx($model,'controller_name', array('class' => 'col-sm-1 control-label')); ?>
		<div class="col-sm-3">
			<?php echo $form->dropDownList($model,'controller_name', array(), array('empty' => '--Select One--', 'id' => 'controllername', 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'controller_name'); ?>
		</div>
	</div>

	<div id="ajaxload">
		<?php if (!$model->isNewRecord) {?>
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/images/ajax-loader.gif" />
		<?php }
		else
		{
		?>
			Please select a module and controller above
		<?php } ?>
	</div>

	<div class="clr"></div>
	<div class="well">
	<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit', 'disabled' => true)); ?> &nbsp;  
	<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">
	window.onload = function ()
	{
		getModule();
		<?php 
		if (!$model->isNewRecord):
		?>
		getAction(true);
		<?php endif;?>
	}
	
    $("#modulename").change(getModule);
    
	function getModule()
	{
		var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/controllers/GetControllerList');?>";
		$('#controllername').html('<option value="">Loading...</option>')
        var request = $.ajax({
            type: "post",
            url: url,
            data: { module: $("#modulename").val(), selected: '<?php echo $model->controller_name?>'}
          }).done(function(msg) {
            $("#controllername").html(msg);                
          });
	}
	
    $("#controllername").change(getAction);
	
    function getAction(init){
        var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/controllers/GetAvailableAction');?>";
		var controller = init == true?'<?php echo $model->controller_name?>':$("#controllername").val();
        var request = $.ajax({
            type: "post",
            url: url,
            data: { controller: controller, module: $("#modulename").val()}
          }).done(function(msg) {
            $("#ajaxload").html(msg);       
			$('.btn-primary').removeAttr('disabled');
          });

          request.fail(function() {
            alert( "Unkwon error");
          });            
    }
</script>
    

