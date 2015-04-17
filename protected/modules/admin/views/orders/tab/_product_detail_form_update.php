<div class="panel panel-default">
  <div class="grid-view order-detail">
        <table class="items" style="width: 100%">
            <thead>
                <tr>
                    <th class="titem">S/N</th>
                    <th class="th">Product name</th>
                    <th class="th">Type</th>
                    <th class="pr">Unit Price</th>
                    <th class="qty">Qty</th>
                    <th>Sub total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($model->orderDetail as $key=> $item) :?>
                <tr class="<?php echo ($key%2) ? 'even' : 'odd';?>">
                    <td style="width: 150px"><?php echo $key+1; ?></td>
                    <td><?php echo $item->name ;?></td>
                    <td><?php
                            if ($item->type == ITEM_TYPE_STATIONERY) {
                                echo 'Stationery';
                            } else {
                                echo 'Print Solution';
                            }
                        ?></td>
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
