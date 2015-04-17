<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    'View ' . $this->singleTitle . ' : ' . $title_name,
);

$this->menu = array(
    array('label'=> $this->pluralTitle, 'url'=>array('index'), 'icon' => $this->iconList),  
    array('label'=> 'Update '. $this->singleTitle, 'url'=>array('update', 'id'=>$model->id)),
    array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);   

?>
<h1>View <?php echo $this->singleTitle . ' : ' . $title_name; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo $this->singleTitle?></h3>
    </div>
    <div class="panel-body">
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array( 
		'order_no',
                array(
                    'name' => 'transaction_id',
                    'value' => SpOrderTransactions::findByOrderId($model->id),
                    'visible'=> $model->method == ORDER_ONLINE,
                ),
                array(
                    'name' => 'reference_number',
                    'visible'=> $model->method == ORDER_OFFLINE,
                ),
                array(
                    'name' => 'billing_address',
                    'type' => 'html',
                    'value' => $model->getMemberAddressInfo($model->id, 'billing_address')
                ),
                array(
                    'name' => 'shipping_address',
                    'type' => 'html',
                    'value' => $model->getMemberAddressInfo($model->id, 'shipping_address')
                ),
                'status:StringStatusOrderBE',
                    array(
                        'name' => 'created_date',
                        'type' => 'date',
                    ),
            ),
    )); ?>
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
            <?php foreach($model->orderDetail as $key=> $item) :?>
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
            <tfoot>
                <tr class="subtotal">
                    <td colspan="3"></td>
                    <td colspan="2" class="lb">SUBTOTAL</td>
                    <td colspan="2" class="price"><?php echo Yii::app()->format->price($model->sub_total); ?></td>
                </tr>

                <?php if(Yii::app()->params['enable_gst']) :?>
                    <tr class="discount" >
                        <td colspan="3"></td>
                        <td colspan="2" class="lb">GST (<?php echo Yii::app()->params['gst']?>%)</td>
                        <td colspan="2" class="price"><?php echo Yii::app()->format->price($model->gst); ?></td>
                    </tr>
                <?php endif; ?>

                <tr class="shipping">
                    <td colspan="3"></td>
                    <td colspan="2" class="lb">DELIVERY FEE</td>
                    <td colspan="2" class="price"><?php echo Yii::app()->format->price($model->shipping_fee); ?></td>
                </tr>
                <tr class="total">
                    <td colspan="3"></td>
                    <td colspan="2" class="lb">TOTAL</td>
                    <td colspan="2" class="price"><?php echo Yii::app()->format->price($model->total); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
<style type="text/css">
    .order-detail th{
        text-align: center;
    }
    .order-detail .lb{
        font-weight: bold;
        text-align: right;
    }
    .order-detail .price{
        text-align: right;
    }
</style>
