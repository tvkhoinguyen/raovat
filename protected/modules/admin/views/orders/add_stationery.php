<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle , 'url'=>array('index'), 'icon' => $this->iconList),
);
?>
<h1>Add Stationery</h1>
<?php
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="<?php echo $this->iconCreate; ?>"></span>Add Stationery</h3>
    </div>
    <div class="panel-body">
        <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id' => 'sp-orders-form',
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
            )); ?>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->hiddenField($model, 'id'); ?>
                    <?php echo $form->error($model, 'id'); ?>
                </div>
                <div class="col-sm-1">
                    <a href="#" id="clear-user">Clear</a>
                </div>
            </div>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'quantity', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'quantity', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'quantity'); ?>
                </div>
            </div>
            <div class="clr"></div>
            <div class="well">
                <?php echo CHtml::htmlButton('Add To Cart', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>
                &nbsp;
                <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $_GET['email'])) . '\'')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#SpStationeries_name").live('focus.autocomplete', function () {
            $(this).autocomplete({
                source: '<?php echo Yii::app()->createAbsoluteUrl('admin/orders/getStationeryProduct'); ?>',
                minLength: 1,
                autoFocus: true,
                appendTo: $(this).parent(),
                select: function (event, ui) {
                    $("#SpStationeries_name").attr('readonly', 'readonly');
                    $('#SpStationeries_id').val(ui.item.id);
                }
            });
        });

        $('#clear-user').click(function (e) {
            e.preventDefault();
            $("#SpStationeries_name").val('');
            $("#SpStationeries_name").removeAttr('readonly');
            $('#SpStationeries_id').removeAttr('value');
        });
    });
</script>
