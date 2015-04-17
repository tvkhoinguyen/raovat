<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle , 'url'=>array('index'), 'icon' => $this->iconList),
);
$billing_address = json_decode($model->billing_address);
?>
<h1>Confirm Order</h1>
<?php 
echo $this->renderControlNav();
$this->renderNotifyMessage(); 
?>
<?php $form2=$this->beginWidget('CActiveForm', array(
        'id' => 'confirm-orders-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
)); ?>
<div class='form-group form-group-sm'>
    <label class= 'col-sm-1 control-label'>Discount code</label>   
    <?php if (!empty($model->coupon_code)) { ?>
    <div class="col-sm-3">
        <?php echo $form2->textField($discount_model, 'discount_code', array('class' => 'form-control', 'style' => 'width: 50%; float: left; margin-right: 10px;', 'value' => $model->coupon_code)); ?>
        <input type="hidden" value="delete" name="DiscountForm[type]" />
        <button type="submit" class="btn-1 btn btn-primary" id="apply_coupon">DELETE</button>
    </div>
    <?php } else { ?>
    <div class="col-sm-3">
        <?php echo $form2->textField($discount_model, 'discount_code', array('class' => 'form-control', 'style' => 'width: 50%; float: left; margin-right: 10px;')); ?>
        <input type="hidden" value="apply" name="DiscountForm[type]" />
        <button type="submit" class="btn-1 btn btn-primary" id="apply_coupon">APPLY</button>
    </div>
    <?php } ?>
</div>
<?php $this->endWidget(); ?>


<?php $form=$this->beginWidget('CActiveForm', array(
        'id' => 'confirm-orders-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
)); ?>
<div class="grid-view order-detail">
    <table class="items" style="width: 100%">
        <tr>
            <th>S/N</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php
            $amount = 0;
            $sub_total = 0;
            foreach ($model_detail as $key => $item) {
                $sub_total = $item->price * $item->quantity;
                $amount = $amount + $sub_total;
                $product_color_model = GocProductColor::findByProAndColor($item->product_id, $item->product_color_id);
                $default_image = GocProductImages::getDefaultImage($product_color_model->id);
        ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td style="width: 150px">
                <img src="<?php echo ImageHelper::getProductImage($item->product_id,  $item->product_color_id, $default_image->image, '136', '104');?>" alt="image" class="image" />
            </td>
            <td><?php echo $item->product_name; ?></td>
            <td align="right"><?php echo Yii::app()->format->price($item->price); ?></td>
            <td align="right"><?php echo $item->quantity; ?></td>
            <td align="right"><?php echo Yii::app()->format->price($sub_total); ?></td>
        </tr>
        <?php } ?>
    </table>
    <table class="total_table">
        <tr>
            <td class="lb">SUB TOTAL</td>
            <td align="right"><?php echo Yii::app()->format->price($amount); ?><?php echo $form->hiddenField($model, 'sub_total', array('value' => $amount)); ?></td>            
        </tr>  
        <tr>
            <td class="lb">DISCOUNT</td>
            <td class="price"  align="right"><?php echo Yii::app()->format->price($total['discount']); ?><?php echo $form->hiddenField($model, 'discount', array('value' => $total['discount'])); ?></td>
        </tr>
        <tr>
            <td class="lb">DISCOUNT CODE</td>
            <td class="price"  align="right"><?php echo Yii::app()->format->price($total['discount_code']); ?><?php echo $form->hiddenField($model, 'discount_code', array('value' => $total['discount_code'])); ?></td>
        </tr>
        <?php if(Yii::app()->params['enable_gst']) :?>
        <tr>
            <td class="lb">GST (<?php echo Yii::app()->params['gst']?>%)</td>
            <td  align="right"><?php echo Yii::app()->format->price($total['gst']); ?><?php echo $form->hiddenField($model, 'gst', array('value' => $total['gst'])); ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td class="lb">SHIPPING &amp; HANDLING FEE</td>
            <td colspan="2" class="price" align="right"><?php echo Yii::app()->format->price($total['shipping_fee']); ?><?php echo $form->hiddenField($model, 'shipping_fee', array('value' => $total['shipping_fee'])); ?></td>
        </tr>
        <tr>
            <td class="lb">TOTAL</td>
            <td class="price"  align="right"><?php echo Yii::app()->format->price($total['total']); ?><?php echo $form->hiddenField($model, 'total', array('value' => $total['total'])); ?></td>
        </tr>
    </table>
    <div class="clr"></div>
    <div class="well">
        <?php echo CHtml::htmlButton('Confirm', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
        <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => base64_encode($billing_address->email))) . '\'')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<style type="text/css">
    .total_table{
        width: 50%;
        float: right;
    }
    .total_table td{
        padding: 5px;
    }
    .total_table .lb{
        text-align: right;
        font-weight: bold;
    }
</style>