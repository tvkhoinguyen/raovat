<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Create Order</h3>
	</div>
	<div class="panel-body">
		<div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id' => 'sp-orders-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
                    )); ?>
                    <div class='form-group form-group-sm'>
                        <?php echo $form->labelEx($model, 'user_email', array('class' => 'col-sm-1 control-label')); ?>
                        <div class="col-sm-3">
                            <?php echo $form->textField($model, 'user_email', array('class' => 'form-control', 'maxlength' => 255, 'readonly' => (!$model->isNewRecord) ? 'readony' : '')); ?>
                            <?php //echo $form->hiddenField($model, 'user_id'); ?>
                            <?php echo $form->error($model, 'user_email'); ?>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" id="clear-user">Clear</a>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <div class="well">
                        <?php echo CHtml::htmlButton('Next', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>
                        &nbsp;
                        <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#SpOrders_user_email").live('focus.autocomplete', function () {
            $(this).autocomplete({
                source: '<?php echo Yii::app()->createAbsoluteUrl('admin/orders/getUser'); ?>',
                minLength: 1,
                autoFocus: true,
                appendTo: $(this).parent(),
                select: function (event, ui) {
                    $("#SpOrders_user_email").attr('readonly', 'readonly');
                    $('#SpOrders_user_id').val(ui.item.id);
                }
            });
        });

        $('#clear-user').click(function (e) {
            e.preventDefault();
            $("#SpOrders_user_email").val('');
            $("#SpOrders_user_email").removeAttr('readonly');
            $('#SpOrders_user_id').removeAttr('value');
        });
    });
</script>

