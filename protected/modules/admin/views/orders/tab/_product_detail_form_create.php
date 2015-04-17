<br/>
<div class="navbar-right">
    <div class="btn-group btn-group-sm">
        <a class="btn btn-default" href="<?php echo Yii::app()->createAbsoluteUrl('admin/orders/addCart', array('email' => $_GET['email'])); ?>">
            <span class="glyphicon glyphicon-plus"></span> Add Product To Cart
        </a>
    </div>
</div>
<div class="clr"></div>
<?php
    if (isset(Yii::app()->session['session_order_id'])) {
        $order_id = Yii::app()->session['session_order_id'];
    } else {
        $order_id = '';
    }
    $model_detail = GocOrderDetails::findListBe($order_id);
    echo $form->hiddenField($model, 'id');
    echo $form->error($model,'id');
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'goc-orders-grid',
        //KNguyen fix holder.js not load after gridview update
        //By: add new jquery gridview and content in Folder:  customassets/gridview
        //And custom update function
        //'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
        'dataProvider' => $model_detail,
        'pager' => array(
            'header' => '',
            'prevPageLabel' => 'Prev',
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
            'nextPageLabel' => 'Next',
        ),
        'enableSorting' => false,
        'selectableRows' => 2,
        'columns' => array(
            array(
                'header' => 'S/N',
                'type' => 'raw',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                'headerHtmlOptions' => array('width' => '30px', 'style' => 'text-align:center;'),
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'name' => 'image',
                'type' => 'productDefaultImage',
                'value' => 'array("product_id" => $data->product_id, "color_id" => $data->product_color_id)'
            ),
            'product_name',
            'product_style',
            'product_color',
            array(
                'name' => 'quantity',
                'htmlOptions' => array('style' => 'text-align:right;')
            ),
            array(
                'name' => 'price',
                'value' => 'Yii::app()->format->price($data->price)',
                'htmlOptions' => array('style' => 'text-align:right;')
            ),
            array(
                'header' => 'Action',
                'class' => 'CButtonColumn',
                'template' => '{delete}',
                'buttons' => array(
                    'delete' => array(
                        'url' => 'yii::app()->createAbsoluteUrl("admin/orders/deleteOrderDetail",array("id" => $data->id))'
                    )
                )
            ),
        )
    ));
?>
