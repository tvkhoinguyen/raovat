<div class="main tempt clearfix">
    <div class="main-content">
        <div class="breadcrumb"><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a> 
        <a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myProfile'); ?>">Dashboard</a> <strong>My Order</strong></div>
        <h1 class="title-2">My order</h1>
        <?php MessageHelper::getMessages();?>
        <?php 
            $columnArray = 
                array(
                    array(
                        'header' => 'Ref No.',
                        'type' => 'raw',
                        'value'=>'CHtml::link($data->order_no, Yii::app()->createAbsoluteUrl("member/site/viewOrder", array("order_id"=>base64_encode($data->id) )) )',
                        // 'value' => ' "<a href='".Yii::app()->createAbsoluteUrl('member/site/viewOrder', array('order_id'=>$data->id ))."' >".$data->order_no."</a>" ',
                        'headerHtmlOptions' => array('style' => 'text-align:left;'),
                        'htmlOptions' => array('style' => 'text-align:left;')
                        ),

                    array(
                        'header' => 'Status',
                        'type' => 'raw',
                        'value' => 'SpOrders::getStatusOrder($data)',
                        'headerHtmlOptions' => array('style' => 'text-align:left;'),
                        'htmlOptions' => array('style' => 'text-align:left;')
                        ),
                    array( 
                        'header' => 'Date Of Order',
                        'type' => 'raw',
                        // 'value' => 'SpOrders::getDateOrder($data->id)',
                        'value' => 'Yii::app()->format->date($data->created_date)',
                        'headerHtmlOptions' => array('style' => 'text-align:center;'),
                        'htmlOptions' => array('style' => 'text-align:center;')
                        ),
                    array(
                        'header' => 'Invoice',
                        'class'=>'CButtonColumn',
                        'template'=> '{download}',
                        'headerHtmlOptions' => array('style' => 'text-align:center;', 'class'=>'text-center'),
                        'htmlOptions' => array('style' => 'text-align:center;'),
                        'buttons' => array(
                                'download' => array
                                    (
                                    // 'visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'
                                        'imageUrl'=> Yii::app()->theme->baseUrl."/img/ico-pdf.gif" ,  //Image URL of the button.
                                        'url'=>' Yii::app()->createAbsoluteUrl("member/site/downloadInvoice", array("order_id" => base64_encode($data->id))) ',       //A PHP expression for generating the URL of the button.
                                        // 'visible'=>'...',   //A PHP expression for determining whether the button is visible.
                                        'label' => 'Download invoice',
                                    ),
                                ), 
                    ),
                    // array( 
                    //     'header' => 'Print',
                    //     'type' => 'raw',
                    //     'value' => "$this->widget('ext.mPrint.mPrint', array(
                    //               'title' => '_Print_Page',
                    //               'tooltip' => 'Print',        
                    //               'text' => 'Print',   
                    //               'element' => '#printhtml',        
                    //               'exceptions' => array(      
                    //                   // '.summary',
                    //                   // '.search-form'
                    //               ),
                    //               'publishCss' => true,       
                    //               'visible' => true,  
                    //               'alt' => 'print',      
                    //               'debug' => false,           
                    //               'id' => 'print-div'         
                    //           ))",
                    //     'headerHtmlOptions' => array('style' => 'text-align:center;'),
                    //     'htmlOptions' => array('style' => 'text-align:center;')
                    // ),
                );
            
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'home-block-grid',
                'dataProvider'=>$model->searchMyOrder(),
                // 'htmlOptions'=>array('class'=>'tb'),
                'itemsCssClass' => 'tb',
                'pager'=>array(
                            'header'         => '',
                            'firstPageLabel' => 'First',
                            'lastPageLabel'  => 'Last',
                            'nextPageLabel'  => 'Next',
                        ),
                'selectableRows'=>2,
                'columns'=>$columnArray,
            )); 
        ?>
        <?php
             // $this->widget('ext.mPrint.mPrint', array(
             //      'title' => '_Print_Page',//the title of the document. Defaults to the HTML title
             //      'tooltip' => 'Print',        //tooltip message of the print icon. Defaults to 'print'
             //      'text' => 'Print',   //text which will appear beside the print icon. Defaults to NULL
             //      'element' => '#printhtml',        //the element to be printed.
             //      'exceptions' => array(       //the element/s which will be ignored
             //          // '.summary',
             //          // '.search-form'
             //      ),
             //      'publishCss' => true,       //publish the CSS for the whole page?
             //      'visible' => true,  //should this be visible to the current user?
             //      'alt' => 'print',       //text which will appear if image can't be loaded
             //      'debug' => false,            //enable the debugger to see what you will get
             //      'id' => 'print-div'         //id of the print link
             //  ));
        ?>
        <!-- <table class="tb">
            <thead>
                <tr>
                    <th>Ref No.</th>
                    <th>Status</th>
                    <th>Date of Order</th>
                    <th class="text-center">Invoice</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="#">1235789</a></td>
                    <td>Successfull</td>
                    <td>01/01/2014</td>
                    <td class="text-center"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-pdf.gif" alt="icon pdf" /></a></td>
                </tr>
                <tr>
                    <td><a href="#">1235589</a></td>
                    <td>Successfull</td>
                    <td>01/01/2014</td>
                    <td class="text-center"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-pdf.gif" alt="icon pdf" /></a></td>
                </tr>
                <tr>
                    <td><a href="#">1235789</a></td>
                    <td>Successfull</td>
                    <td>01/01/2014</td>
                    <td class="text-center"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-pdf.gif" alt="icon pdf" /></a></td>
                </tr>
                <tr>
                    <td><a href="#">1235589</a></td>
                    <td>Canceled</td>
                    <td>01/01/2014</td>
                    <td class="text-center"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-pdf.gif" alt="icon pdf" /></a></td>
                </tr>
            </tbody>
        </table> -->
    </div>
    <aside>
        <h4>Account Infomation</h4>
        <ul class="nav-list">
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/profileInfo'); ?>">My profile</a></li>
            <li class="active"><a href="<?php echo Yii::app()->createAbsoluteUrl('member/site/myOrder'); ?>">My order</a></li>
        </ul>
    </aside>                
</div>