<table class="items" style="width: 100%">
    <tfoot>
        <tr class="subtotal">
            <td colspan="4"></td>
            <td align="right">SUBTOTAL</td>
            <td class="price"><?php echo Yii::app()->format->price($order->sub_total); ?></td>
        </tr>

        <?php if(Yii::app()->params['enable_gst']) :?>
            <tr class="discount" >
                <td colspan="4"></td>
                <td align="right">Total exclusive of GST</td>
                <td class="price"><?php echo Yii::app()->format->price($order->total_exclusive_gst); ?></td>
            </tr>
            <tr class="discount" >
                <td colspan="4"></td>
                <td align="right">GST (<?php echo Yii::app()->params['gst']?>%)</td>
                <td class="price"><?php echo Yii::app()->format->price($order->gst); ?></td>
            </tr>                    
        <?php endif; ?>

        <tr class="shipping">
            <td colspan="4"></td>
            <td align="right">DELIVERY FEE</td>
            <td class="price"><?php echo Yii::app()->format->price($order->shipping_fee); ?></td>
        </tr>
        <tr class="total">
            <td colspan="4"></td>
            <td align="right">TOTAL</td>
            <td class="price"><?php echo Yii::app()->format->price($order->total); ?></td>
        </tr>
    </tfoot>
</table>