<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle , 'url'=>array('index'), 'icon' => $this->iconList),
);
?>
<h1>Checkout Order</h1>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="<?php echo $this->iconCreate; ?>"></span>Add Stationery</h3>
    </div>
    <div class="panel-body">
        <div class="grid-view order-detail">
        <table class="items" style="width: 100%">
            <thead>
                <tr>
                    <th class="titem">S/N</th>
                    <th class="th">Product name</th>
                    <th class="tsize">Type</th>
                    <th class="pr">Price</th>
                    <th class="qty">Qty</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($order->orderDetail as $key=> $item) :?>
                <tr class="<?php echo ($key%2) ? 'even' : 'odd';?>">
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $item->name; ?></td>
                    <td><?php echo ($item->type == ITEM_TYPE_STATIONERY) ? 'Stationery' : 'Print' ;?></td>
                    <td style="text-align: right"><?php echo Yii::app()->format->price($item->price);?></td>
                    <td style="text-align: right"><?php echo $item->quantity;?></td>
                    <td style="text-align: right"><?php echo Yii::app()->format->price($item->sub_total);?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
            <div id="ajax_cart_summary">
                <?php $this->renderPartial('tab/_cart_summary', array('order' => $order)) ?>      
            </div>            
        </table>
    </div>       
        
        <div class="form">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id' => 'sp-orders-form',
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
            )); ?>
            <div class="col-lg-4">    
                <h4>Billing Address</h4>
                <?php $this->renderPartial('tab/billing', array('form' => $form, 'model' => $model)) ?>                
            </div>
            <div class="col-lg-5">
                <h4>Shipping Address</h4>
                <?php $this->renderPartial('tab/shipping', array('form' => $form, 'model' => $shipping_model)) ?>
            </div>
            <div class="clr"></div>
            <div class="well">
                <?php echo CHtml::htmlButton('Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>
                &nbsp;
                <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $_GET['email'])) . '\'')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#SpBillingAddress_collection_method').live('change', function() {
            if($('#shiptothisaddress').attr('checked'))
                var country_id = $('#SpShippingAddress_area_code_id').val();
            else 
                var country_id = $('#SpBillingAddress_area_code_id').val();
            if ($(this).val() == <?php echo DELIVERY_COLLECTION; ?>) {
                $.ajax({
                   url: '<?php echo Yii::app()->createAbsoluteUrl("admin/orders/shippingFee"); ?>',
                   data:{'country_id' : country_id},
                   type: 'POST',
                   beforeSend: function() {
                       $.blockUI({ message: null });
                   },
                   success: function(data) {
                       $.unblockUI();
                       if(data != "") {
                           $('#ajax_cart_summary').html(data);
                       }
                   },
                   error: function(data) {
                       $.unblockUI();
                   }
               });
               return false;
            }
        });
        
        $('.SpShippingAddress_area_code_id').live('change', function() {
            if ($('#SpBillingAddress_collection_method').val() == <?php echo DELIVERY_COLLECTION; ?>) {
                var country_id = $('#SpShippingAddress_area_code_id').val();
                $.ajax({
                    url: '<?php echo Yii::app()->createAbsoluteUrl("admin/orders/shippingFee"); ?>',
                    data:{
                        'country_id' : country_id
                    },
                    type: 'POST',
                    beforeSend: function() {
                        $.blockUI({ message: null });
                    },
                    success: function(data)
                    {
                        $.unblockUI();
                        if (data!="") {
                            $('#ajax_cart_summary').html(data);
                        }
                    },
                    error: function(data)
                    {
                        $.unblockUI();
                    }
                });
                return false;
            }
        })
    });
    function shiptothisaddress11()
    {
        var bill = new Array();
        if($("#shiptothisaddress").is(':checked'))
        {
            bill['contact_first_name'] = $("#SpBillingAddress_contact_first_name").val();
            bill['contact_last_name'] = $("#SpBillingAddress_contact_last_name").val();
            bill['email'] = $("#SpBillingAddress_email").val();
            bill['phone'] = $("#SpBillingAddress_phone").val();
            bill['address1'] = $("#SpBillingAddress_address1").val();
            bill['address2'] = $("#SpBillingAddress_address2").val();
            bill['postal_code'] = $("#SpBillingAddress_postal_code").val();
            bill['area_name'] = $("#SpBillingAddress_area_code_id option:selected").text();
            bill['area_id'] = $("#SpBillingAddress_area_code_id option:selected").val();
            
            $("#SpShippingAddress_contact_first_name").val( bill['contact_first_name'] );
            $("#SpShippingAddress_contact_last_name").val(bill['contact_last_name']);
            $("#SpShippingAddress_email").val(bill['email']);
            $("#SpShippingAddress_address1").val(bill['address1']);
            $("#SpShippingAddress_address2").val(bill['address2']);
            $("#SpShippingAddress_postal_code").val(bill['postal_code']);
            $("#SpShippingAddress_area_code_id option:selected").text(bill['area_name']);
            $("#SpShippingAddress_area_code_id option:selected").val(bill['area_id']);

        }
    }
</script>