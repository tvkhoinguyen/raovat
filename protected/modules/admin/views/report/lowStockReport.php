<?php
$this->breadcrumbs=array(
	'Low Stock Report',
);
// $this->menu=array(
	// array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('lowStock-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});

$('#clearsearch').click(function(){
	var id='search-form';
	var inputSelector='#'+id+' input, '+'#'+id+' select';
	$(inputSelector).each( function(i,o) {
		 $(o).val('');
	});
	var data=$.param($(inputSelector));
	$.fn.yiiGridView.update('lowStock-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"lowStock-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('lowStock-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('lowStock-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#lowStock-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('lowStock-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('lowStock-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo 'Low Stock Report'; ?></h1>

<?php //echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class='search-form' style='display:none'>
<?php $this->renderPartial('_search_lowStockReport',array(
	'model'=>$model,
)); ?></div>

<div class="navbar-right nguyencustom">
    <div class="btn-group btn-group-sm">
    	
    	<a class="btn btn-default" href="<?php echo Yii::app()->createAbsoluteUrl('admin/report/Export', array('type'=>'lowStock' , 'filename'=>'Report_Low_Stock_'.date('d-m-Y')) ); ?>">Export</a>
	</div> 
</div>

<?php echo $this->renderControlNav();?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $this->iconList; ?>"></span> Listing</h3>
	</div>
	<div class="panel-body">
		<?php 
			$allowAction = in_array("delete", $this->listActionsCanAccess)?'CCheckBoxColumn':'';
			$columnArray = array();
			if (in_array("Delete", $this->listActionsCanAccess))
			{
				$columnArray[] = array(
									'value'=>'$data->id',
									'class'=> "CCheckBoxColumn",
								);
			}
			$columnArray = 
			// array_merge($columnArray, 
			array(
				array(
					'header' => 'S/N',
					'type' => 'raw',
					'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				array(
					'name'=>'sku',
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				array(
					'name'=>'eog_sku',
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				// 'company',
				array(
					'header' => 'Company',
					'type' => 'SellerCompany',
					'value' => '$data',
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				
				// 'product_id',
				array(
					'header' => 'Category',
					'type' => 'CategoryName',
					'value' => '$data',
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				// array(
				// 	'name'=>'status',
				// 	'type'=>'status',
				// 	'value'=>'array("id"=>$data->id,"status"=>$data->status)',
				// 	'htmlOptions' => array('style' => 'text-align:center;')
			 //    ),
				// 'quantity',ProductQuantity
				array(
					'header' => 'Quantity',
					'type' => 'ProductQuantity',
					'value' => '$data',
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				/*array(
					'name' => 'price',
					'type' => 'html',
					'value'=> ' Yii::app()->format->price($data->price) ' ,
					'htmlOptions' => array('style' => 'text-align:center;')
				),*/
				/*array(
					'name' => 'address_id',
					'type' => 'SellerAddress',
					'value'=> ' $data ' ,
					'htmlOptions' => array('style' => 'text-align:center;')
				),*/

				/*array(
					'name' => 'detail_image',
					'type' => 'raw',
					'value'=> ' CHtml::image( ImageHelper::getImageUrl($data, "detail_image", "105x70"), "Image" ) ' ,
					'htmlOptions' => array('style' => 'text-align:center;')
				),*/
				array(
					'header' => 'Email',
					'type' => 'SellerEmail',
					'value' => '$data',
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				array(
					'name' => 'created_date',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;')
				),
				
				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					// 'template'=> '{view}{update}{delete}',
					'template'=> '{email}',
					'buttons' => array(
							
							'email'=>array(
                                            'label'=>'Send Mail To Seller',
                                            'click'=>'function(){
                                            	sendMailToSeller( jQuery(this).attr(\'href\')  );
                                            	return false;
                                            }',
                                            'imageUrl'=>Yii::app()->theme->baseUrl.'/admin/img/email.png',
                                            'url'=>' Yii::app()->createAbsoluteUrl("ajax/sendMailToSeller", array("seller_id"=>$data->seller_id, "product_id"=>$data->id)) ',                                           
                                            // 'options'=>array(
                                            //         'ajax'=>array(
		                                          //                   'type'=>'POST',
		                                          //                   'url'=>"js:$(this).attr('href')",                                                               
                                            //         			),
                                            // 				),
                                ),
							// 'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'),
							// 'update' => array('visible' => 'strpos("' . $actions . '", "update") !== false'),
							// 'view' => array(
							// 		// 'visible' => 'strpos("' . $actions . '", "view") !== false'
							// 		'url'=>' Yii::app()->createAbsoluteUrl("admin/report/viewLowStockReport", array("id"=>$data->id)) ',                                         
							// 	)
					),
				),
				// )
			);
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'lowStock-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			// $this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'lowStock-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$model->searchLowStockReport(),
				'pager'=>array(
							'header'         => '',
							'prevPageLabel'  => 'Prev',
							'firstPageLabel' => 'First',
							'lastPageLabel'  => 'Last',
							'nextPageLabel'  => 'Next',
						),
				'selectableRows'=>2,
				'columns'=>$columnArray,
		)); 
		$this->endWidget();
		?>
<script type="text/javascript">
	function sendMailToSeller(url)
	{
		
		if(confirm('Are you sure you want to send mail this seller?'))
		{
			$.ajax({
						url: url,
						type: 'GET',
						data: {
							'lowstock':'lowstock'
						},
						success: function(string)
						{
							console.log(string);
							if(string=='success')
								alert('<?php echo Yii::t("translation", "send_mail_low_stock"); ?>');
						},
						error: function ()
						{
							console.log('Có lỗi xảy ra');
						}
					});
		}
		return false;
	}
</script>
