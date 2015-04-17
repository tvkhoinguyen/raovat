<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle , 'url'=>array('index'), 'icon' => $this->iconList),
);
?>
<h1>Add Print Solution</h1>
<?php
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $this->iconCreate; ?>"></span> Add Print Solution</h3>
	</div>
	<div class="panel-body">
		<div class="form">
                <?php 
                    $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'price-calculator-form',
                        'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form', 'enctype' => 'multipart/form-data'),
                        'enableClientValidation' => false,
                        'enableAjaxValidation' => false,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    ));
                ?>
                <div class="row">
                        <div class="col-xs-8">            
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Category:</label>                                
                                <div class="col-xs-7">
                                    <?php echo $form->dropDownList($model, 'category', PrintCategories::getItemSelect(), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'category'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Masterial:</label>
                                <div class="col-xs-7">
                                    <?php 
                                        if (!empty($material)) {
                                            echo $form->dropDownList($model, 'material', $material, array('class' => 'form-control')); 
                                        } else {
                                            echo $form->dropDownList($model, 'material', $material, array('empty' => 'None', 'class' => 'form-control')); 
                                        }                                    
                                    ?>
                                    <?php echo $form->error($model,'material'); ?>                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Size of Paper:</label>
                                <div class="col-xs-7">
                                    <?php 
                                        if (!empty($size_paper)) {
                                            echo $form->dropDownList($model, 'size_of_paper', $size_paper, array('class' => 'form-control')); 
                                        } else {
                                            echo $form->dropDownList($model, 'size_of_paper', $size_paper, array('empty' => 'None', 'class' => 'form-control')); 
                                        }
                                    ?>
                                    <?php echo $form->error($model,'size_of_paper'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Printing Side:</label>
                                <div class="col-xs-7">
                                    <?php 
                                        if (!empty($printing_side)) {
                                            echo $form->dropDownList($model, 'printing_side', $printing_side, array('class' => 'form-control')); 
                                        } else {
                                            echo $form->dropDownList($model, 'printing_side', $printing_side, array('empty' => 'None', 'class' => 'form-control')); 
                                        }
                                    ?>
                                    <?php echo $form->error($model,'printing_side'); ?>                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Finishing:</label>
                                <div class="col-xs-7">                        
                                    <?php echo $form->dropDownList($model, 'finishing', $finishing, array('empty' => 'None', 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'finishing'); ?>                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Extra Features:</label>
                                <div class="col-xs-7">
                                    <?php echo $form->dropDownList($model, 'extra_features', $extra_features, array('empty' => 'None', 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'extra_features'); ?>  
                                </div>
                            </div>
                            <?php if (!empty($category->lead_time_from) && !empty($category->lead_time_to)) { ?>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Lead Time:</label>
                                <div class="col-xs-7">
                                    <p class="day-of-working"><?php echo $category->lead_time_from.'-'.$category->lead_time_to; ?> working days</p>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">No. of Sets:</label>        
                                <div class="col-xs-2">
                                    <?php echo $form->dropDownList($model, 'no_of_sets', $set, array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'no_of_sets'); ?>  
                                </div>
                                <div class="col-xs-2">
                                    <?php echo $form->textField($model, 'quantity', array('class'=>'form-control numeric-control', 'placeholder'=>"quantity")); ?>      
                                    <?php echo $form->error($model,'quantity'); ?>  
                                </div>
                                <div class="col-xs-2">
                                    <a href="#" class="btn-primary btn btn-block btn-add">Add</a>                                        
                                </div>
                                                                    
                            
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label"> </label>    
                                <div class="col-xs-7">
                                    <table class="tb tb-set">
                                        <thead>
                                            <tr>
                                                <th style="text-align: right">set</th>
                                                <th style="text-align: right">quantity</th>
                                                <th style="text-align: right">price</th>                                    
                                                <th style="text-align: right">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Print Instructions:</label>
                                <div class="col-xs-7">
                                    <?php echo $form->textArea($model, 'print_instructions', array('class' => 'form-control', 'rows'=>"3", 'cols'=>"30")); ?>
                                    <?php echo $form->error($model,'print_instructions'); ?>  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Attachments:</label>
                                <div class="col-xs-7">
                                    <?php echo $form->fileField($model, 'attachments'); ?>
                                    <p>Allow file type: *.jpg, *.jpeg, *.png, *.gif, *.pdf, *.ai </p>
                                    <?php echo $form->error($model, 'attachments'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-xs-7">
                                    <?php
                                        $page = Page::model()->findByPk(NEED_FURTHER_ID);
                                    ?>                                    
                                </div>
                            </div>
                            <div class="well">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $_GET['email'])) . '\'')); ?>
                            </div>            
                    </div>
                        <div class="col-xs-4">
                        <table class="tb">
                            <tbody>
                                <tr>
                                    <td><strong>Price: </strong></td>
                                    <td class="text-right"><strong class="total-price"> N/A</strong></td>
                                    <td>
                                        <input type="hidden" name="SpPriceCalculatorForm[name]" id="SpPriceCalculatorForm_name" />
                                        <input type="hidden" name="SpPriceCalculatorForm[name_not_set]" id="SpPriceCalculatorForm_name_not_set" />
                                        <input type="hidden" name="SpPriceCalculatorForm[price]" id="SpPriceCalculatorForm_price" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
                </div>
        </div>
</div>
<div class="modal fade" id="alertModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="p-mess">Are you sure delete this item?</p>                
                <div class="text-right">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="alertYnModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="p-mess">Are you sure delete this item?</p>                
                <div class="text-right">
                    <a href="#" class="btn btn-primary iclear">Yes</a>
                    <a href="#" class="btn btn-default" data-dismiss="modal">NO</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="alertSuccessModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">Add to cart</h3>
            </div>
            <div class="modal-body">
                <p class="p-mess">Add to cart successfully!</p>                
                <div>
                    <a href="#" class="btn btn-default" data-dismiss="modal">Countinue Shopping</a>
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('site/myCart'); ?>" class="btn btn-primary">Go To My Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .tb-set{width: 100%; display: none}
    .tb-set td{padding: 5px;}
</style>

<script type="text/javascript">
    $(document).ready(function() {
       $('#SpPriceCalculatorForm_category').live('change', function() {
            var id = $(this).val();
            $.ajax({
               type: 'POST',
               data: {id: id},
               url: "<?php echo Yii::app()->createAbsoluteUrl('admin/orders/getOption'); ?>",
               success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    
                    var meterials = obj.material;
                    $("#SpPriceCalculatorForm_material").empty();
                    $.each(meterials, function(i, v){
                        $("#SpPriceCalculatorForm_material").append("<option value=\""+i+"\">"+v+"</option>");
                    });
                    
                    var size_papers = obj.size_paper;
                    $("#SpPriceCalculatorForm_size_of_paper").empty();
                    $.each(size_papers, function(i, v){
                        $("#SpPriceCalculatorForm_size_of_paper").append("<option value=\""+i+"\">"+v+"</option>");
                    });
                    
                    var extra_featuress = obj.extra_features;
                    $("#SpPriceCalculatorForm_extra_features").empty();
                    $("#SpPriceCalculatorForm_extra_features").append("<option value=''>None</option>");
                    $.each(extra_featuress, function(i, v){
                        $("#SpPriceCalculatorForm_extra_features").append("<option value=\""+i+"\">"+v+"</option>");
                    });
                    
                    var printing_sides = obj.printing_side;
                    $("#SpPriceCalculatorForm_printing_side").empty();
                    $.each(printing_sides, function(i, v){
                        $("#SpPriceCalculatorForm_printing_side").append("<option value=\""+i+"\">"+v+"</option>");
                    });
                    
                    var finishings = obj.finishing;
                    $("#SpPriceCalculatorForm_finishing").empty();
                    $("#SpPriceCalculatorForm_finishing").append("<option value=''>None</option>");
                    $.each(finishings, function(i, v){
                        $("#SpPriceCalculatorForm_finishing").append("<option value=\""+i+"\">"+v+"</option>");
                    });
                    
                    var sets = obj.set;
                    $("#SpPriceCalculatorForm_no_of_sets").empty();
                    $.each(sets, function(i, v){
                        $("#SpPriceCalculatorForm_no_of_sets").append("<option value=\""+i+"\">"+v+"</option>");
                    });
                    
                    var lead_from = obj.lead_time_from;
                    var lead_to = obj.lead_time_to;
                    $('.day-of-working').text(lead_from + '-' + lead_to + ' working days');
               }
            });
        });
        
        $('.btn-add').click(function(e){
            e.preventDefault();
            var data_form = $('#price-calculator-form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->createAbsoluteUrl('admin/orders/addRecord'); ?>",
                data: data_form,
                beforeSend: function() {
                    $.blockUI({ message: null });
                },
                success: function(response) {
                    $.unblockUI(); 
                    $('.errorMessage').hide();
                    var obj = jQuery.parseJSON(response);
                    var html = obj.td_html;
                    var mess = obj.mess;
                    var name = obj.name_result;
                    var name_not_set = obj.name_not_set;
                    if (mess == 'editoption') {
                        $('#alertYnModal .p-mess').text('You have changed the configuration. You previous configuration will be discarded. Do you want to continue?');
                        $('#alertYnModal').modal();
                    } else if (mess == '') {
                        $('#SpPriceCalculatorForm_name').val(name);     
                        $('#SpPriceCalculatorForm_name_not_set').val(name_not_set);
                        if (html != '') {
                            $('#SpPriceCalculatorForm_quantity').val('');
                            $('.tb-set').show();
                            $('.tb-set tbody').append(html);
                            makeReadOnly();
                        }
                        updatePriceQuantity();
                    } else {
                        $('#alertModal .p-mess').text(mess);
                        $('#alertModal').modal();
                    }
                    
                    $('.btn-delete').each(function() {
                        $(this).click(function(ee){
                            ee.preventDefault();
                            $(this).parent().parent().remove();
                            var rowCount = $(".tb-set tbody tr").length;
                            if (rowCount ==0) {
                                $('.tb-set').hide();
                                $('#SpPriceCalculatorForm_name').val(''); 
                                $('#SpPriceCalculatorForm_name_not_set').val('');
                                unsetReadOnly();
                            }
                            updatePriceQuantity();
                        });                        
                    });
                }
            });            
	});
        
         $('.iclear').live('click', function(e) {
            e.preventDefault();
            var data_form = $('#price-calculator-form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->createAbsoluteUrl('printSolutions/addRecord'); ?>",
                data: data_form,
                beforeSend: function() {
                    $.blockUI({ message: null });
                },
                success: function(response) {
                    $.unblockUI();                    
                    var obj = jQuery.parseJSON(response);
                    var html = obj.td_html;
                    var mess = obj.mess;
                    var name = obj.name_result;
                    if (html != '') {                        
                        $('.btn-delete').each(function() {                            
                            $(this).parent().parent().remove();
                        });
                        $('#SpPriceCalculatorForm_quantity').val('');
                        $('#SpPriceCalculatorForm_name').val(name);  
                        $('.tb-set').show();
                        $('.tb-set tbody').append(html);     
                        $('#alertYnModal').modal('hide');
                    }
                    updatePriceQuantity();
                    $('.btn-delete').each(function() {
                        $(this).click(function(ee){
                            ee.preventDefault();
                            $(this).parent().parent().remove();
                            var rowCount = $(".tb-set tbody tr").length;
                            if (rowCount ==0) {
                                $('.tb-set').hide();
                                unsetReadOnly();
                            }
                            updatePriceQuantity();
                        });                        
                    });
                }
            });
        });
        
        $('#SpPriceCalculatorForm_material').live('change', function() {
            var cat_id = $('#SpPriceCalculatorForm_category').val();
            var me_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->createAbsoluteUrl('admin/orders/getFeature'); ?>",
                data: {cat_id: cat_id, me_id: me_id},
                beforeSend: function() {
                    $.blockUI({ message: null });
                },
                success: function(response) {
                    $.unblockUI(); 
                    var obj = jQuery.parseJSON(response);
                    var feature = obj.feature;
                    $("#SpPriceCalculatorForm_extra_features").empty();
                    $("#SpPriceCalculatorForm_extra_features").append("<option value=''>None</option>");
                    $.each(feature, function(i, v){
                        $("#SpPriceCalculatorForm_extra_features").append("<option value=\""+i+"\">"+v+"</option>");
                    });
                }
            });
        });
        
        function makeReadOnly() {
            $('#SpPriceCalculatorForm_category').attr('readonly', 'readonly');
            $("#SpPriceCalculatorForm_category option").not(":selected").attr("disabled", "disabled");
            $('#SpPriceCalculatorForm_material').attr('readonly', 'readonly');
            $("#SpPriceCalculatorForm_material option").not(":selected").attr("disabled", "disabled");
            $('#SpPriceCalculatorForm_size_of_paper').attr('readonly', 'readonly');
            $("#SpPriceCalculatorForm_size_of_paper option").not(":selected").attr("disabled", "disabled");
            $('#SpPriceCalculatorForm_printing_side').attr('readonly', 'readonly');
            $("#SpPriceCalculatorForm_printing_side option").not(":selected").attr("disabled", "disabled");
            $('#SpPriceCalculatorForm_finishing').attr('readonly', 'readonly');
            $("#SpPriceCalculatorForm_finishing option").not(":selected").attr("disabled", "disabled");
            $('#SpPriceCalculatorForm_extra_features').attr('readonly', 'readonly');
            $("#SpPriceCalculatorForm_extra_features option").not(":selected").attr("disabled", "disabled");
        }
        
        function unsetReadOnly() {
             $('#SpPriceCalculatorForm_category').removeAttr('readonly');
            $("#SpPriceCalculatorForm_category option").not(":selected").removeAttr("disabled");
            $('#SpPriceCalculatorForm_material').removeAttr('readonly');
            $("#SpPriceCalculatorForm_material option").not(":selected").removeAttr("disabled");
            $('#SpPriceCalculatorForm_size_of_paper').removeAttr('readonly');
            $("#SpPriceCalculatorForm_size_of_paper option").not(":selected").removeAttr("disabled");
            $('#SpPriceCalculatorForm_printing_side').removeAttr('readonly');
            $("#SpPriceCalculatorForm_printing_side option").not(":selected").removeAttr("disabled");
            $('#SpPriceCalculatorForm_finishing').removeAttr('readonly');
            $("#SpPriceCalculatorForm_finishing option").not(":selected").removeAttr("disabled");
            $('#SpPriceCalculatorForm_extra_features').removeAttr('readonly');
            $("#SpPriceCalculatorForm_extra_features option").not(":selected").removeAttr("disabled");
        }
        
        function updatePriceQuantity(){
            var quantity = 0;
            var price = 0;
            var set = 0;
            var set_id = 0;
            $('.sub_set').each(function(index) {
                $(this).attr('name', 'SpPriceCalculatorForm[row]['+index+'][sub_set]');
            });
            $('.sub_set_id').each(function(index) {
                $(this).attr('name', 'SpPriceCalculatorForm[row]['+index+'][sub_set_id]');
            });
            $('.quantity_list').each(function(index){
               quantity = quantity + parseInt($(this).val()); 
               $(this).attr('name', 'SpPriceCalculatorForm[row]['+index+'][sub_quantity]');
            });
            $('.sub_price').each(function(index){
               price = price + parseFloat($(this).val()); 
               $(this).attr('name', 'SpPriceCalculatorForm[row]['+index+'][sub_price]');
            });
            
            var money = formatMoney(price, 'S$');
            $('.total-price').text(money);
            $('#SpPriceCalculatorForm_price').val(price);
        }
        
        function formatMoney(n, currency) {
            return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
        }
    });
</script>