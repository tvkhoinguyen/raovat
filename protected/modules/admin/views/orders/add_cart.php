<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle , 'url'=>array('index'), 'icon' => $this->iconList),
);

?>
<h1>Add Product To Cart</h1>
<?php echo $this->renderControlNav(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
            <h3 class="panel-title">Add Product To Cart</h3>
    </div>
    <div class="panel-body">
            <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id' => 'goc-orders-form',
                    'enableAjaxValidation'=> false,
                    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
            )); ?>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'product_name', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php 
                    if (isset($model->product_id) && $model->product_id != '') {
                        echo $form->textField($model, 'product_name', array('class' => 'form-control', 'maxlength' => 255, 'readonly' => 'readonly')); 
                    } else {
                        echo $form->textField($model, 'product_name', array('class' => 'form-control', 'maxlength' => 255)); 
                    }
                    ?>
                    <?php echo $form->hiddenField($model, 'product_id'); ?>
                    <?php echo $form->error($model, 'product_id'); ?>
                </div>
                <div class="col-sm-1">
                    <a href="#" id="clear-user">Clear</a>
                </div>
            </div>  
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'style_id', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model, 'style_id', GocMasterStyle::getList(), array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'style_id'); ?>
                </div>
            </div>  
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'size_id', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model, 'size_id', GocMasterSizes::getList(), array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'size_id'); ?>
                </div>
            </div>  
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'color_id', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model, 'color_id', GocMasterColors::getList(), array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'color_id'); ?>
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
                    <?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Add Product' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
                    <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $_GET['email'])) . '\'')); ?>
            </div>
            <?php $this->endWidget(); ?>
            </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        <?php if (!isset($_POST['GocOrderDetails']['product_id'])) { ?>
        $("#GocOrderDetails_style_id").empty();
        $("#GocOrderDetails_style_id").append("<option value>--Select--</option>");
        $("#GocOrderDetails_size_id").empty();
        $("#GocOrderDetails_size_id").append("<option value>--Select--</option>");
        $("#GocOrderDetails_color_id").empty();
        $("#GocOrderDetails_color_id").append("<option value>--Select--</option>");
        <?php } else { ?>   
            updateToForm2(<?php echo $_POST['GocOrderDetails']['product_id'];?>, <?php echo ($model->color_id != '') ? $model->color_id : 'null'; ?>, <?php echo ($model->size_id != '') ? $model->size_id : 'null'; ?>, <?php echo ($model->style_id != '') ? $model->style_id : 'null'; ?>);     
        <?php } ?>
            
        $("#GocOrderDetails_product_name").live('focus.autocomplete', function () {
            $(this).autocomplete({
                source: '<?php echo Yii::app()->createAbsoluteUrl('admin/orders/getProduct'); ?>',
                minLength: 1,
                autoFocus: true,
                appendTo: $(this).parent(),
                select: function (event, ui) {
                    $("#GocOrderDetails_product_name").attr('readonly', 'readonly');
                    $('#GocOrderDetails_product_id').val(ui.item.id);
                    updateToForm(ui.item.id);
                }
            });
        });
        
        function updateToForm(pro_id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl('admin/orders/productInfo'); ?>',
                data: {id: pro_id},
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    var colors = obj.color;
                    var styles = obj.style;
                    var sizes  = obj.size;
                    $("#GocOrderDetails_color_id").empty().append("<option value>--Select--</option>");
                    $(colors).each(function(i){
                        $("#GocOrderDetails_color_id").append("<option value=\""+colors[i].id+"\">"+colors[i].name+"</option>");
                    });
                    $("#GocOrderDetails_style_id").empty().append("<option value>--Select--</option>");
                    $(styles).each(function(i){
                        $("#GocOrderDetails_style_id").append("<option value=\""+styles[i].id+"\">"+styles[i].name+"</option>");
                    }); 
                    $("#GocOrderDetails_size_id").empty().append("<option value>--Select--</option>");
                    $(sizes).each(function(i){
                        $("#GocOrderDetails_size_id").append("<option value=\""+sizes[i].id+"\">"+sizes[i].name+"</option>");
                    }); 
                }
            });
        }
        
        function updateToForm2(pro_id, color, size, style) {
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl('admin/orders/productInfo'); ?>',
                data: {id: pro_id},
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    var colors = obj.color;
                    var styles = obj.style;
                    var sizes  = obj.size;
                    $("#GocOrderDetails_color_id").empty().append("<option value>--Select--</option>");
                    $(colors).each(function(i){
                        $("#GocOrderDetails_color_id").append("<option value=\""+colors[i].id+"\">"+colors[i].name+"</option>");
                    });
                    $("#GocOrderDetails_style_id").empty().append("<option value>--Select--</option>");
                    $(styles).each(function(i){
                        $("#GocOrderDetails_style_id").append("<option value=\""+styles[i].id+"\">"+styles[i].name+"</option>");
                    }); 
                    $("#GocOrderDetails_size_id").empty().append("<option value>--Select--</option>");
                    $(sizes).each(function(i){
                        $("#GocOrderDetails_size_id").append("<option value=\""+sizes[i].id+"\">"+sizes[i].name+"</option>");
                    }); 
                    if (color != 'null') {
                        $('#GocOrderDetails_color_id option[value=' + color + ']').attr('selected', 'selected');
                    }
                    if (size != 'null') {
                        $('#GocOrderDetails_size_id option[value=' + size + ']').attr('selected', 'selected');
                    }
                    if (style != 'null') {
                        $('#GocOrderDetails_style_id option[value=' + style + ']').attr('selected', 'selected');
                    }
                }
            });
        }

        $('#clear-user').click(function (e) {
            e.preventDefault();
            $("#GocOrderDetails_product_name").val('');
            $("#GocOrderDetails_product_name").removeAttr('readonly');
            $('#GocOrderDetails_product_id').removeAttr('value');
        });

    });
</script>