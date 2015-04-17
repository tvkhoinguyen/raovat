<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
            <div style="float: right">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/orders/addStationery', array('email' => $_GET['email'])); ?>" class="btn btn-primary">Add Stationery</a>
                <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/orders/addPrint', array('email' => $_GET['email'])); ?>" class="btn btn-primary">Add Print Solution</a>
            </div>
            <div class="clr"></div>
            <br/>
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
                        <?php 
                        if (!empty($model)){
                            foreach($model->orderDetail as $key=> $item) :
                        ?>
                            <tr class="<?php echo ($key%2) ? 'even' : 'odd';?>">
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $item->name; ?></td>
                                <td><?php echo ($item->type == ITEM_TYPE_STATIONERY) ? 'Stationery' : 'Print' ;?></td>
                                <td style="text-align: right"><?php echo Yii::app()->format->price($item->price);?></td>
                                <td style="text-align: right"><?php echo $item->quantity;?></td>
                                <td style="text-align: right"><?php echo Yii::app()->format->price($item->sub_total);?></td>
                            </tr>
                        <?php 
                            endforeach;
                            }    
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="well">
                <a class="btn btn-primary" href="<?php echo Yii::app()->createAbsoluteUrl('admin/orders/checkout', array('email' => $_GET['email'])); ?>">Next</a>
                &nbsp;
                <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . Yii::app()->createAbsoluteUrl('admin/orders') . '\'')); ?>
            </div>
	</div>
</div>
